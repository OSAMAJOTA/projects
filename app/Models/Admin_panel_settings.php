<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_panel_settings extends Model
{
    use HasFactory;
    protected $table="admin_panel_settings";
    protected $fillable=[
        'system_name','photo','active','general_alert','address','phone','added_by','updated_by','created_at','updated_at','com_code' 
        ];
    

}
