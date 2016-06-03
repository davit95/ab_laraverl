<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_name',
        'role_id',
        'phone',
        'address1',
        'address2',
        'country_is',
        'city_id',
        'us_state_id',
        'postal_code',
        'password',
        'owner_id',
        'card_name',
        'card_number',
        'card_month',
        'card_year',
        'cvv2_number',
        'status',
        'fax',
        'hint_answer',
        'dv_user_key',
        'dv_phone_number',
        'duration',
        'center_id',
        'live_receptionist',
        'package_option'
   ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function city()
    {
        return $this->belongsTo('App\\Models\\City');
    }

    public function state()
    {
        return $this->belongsTo('App\\Models\\UsState');
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function isSuperAdmin()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'super_admin') {
            return true;
        } 
        return false;
        // $role = $this->role;
        // if(!$role) {
        //     throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        // }
        // if($role->name == 'super_admin') {
        //     return 'super_admin';
        // } elseif($role->name == 'client_user') {
        //     return 'client_user';
        // } elseif($role->name == 'admin') {
        //     return 'admin';
        // } elseif($role->name == 'owner_user') {
        //     return 'owner_user';
        // }
        // return false;
    }

    public function isAdmin()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'admin') {
            return true;
        } 
        return false;
    }

    public function isOwner()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'owner_user') {
            return true;
        } 
        return false;
    }

    public function isClientUser()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'client_user') {
            return true;
        } 
        return false;
    }

    public function checkForRole( $role )
    {
        $role = $this->role;
        if( !$role )
        {
            throw new \App\Exceptions\Custom\RoleException("Role for $this->name not defined", 1);     
        }
        if( $role->name == $role )
        {
            return true;
        }
        return false;
    }


}
