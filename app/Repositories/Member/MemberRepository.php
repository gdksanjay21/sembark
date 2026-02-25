<?php

namespace App\Repositories\Member;

use App\Repositories\Member\MemberRepositoryInterface;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberRepository implements MemberRepositoryInterface
{
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->companyId = Auth::user()->company_id;
        $this->user_id = Auth::user()->id;
    }
    
    public function getFilteredUrls($count, $request) {
        $query = ShortUrl::query()
                ->with(['user.company'])
                ->select('short_code', 'original_url', 'click_count', 'user_id', 'created_at')
                ->where('company_id', $this->companyId)
                ->where('user_id', $this->user_id);

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
