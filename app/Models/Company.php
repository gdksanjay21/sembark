<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ShortUrl;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name'];
    
    /**
     * 
     * @return type
     */
    public function users() {
        return $this->hasMany(User::class);
    }

    /**
     * 
     * @return type
     */
    public function shortUrls() {
        return $this->hasManyThrough(ShortUrl::class, User::class);
    }
}
