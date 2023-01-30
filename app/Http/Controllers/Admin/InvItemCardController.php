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
        $item_card_data= get_cols_where(new Inv_itemCard(),array('id','name'),array('com_code'=>$com_code,'active'=>1),'id','DESC');




        return view('admin.inv_itemCard.create',['inv_itemcard_cataegories'=>$inv_itemcard_cataegories,'inv_uom_parent'=>$inv_uom_parent,'inv_uom_child'=>$inv_uom_child,'item_card_data'=>$item_card_data]);

    }
    public function store(itemcardRequest $request ){
        try{
        $com_code=auth()->user()->com_code;
//set item code for itemcard
$row=get_cols_where_row_orderby(new Inv_itemCard(),array('item_code'),array('com_code'=>$com_code),'id','DESC');
if(!empty($row)){
    $data_insert['item_code']=$row['item_code']+1;
}else{
    $data_insert['item_code']=1;
}


        //check if not exsits for barcode
        if($request->barcode!=''){
            $checkExists_barcode=Inv_itemCard::where(['barcode'=>$request->barcode,'com_code'=>$com_code])->first();
            if(!empty($checkExists_barcode)){

                return redirect()->back()
                ->with(['error'=>'عفؤآ باركود الصنف مسجل من قبل '])
                ->withInput();
            }else{
                $data_insert['barcode']=$request->barcode;
            }
}else{
                $data_insert['barcode']='00000-0'.$data_insert['item_code'];
            }
    
        
//check if not exsits for name
        if($request->name!=''){
            $checkExists_name=Inv_itemCard::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if(!empty($checkExists_name)){

                return redirect()->back()
                ->with(['error'=>'
                عفؤآ اسم  الصنف مسجل من قبل '])
                ->withInput();
            }
            $data_insert['name']=$request->name;
            $data_insert['item_type']=$request->item_type;
            $data_insert['inv_itemcard_cataegories_id']=$request->inv_itemcard_cataegories_id;
            $data_insert['uom_id']=$request->uom_id;
            $data_insert['price']=$request->price;
            $data_insert['nos_gomla_price']=$request->nos_gomla_price;
            $data_insert['gomla_price']=$request->gomla_price;
            $data_insert['cost_price']=$request->cost_price;
            $data_insert['parent_inv_itemcard_cataegories_id']=$request->parent_inv_itemcard_cataegories_id;

if( $data_insert['parent_inv_itemcard_cataegories_id']==""){
    $data_insert['parent_inv_itemcard_cataegories_id']=0;
}


//هل للصنف وحدة تجزئة
$data_insert['dose_has_retailunit']=$request->dose_has_retailunit;
           if($data_insert['dose_has_retailunit']==1){
            $data_insert['retail_uom_quntToParent']=$request->retail_uom_quntToParent;
            $data_insert['price_retail']=$request->price_retail;
            $data_insert['nos_gomla_price_retail']=$request->nos_gomla_price_retail;
            $data_insert['gomla_retail']=$request->gomla_price_retail;
            $data_insert['cost_price_retail']=$request->cost_price_retail;
           


           }
           $data_insert['has_fixed_price']=$request->has_fixed_price;
           $data_insert['active']=$request->active;
           //insert image


           if($request->has('Item_img')){

            $request->validate([
                'Item_img' => 'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path = uploadImage('assets/admin/uploads', $request->Item_img);

            $data_insert['photo']=$the_file_path;

          
           
            


            }
         
           
            $data_insert['created_at']=date("Y-m-d H:i:s");
            $data_insert['added_by']=auth()->user()->id;
            $data_insert['com_code']=$com_code;
            $data_insert['date']=date("Y-m-d ");



            Inv_itemCard::create($data_insert);
            return redirect()->route('admin.inv_itemCard.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);



    
        }
     } catch(\Exception $ex){
            return redirect()->back()
            ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
            }

        }
        
     
}
