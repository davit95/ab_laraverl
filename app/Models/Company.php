<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';
    protected $fillable = [
     	'user_id',
     	'name', 
     	'website_url', 
     	'photo', 
     	'us_state_id', 
     	'facebook_url', 
     	'twitter_url', 
     	'instgram_url',
     	'linkedin_url',
     	'google_url'
    ];

    public function user()
    {
    	return $this->hasOne('App\\User', 'id', 'user_id');
    }
}
