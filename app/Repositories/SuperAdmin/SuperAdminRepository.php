<?php

namespace App\Repositories\SuperAdmin;

use App\Repositories\SuperAdmin\SuperAdminRepositoryInterface;
use App\Models\Company;
use App\Models\User;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminInvitationMail;

class SuperAdminRepository implements SuperAdminRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    
    /**
     * 
     * @param type $request
     * @return object
     */
    public function getCompanyDashboardData($count, $request) {
        $query = Company::query()
                ->withCount(['users'])
                ->with(['users' => function ($q) {
//                        $q->where('role', 'admin');
                    }])
                ->withCount(['shortUrls as total_urls'])
                ->withSum('shortUrls as total_hits', 'click_count');

        // Sorting
        $sortBy = $request->sort_by ?? 'created_at';
        $sortDir = $request->sort_dir ?? 'desc';

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate($count);
    }
    
    public function getFilteredUrls($count, $request) {
        $query = ShortUrl::query()
                ->with(['user.company'])
                ->select('short_code', 'original_url', 'click_count', 'user_id', 'created_at');

        switch ($request->filter) {

            case 'today':
                $query->whereDate('created_at', now());
                break;

            case 'last_week':
                $query->whereBetween('created_at', [
                    now()->subWeek(),
                    now()
                ]);
                break;

            case 'this_month':
                $query->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year);
                break;

            case 'last_month':
                $lastMonth = now()->subMonth();

                $query->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year);
                break;
        }

        return $query->latest()->paginate($count);
    }

    /**
     * 
     * @param type $data
     * @return bool
     * @throws \Exception
     */
    public function createCompanyWithAdmin($data) {
        DB::beginTransaction();
        try {
            // Create Company
            $company = Company::create([
                'name' => $data['company_name']
            ]);

            // Generate Temporary Password
            $tempPassword = Str::random(10);

            // Create Admin User
            $admin = User::create([
                'name' => 'Admin User',
                'email' => $data['email'],
                'password' => Hash::make($tempPassword),
                'company_id' => $company->id,
                'role' => 'admin'
            ]);

            // Send Invitation Email
//            Mail::to($admin->email)->send( new AdminInvitationMail($admin, $tempPassword));

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
            //throw $e;
        }
    }
}
