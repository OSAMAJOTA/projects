<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TreasuriesController;
use App\Http\Controllers\Admin\StoresContrroller;
use App\Http\Controllers\Admin\InvUomController;
use App\Http\Controllers\Admin\Inv_itemcard_cataegories;



use App\Http\Controllers\Admin\Sales_matrial_typesController;

use App\Http\Controllers\Admin\admin_panel_settingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('PAGINATION_COUNT',5);
Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function () {
Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

Route::get('/adminPanelSetting/index',[admin_panel_settingsController::class,'index'])->name('admin.adminPanelSetting.index');
Route::get('/adminPanelSetting/edit',[admin_panel_settingsController::class,'edit'])->name('admin.adminPanelSetting.edit');
Route::post('/adminPanelSetting/update', [admin_panel_settingsController::class, 'update'])->name('admin.adminPanelSetting.update');
/*    START treasuries     */

Route::get('/treasuries/index', [TreasuriesController::class, 'index'])->name('admin.treasuries.index');
Route::get('/treasuries/create', [TreasuriesController::class, 'create'])->name('admin.treasuries.create');
Route::post('/treasuries/store', [TreasuriesController::class, 'store'])->name('admin.treasuries.store');
Route::get('/treasuries/edit/{id}', [TreasuriesController::class, 'edit'])->name('admin.treasuries.edit');
Route::post('/treasuries/update/{id}', [TreasuriesController::class, 'update'])->name('admin.treasuries.update');
Route::post('/treasuries/ajax_search', [TreasuriesController::class, 'ajax_search'])->name('admin.treasuries.ajax_search');
Route::get('/treasuries/details/{id}', [TreasuriesController::class, 'details'])->name('admin.treasuries.details');
Route::get('/treasuries/add_treasuries_delivery/{id}', [TreasuriesController::class, 'add_treasuries_delivery'])->name('admin.treasuries.add_treasuries_delivery');
Route::post('/treasuries/store_treasuries_delivery/{id}', [TreasuriesController::class, 'store_treasuries_delivery'])->name('admin.treasuries.store_treasuries_delivery');
Route::get('/treasuries/delete_treasuries_delivery/{id}', [TreasuriesController::class, 'delete_treasuries_delivery'])->name('admin.treasuries.delete_treasuries_delivery');
/*      end treasuries     */

/*    START sales_matrial_types     */
Route::get('/sales_matrial_types/index', [Sales_matrial_typesController::class, 'index'])->name('admin.sales_matrial_types.index');
Route::get('/sales_matrial_types/create', [Sales_matrial_typesController::class, 'create'])->name('admin.sales_matrial_types.create');
Route::post('/sales_matrial_types/store', [Sales_matrial_typesController::class, 'store'])->name('admin.sales_matrial_types.store');
Route::get('/sales_matrial_types/edit/{id}', [Sales_matrial_typesController::class, 'edit'])->name('admin.sales_matrial_types.edit');
Route::post('/sales_matrial_types/update/{id}', [Sales_matrial_typesController::class, 'update'])->name('admin.sales_matrial_types.update');
Route::get('/sales_matrial_types/delete/{id}', [Sales_matrial_typesController::class, 'delete'])->name('admin.sales_matrial_types.delete');





/*      end sales_matrial_types     */




/*    START Stores     */
Route::get('/stores/index', [StoresContrroller::class, 'index'])->name('admin.stores.index');
Route::get('/stores/create', [StoresContrroller::class, 'create'])->name('admin.stores.create');
Route::post('/stores/store', [StoresContrroller::class, 'store'])->name('admin.stores.store');
Route::get('/stores/edit/{id}', [StoresContrroller::class, 'edit'])->name('admin.stores.edit');
Route::post('/stores/update/{id}', [StoresContrroller::class, 'update'])->name('admin.stores.update');
Route::get('/stores/delete/{id}', [StoresContrroller::class, 'delete'])->name('admin.stores.delete');





/*      end Stores     */


/*    START Uoms    الوحدات */
Route::get('/uoms/index', [InvUomController::class, 'index'])->name('admin.uoms.index');
Route::get('/uoms/create', [InvUomController::class, 'create'])->name('admin.uoms.create');
Route::post('/uoms/store', [InvUomController::class, 'store'])->name('admin.uoms.store');
Route::get('/uoms/edit/{id}', [InvUomController::class, 'edit'])->name('admin.uoms.edit');
Route::post('/uoms/update/{id}', [InvUomController::class, 'update'])->name('admin.uoms.update');
Route::get('/uoms/delete/{id}', [InvUomController::class, 'delete'])->name('admin.uoms.delete');
Route::post('/uoms/ajax_search', [InvUomController::class, 'ajax_search'])->name('admin.uoms.ajax_search');

/*      end Uoms   الوحدات  */

/*    START inv_itemcard_cataegories*/

    Route::resource('/inv_itemcard_cataegories',Inv_itemcard_cataegories::class);



/*      end inv_itemcard_cataegories
   */



});
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'guest:admin'],function(){
Route::get('login',[LoginController::class,'show_login_view'])->name('admin.showlogin');
Route::post('login',[LoginController::class,'login'])->name('admin.login');
    
    });



