<?php

namespace App\Http\Controllers\Admin;
use App\Models\Inv_uom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\UomsRequest;

class InvUomController extends Controller
{
    public function index(){
        // بعد انشاء المودل
        //ترتيب تصاعدي DESC
        $com_code=auth()->user()->com_code;

        $data=Inv_uom::select()->where('com_code', '=', $com_code)->paginate(PAGINATION_COUNT);
       
      
        if(!empty($data)){
            
            foreach($data as $info){
                
               $info->added_by_admin=Admin::where('id',$info->added_by)->value('name');


                if($info->updated_by> 0 and $info->updated_by !=null){
                   $info->updated_by_admin=Admin::where('id',$info->updated_by)->value('name');
                }
            
            }
        }
          
       
        return view('admin.uoms.index',['data'=>$data]);

    }
    public function create(){
        return view('admin.uoms.create');

    }

    public function store(UomsRequest $request){
        try{
        $com_code=auth()->user()->com_code;
        //check if not exsits
        $checkExists=Inv_uom::where(['name'=>$request->name,'com_code'=>$com_code])->first();
        if($checkExists==null){
    
        $data['name']=$request->name;
        $data['active']=$request->active;
        $data['is_master']=$request->is_master;
        $data['created_at']=date("Y-m-d H:i:s");
        $data['added_by']=auth()->user()->id;
        $data['com_code']=$com_code;
        $data['date']=date("Y-m-d");
        Inv_uom::create($data);
        return redirect()->route('admin.uoms.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);
        }else{
            return redirect()->back()
        ->with(['error'=>'عفوا اسم الوحدة مسجل من قبل '])
        ->withInput(); }

        
        }
       
       catch(\Exception $ex)
       {
        return redirect()->route('admin.uoms.index')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);

       }

    }
    public function update($id,UomsRequest $request){



        try{

            $com_code=auth()->user()->com_code;
            
            $data=Inv_uom::select()->find($id);
            if(empty($data)){
                return redirect()->route('admin.uoms.index')->with(['error' => 'عفوا   غير قادر علي الوصول للبيانات المطلوبة' ]);

            }
            $checkExists=Inv_uom::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();

            if($checkExists !=null){
                return redirect()->back()

                ->with(['error' => 'عفوا اسم المخزن مسجل من قبل ' ])
                ->withInput(); }

    $data_to_update['name']=$request->name;
    $data_to_update['active']=$request->active;
    $data_to_update['is_master']=$request->is_master;

    $data_to_update['updated_by']=auth()->user()->id;
    $data_to_update['updated_at']=date("Y-m-d H:i:s");
    Inv_uom::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
    return redirect()->route('admin.uoms.index')->with(['success' => ' لقد تم تحديث البيانات بنجاح ' ]);


        }
        catch(\Exception $ex)
        {
         return redirect()->route('admin.uoms.create')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
 
        }

  





    }
    public function edit($id){

        $data=Inv_uom::select()->find($id);
        return view('admin.uoms.edit',['data'=>$data]);





    }
    public function delete($id){
        try{
        $Inv_uomtypes_row=Inv_uom::find($id);
        if(!empty($Inv_uomtypes_row)){
        $flag=$Inv_uomtypes_row->delete();
        if($flag){
        return redirect()->back()
        ->with(['success'=>'تم حذف البيانات بنجاح']);
        }else{
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما']);
        }
        }else{
        return redirect()->back()
        ->with(['error'=>'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
        }
        }catch(\Exception $ex){
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
        }
        }

        public function ajax_search(Request $request){
            $com_code=auth()->user()->com_code;
            if($request->ajax()){
            $search_by_text=$request->search_by_text;
            $is_master_search=$request->is_master_search;

            if( $search_by_text==''){
                $field2="id";
                $operator2 = ">";
                $value2 = 0;
             

            }else{
                $field2="name";
                $operator2 = "LIKE";
                $value2= "%{$search_by_text}%";

            }
            



            if( $is_master_search=='all'){
                $field1="id";
                $operator1 = ">";
                $value1 = 0;
             

            }else{
                $field1="is_master";
                $operator1 = "=";
                $value1 = $is_master_search;

            }

            
            $data=Inv_uom::where( $field2,$operator2,$value2)->where($field1,$operator1,$value1)->where('com_code', '=', $com_code)->paginate(PAGINATION_COUNT);
            if(!empty($data)){
            
                foreach($data as $info){
                    
                   $info->added_by_admin=Admin::where('id',$info->added_by)->value('name');
    
    
                    if($info->updated_by> 0 and $info->updated_by !=null){
                       $info->updated_by_admin=Admin::where('id',$info->updated_by)->value('name');
                    }
                
                }
            }
            return view('admin.uoms.ajax_search',['data'=>$data]);
            }
            }
}
