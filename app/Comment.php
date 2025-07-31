<?php

namespace App;
use App\Blog;
use App\Comment;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['name', 'email',  'content', 'blog_id', 'parent_id'];

    public function blog() {
        return $this->belongsTo(Blog::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }



   /* public function user()
    {
        return $this->belongsTo(User::class);
    }*/

}
