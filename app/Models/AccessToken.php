<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = 'api_server_access_tokens';
    protected $fillable = ['api_key_id', 'access_token', 'refresh_token', 'expire_at'];
}
