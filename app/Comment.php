<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'post_id', 'author', 'email', 'body', 'is_active', 'path', 'user_id'
    ];

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
