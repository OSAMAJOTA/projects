<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
 public function show_login_view(){
 return view('admin.auth.login');


  }
  
  public function login(LoginRequest $request){
    if(auth()->guard('admin')->attempt(['username'=>$request->input('username'),'password'=>$request->input('password')]))
 {
  return redirect()->route('admin.dashboard'); 

 }



  }

  public function logout(){
    auth()->logout();
    return redirect()->route('admin.showlogin');
   }




/*php artisan tinker

function make_new_admin(){
$admin=new App\Models\Admin();
$admin->name='ahmed';
$admin->email='test@gmail.com';
$admin->username='12345';
$admin->password=bcrypt("admin");
$admin->com_code=5;
$admin->save();

}
*/


}