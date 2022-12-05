<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'admin_email','admin_password','admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
}
