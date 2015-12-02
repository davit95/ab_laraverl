<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'fax', 'url', 'email', 'address1', 'address2', 'city_id', 'region_id', 'us_state_id', 'country_id', 'postal_code', 'notes', 'company_name'];

    /**
     * Get all of the centers for owner.
     */
    public function centers()
    {
        return $this->hasMany('App\\Models\\Center');
    }

    /**
     * Get the city for owner.
     */
    public function city()
    {
        return $this->belongsTo('App\\Models\\City', 'city_id');
    }

    /**
     * Get the city flag for owner.
     */
    public function getCityAttribute()
    {
        $city = $this->city()->first();
        return $city?$city->name:'';
    }

    /**
     * Get the region for owner.
     */
    public function region()
    {
        return $this->belongsTo('App\\Models\\Region', 'region_id');
    }

    /**
     * Get the region for owner.
     */
    public function getregionAttribute()
    {
        $region = $this->belongsTo('App\\Models\\Region', 'region_id')->first();
        return $region?$region->name:'';
    }

    /**
     * Get the us_state for owner.
     */
    public function us_state()
    {
        return $this->belongsTo('App\\Models\\UsState', 'us_state_id');
    }

    /**
     * Get the region for owner.
     */
    public function getUsStateAttribute()
    {
        $us_state = $this->belongsTo('App\\Models\\UsState', 'us_state_id')->first();
        return $us_state?$us_state->name:'';
    }

    /**
     * Get the country for owner.
     */
    public function country()
    {
        return $this->belongsTo('App\\Models\\Country', 'country_id');
    }

    /**
     * Get the region for owner.
     */
    public function getCountryAttribute()
    {
        $country = $this->belongsTo('App\\Models\\Country', 'country_id')->first();
        return $country?$country->name:'';
    }
}