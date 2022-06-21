<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryPost;

class Category extends Model
{
    use HasFactory;

    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
