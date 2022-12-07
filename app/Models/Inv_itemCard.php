<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_itemCard extends Model
{
    use HasFactory;
    protected $table="inv_itemcard";
    protected $fillable=[
        'name','item_type','inv_itemcard_cataegories_id','parent_inv_itemcard_cataegories_id','dose_has_retailunit','retail_uom','uom_id','retail_uom_quntToParent','created_at','updated_at','added_by','updated_by','com_code','date','active','item_code','barcode'
        ];
}
