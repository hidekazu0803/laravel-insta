<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function follower(){
        return $this->belongsTo(User::class)->withTrashed();
    }

}