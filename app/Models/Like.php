<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    public $timestamps = false;


    // function (){
    //     #sql - "SELECT * FROM  LIKES WHERE USER_ID = AUTH::user()->ID
    //     #result = $this->conn->query($sql);
    //     if($result == TRUE){
    //         RETURN TRUE
    //     }else{
    //         RETURN FALSE
    //     }
    // }

}
