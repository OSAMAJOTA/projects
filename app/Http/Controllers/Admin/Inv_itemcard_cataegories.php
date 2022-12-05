<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\itemcard_cataegories;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
