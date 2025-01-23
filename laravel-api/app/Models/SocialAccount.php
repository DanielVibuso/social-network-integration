<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id', 
        'provider', 
        'provider_id',
        'token',
        'token_secret'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialAccounts() 
    { 
        return $this->hasMany(SocialAccount::class); 
    }
}
