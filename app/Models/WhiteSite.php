<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhiteSite extends Model
{
    protected $table = 'white_sites';
    protected $fillable = ['user_id', 'virtual_offices_offers', 'meeting_rooms_offers', 'logo', 'company_name', 'company_phone', 'company_home_url', 'url', 'landing_page', 'removed_centers_ids'];
}
