<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Inv_itemCard;
use App\Models\itemcard_cataegories;
use App\Models\Inv_uom;
use App\http\Requests\itemcardRequest;


class InvItemCardController extends Controller
{
    public function index(){
        // بعد انشاء المودل
        //ترتيب تصاعدي DESC
        $com_code=auth()->user()->com_code;

        $data = get_cols_where_p(new Inv_itemCard(),array("*"),array("com_code"=>$com_code), 'id', 'DESC', PAGINATION_COUNT);
       
      
        if(!empty($data)){
            
            foreach($data as $info){
                
               $info->added_by_admin=get_field_value(new Admin(),'name',array('id'=>$info->added_by));
               $info->inv_itemcard_cataegories_name=get_field_value(new itemcard_cataegories(),'name',array('id'=>$info->inv_itemcard_cataegories_id));
               $info->parent_item_name=get_field_value(new Inv_itemCard(),'name',array('id'=>$info->parent_inv_itemcard_cataegories_id));
               $info->Uom_name=get_field_value(new Inv_uom(),'name',array('id'=>$info->uom_id));
               $info->retail_uom_name=get_field_value(new Inv_uom(),'name',array('id'=>$info->retail_uom_id));



                if($info->updated_by> 0 and $info->updated_by !=null){
                   $info->updated_by_admin=get_field_value(new Admin(),'name',array('id'=>$info->updated_by));
                }
            
            }
        }
          
       
        return view('admin.inv_itemCard.index',['data'=>$data]);

    }
    public function create(){
        $com_code=auth()->user()->com_code;
        $inv_itemcard_cataegories = get_cols_where(new itemcard_cataegories(),array('id','name'),array('com_code'=>$com_code,'active'=>1),'id','DESC');
        $inv_uom_parent= get_cols_where(new inv_uom(),array('id','name'),array('com_code'=>$com_code,'active'=>1,'is_master'=>1),'id','DESC');
        $inv_uom_child= get_cols_where(new inv_uom(),array('id','name'),array('com_code'=>$com_code,'active'=>1,'is_master'=>0),'id','DESC');




        return view('admin.inv_itemCard.create',['inv_itemcard_cataegories'=>$inv_itemcard_cataegories,'inv_uom_parent'=>$inv_uom_parent,'inv_uom_child'=>$inv_uom_child]);

    }
    public function store(itemcardRequest $request ){

    }
}
