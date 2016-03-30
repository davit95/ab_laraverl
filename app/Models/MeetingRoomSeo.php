<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoomSeo extends Model
{
    protected $table = 'meeting_rooms_seos';
    protected $fillable = [
        'center_id',
    	'sentence1',
    	'sentence2',
    	'sentence3',
    	'avo_description',
    	'meta_title',
    	'meta_description',
    	'meta_keywords',
    	'h1',
    	'h2',
    	'h3',
    	'seo_footer',
    	'abcn_description',
    	'abcn_title',
    	'subhead'
    ];
    public $timestamps = false;
}
