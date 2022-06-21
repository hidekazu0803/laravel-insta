<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    #To get all categories related to this post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    # To get all comments related to this post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists(); // TRUE OR FALSE
    }

}