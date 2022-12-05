@extends('layouts.admin')

@section('title')
الضبط العام 
@endsection

@section('contentheader')
الضبط
@endsection


@section('contentheaderlink')
<a href="{{ route('admin.adminPanelSetting.index') }}">الضبط </a>
@endsection

@section('contentheaderacive')
عرض
@endsection


@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
     
            <h3 class="card-title card_title_center  ">بيانات الضبط العام</h3>
          
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered  table-hover">
               
                <tr>
                    <td class="width30"> اسم الشركة</td>
                    <td ><center> {{ $data['system_name'] }} </center> </td>
                </tr>
            <tr>


                    <td class="width30"> كود الشركة</td>
                    <td ><center>  {{ $data['com_code'] }}</center> </td>
                </tr>
            <tr>
                    <td class="width30"> حالة الشركة </td>
                    <td > <center> @if($data['active']==1) مفعل @else معطل @endif </center> 
                    </tr>
                    <tr>
                        <td class="width30"> عنوان الشركة </td>
                        <td > <center> {{ $data['address'] }}</center> </td>
                    </tr>
                    <tr>
                        <td class="width30"> هاتف الشركة</td>
                        <td ><center>  {{ $data['phone'] }}</center> </td>
                    </tr>
                    <tr>
                        <td class="width30"> رسالة التنبيه اعلي الشاشة </td>
                        <td > <center> {{ $data['general_alert'] }}</center> </td>
                    </tr>
                  
                    <tr>
                        <td class="width30"> لوجو الشركة</td>
                        <td > <center> 
                            <div class="image"></div>
                            <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$data['photo'] }}" alt="لوجو الشركة">

                        </center> 
                        </td>
                        <tr>
                            <td class="width30">  تاريخ اخر تحدبث</td>
                            <td>
                              <center> 
                            @if($data['updated_by']>0 and $data['updated_by']!=null)
                            @php
                                $dt=new DateTime($data['updated_at']);
                                $date=$dt->format("Y-m-d");
                                $time=$dt->format("h:i");
                                $newDateTime=date("A",strtotime($time));
                                $newDateTimeType=(($newDateTime=='AM')?'صباحا':'مساء');
                            @endphp
                            {{ $date }}
                            {{ $time }}
                            {{ $newDateTimeType }}
                            بواسطة 
                            {{ $data['updated_by_admin'] }}


                           @else
                            لا يوجد تحديث


                            @endif
                            <br>

                            <br>
                            <br>
                            <a href="{{ route('admin.adminPanelSetting.edit') }}" class="btn btn-sm nav-icon fas fa-edit btn-success">تعديل</a>
                              </center> 
                        </tr>




                </tr>
               
               
              </table>
                @else
          </div class="alert alert-danger">
          عفوآلا توجد بيانات لعرضها 
        
        </div>
            
                
            @endif
           
          </div>
        </div>
      </div>
    </div>

@endsection
