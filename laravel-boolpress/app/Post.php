<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug','category_id'];

    public function categorys() {
        return $this->belongsTo('App/Category');
    }
}
