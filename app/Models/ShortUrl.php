<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShortUrl extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['original_url', 'short_code', 'user_id', 'company_id', 'click_count'];
    
    /**
     * 
     * @return object<string, string>
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
