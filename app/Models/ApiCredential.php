<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredential extends Model
{
    protected $table = 'api_server_keys';
    protected $fillable = ['api_key', 'api_secret', 'origin', 'full_access'];

    public function AccessTokens()
    {
    	return $this->hasMany('\\App\\Models\\AccessToken', 'id', 'api_key_id');
    }
}
