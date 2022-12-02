<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasuries_delivery extends Model
{
    use HasFactory;
    protected $table="treasuries_delivery";
    protected $fillable=[
        'treasuries_id','treasuries_can_delivery_id','created_at','added_by','updated_by','updated_at','com_code'
        ];
    
}
