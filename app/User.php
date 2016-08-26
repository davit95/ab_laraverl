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
        'notes',
        'country_id',
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
        'package_option',
        'url',
        'customer_serialized_result'
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
        return $this->belongsTo('App\\Models\\City', 'city_id');
    }

    public function state()
    {
        return $this->belongsTo('App\\Models\\UsState');
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function us_state()
    {
        return $this->belongsTo('App\\Models\\UsState', 'us_state_id');
    }

    public function region()
    {
        return $this->belongsTo('App\\Models\\Region', 'region_id');
    }

    public function country()
    {
        return $this->belongsTo('App\\Models\\Country', 'country_id');
    }

    public function staffs() {
        return $this->belongsToMany('App\\Models\\Staff', 'owner_staffs', 'user_id', 'staff_id');
    }

    public function allwork_staffs() {
        return $this->belongsToMany('App\\Models\\User', 'user_staffs', 'user_id', 'staff_id');
    }

    public function centers()
    {
        return $this->hasMany('App\\Models\\Center', 'id', 'center_id');
    }    

    public function request_details()
    {
        return $this->hasMany('App\\Models\\AllworkRequestDetail', 'owner_id', 'id');
    }

    public function user_files() {
        return $this->belongsToMany('App\\Models\\File', 'user_files', 'user_id', 'file_id');
    }

    public function invoices()
    {
        return $this->hasMany('App\\Models\\Invoice', 'customer_id', 'id');
    }

    public function isSuperAdmin()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'super_admin' || $role->name == 'accounting_user') {
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

    public function isSuperAdminOrOwner()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'owner_user' || $role->name == 'super_admin' || $role->name == 'accounting_user') {
            return true;
        } 
        return false;
    }

    public function isSuperAdminOrCsr()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'admin' || $role->name == 'super_admin' || $role->name == 'accounting_user') {
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

    public function isSuperAdminOrOwnerOrCsr()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'super_admin' || $role->name == 'owner_user' || $role->name == 'accounting_user') {
            return true;
        } 
        return false;
    }

    public function isAccountingUser()
    {
        $role = $this->role;
        if(!$role) {
            throw new \App\Exceptions\Custom\RoleException(" Role for $this->name not defined", 1);
            
        }
        if($role->name == 'accounting_user') {
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
