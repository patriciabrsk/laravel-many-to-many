<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = array('user_id', 'title', 'content', 'image_url', 'slug');

    //
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }
}
