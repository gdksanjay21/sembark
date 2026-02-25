<?php

namespace App\Repositories\Admin;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Models\User;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminInvitationMail;
use Illuminate\Support\Facades\Auth;

class AdminRepository implements AdminRepositoryInterface
{
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->companyId = Auth::user()->company_id;
        $this->user_id = Auth::user()->id;
    }
    
    /**
     * 
     * @param type $request
     * @return object
     */
    public function getCompanyTeamMembers($count, $request) {
        
        $query = User::query()
                ->where('company_id', $this->companyId)
                ->select('id', 'name', 'email', 'role')
                ->withCount(['shortUrls as total_urls'])
                ->withSum(['shortUrls as total_hits'], 'click_count');

        
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
            });
        }

        
        $sortBy = $request->sort_by ?? 'name';
        $sortDir = $request->sort_dir ?? 'asc';

        $query->orderBy($sortBy, $sortDir);
        
        
        $perPage = $request->per_page ?? $count;

        return $query->paginate($perPage);
    }

    
    public function getFilteredUrls($count, $request) {
        $query = ShortUrl::query()
                ->with(['user.company'])
                ->select('short_code', 'original_url', 'click_count', 'user_id', 'created_at')
                ->where('company_id', $this->companyId);

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
    public function createAdminOrMember($data) {
        DB::beginTransaction();
        try {
            // Generate Temporary Password
            $tempPassword = Str::random(10);

            // Create Admin User
            $admin = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($tempPassword),
                'company_id' => $this->companyId,
                'role' => $data['role']
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
    
    /**
     * 
     * @param type $data
     * @return bool
     * @throws \Exception
     */
    public function storeShortUrl($data) {
        DB::beginTransaction();
        
        try {
            // Generate Short URL            
            $shortCode = url('/')."/shurl/".substr(\Illuminate\Support\Str::uuid()->toString(), 0, 9);
            
            $shortUrl = ShortUrl::create([
                'original_url' => $data['original_url'],
                'short_code' => $shortCode,
                'user_id' => $this->user_id,
                'company_id' => $this->companyId,
                'click_count' => 0
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
            //throw $e;
        }
    }
}
