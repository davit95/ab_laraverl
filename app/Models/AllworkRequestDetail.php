<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllworkRequestDetail extends Model
{
    protected $table = 'allwork_request_details';
    protected $fillable = ['i_would_like_to','title','first_name','last_name','company','email','phone','size','start_date','notes','center_id', 'owner_id'];

    public function center()
    {
    	return $this->belongsTo('\\App\\Models\\Center', 'center_id', 'id');
    }
}