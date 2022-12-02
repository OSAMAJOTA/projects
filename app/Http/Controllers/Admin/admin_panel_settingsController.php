<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin_panel_settings;
use Illuminate\Http\Request;
use App\http\Requests\Admin_panel_settings_Request;
use App\Models\Admin;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
class admin_panel_settingsController extends Controller
{
    public function index(){
        $data=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        if(!empty($data)){
            if($data['updated_by']>0 and $data['updated_by'] !=null){
                $data['updated_by_admin']=Admin::where('id',$data['updated_by'])->value('name');
            }
        }
        return view('admin.admin_panel_settings.index',['data'=>$data]);
    }
    

    public function edit(){
        $data=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        return view('admin.admin_panel_settings.edit',['data'=>$data]);

    }
    
    public function update(Admin_panel_settings_Request $request){
        try{
            $admin_panel_settings=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
            $admin_panel_settings->system_name=$request->system_name;
            $admin_panel_settings->address=$request->address;
            $admin_panel_settings->phone=$request->phone;
            $admin_panel_settings->general_alert=$request->general_alert;
            $admin_panel_settings->updated_by=auth()->user()->id;
            $admin_panel_settings->updated_at=date("Y-m-d H:i:s");
            $oldphotoPath=$admin_panel_settings->photo;
            if($request->has('photo')){

            $request->validate([
                'photo' => 'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path = uploadImage('assets/admin/uploads', $request->photo);

            $admin_panel_settings->photo=$the_file_path;

               if(file_exists('assets/admin/uploads/'.$oldphotoPath)){

                unlink('assets/admin/uploads/'.$oldphotoPath);
            }
           
            


            }
            $admin_panel_settings->save();
            return redirect()->route('admin.adminPanelSetting.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
            } catch (\Exception $ex) {
            return redirect()->route('admin.adminPanelSetting.index')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
            }
            }
            }
