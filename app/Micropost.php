<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //お気に入り機能
    public function favoreds()
    {
        return $this->belongsToMany(Micropost::class, 'user_favorite', 'favorite_id', 'user_id')->withTimestamps();
    }
    
    
}
