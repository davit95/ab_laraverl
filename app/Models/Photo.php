<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path', 'description', 'alt', 'caption'];
    public $timestamps = false;

    public function aws_seo()
    {
    	return $this->hasOne('\\App\\Models\\AwsImageSeo', 'image_name', 'path');
    }
}
