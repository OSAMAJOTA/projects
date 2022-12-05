<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\itemcard_cataegories;
use App\Http\Requests\Inv_itemcard_cataegoriesRequest;
use App\Models\Admin;

class Inv_itemcard_cataegories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $com_code=auth()->user()->com_code;

        $data=itemcard_cataegories::select()->where('com_code', '=', $com_code)->paginate(PAGINATION_COUNT);
       
      
        if(!empty($data)){
            
            foreach($data as $info){
                
               $info->added_by_admin=Admin::where('id',$info->added_by)->value('name');


                if($info->updated_by> 0 and $info->updated_by !=null){
                   $info->updated_by_admin=Admin::where('id',$info->updated_by)->value('name');
                }
            
            }
        }


       
       
        return view('admin.Inv_itemcard_cataegories.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Inv_itemcard_cataegories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Inv_itemcard_cataegoriesRequest $request)
    
    {
        try{
            $com_code=auth()->user()->com_code;
            //check if not exsits
            $checkExists=itemcard_cataegories::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if($checkExists==null){
        
            $data['name']=$request->name;
            $data['active']=$request->active;
           
            $data['created_at']=date("Y-m-d H:i:s");
            $data['added_by']=auth()->user()->id;
            $data['com_code']=$com_code;
            $data['date']=date("Y-m-d");
            itemcard_cataegories::create($data);
            return redirect()->route('inv_itemcard_cataegories.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);
            }else{
                return redirect()->back()
            ->with(['error'=>'عفوا اسم الفئة مسجل من قبل '])
            ->withInput(); }
    
            
            }
           
           catch(\Exception $ex)
           {
            return redirect()->route('admin.uoms.index')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
    
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $data=itemcard_cataegories::select()->find($id);
        return view('admin.Inv_itemcard_cataegories.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id,Inv_itemcard_cataegoriesRequest $request)
    {
       

        try{

            $com_code=auth()->user()->com_code;
            
            $data=itemcard_cataegories::select()->find($id);
            if(empty($data)){
                return redirect()->route('inv_itemcard_cataegories.index')->with(['error' => 'عفوا   غير قادر علي الوصول للبيانات المطلوبة' ]);

            }
            $checkExists=itemcard_cataegories::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();

            if($checkExists !=null){
                return redirect()->back()

                ->with(['error' => 'عفوا اسم الفئة مسجل من قبل ' ])
                ->withInput(); }

    $data_to_update['name']=$request->name;
    $data_to_update['active']=$request->active;
  

    $data_to_update['updated_by']=auth()->user()->id;
    $data_to_update['updated_at']=date("Y-m-d H:i:s");
    itemcard_cataegories::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
    return redirect()->route('inv_itemcard_cataegories.index')->with(['success' => ' لقد تم تحديث البيانات بنجاح ' ]);


        }
        catch(\Exception $ex)
        {
         return redirect()->route('inv_itemcard_cataegories.create')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            $itemcard_cataegories_row=itemcard_cataegories::find($id);
            if(!empty($itemcard_cataegories_row)){
            $flag=$itemcard_cataegories_row->delete();
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
}
