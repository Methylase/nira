<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;
class Blog extends Model
{

    protected $fillable = ['type', 'title',  'description', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }
}
