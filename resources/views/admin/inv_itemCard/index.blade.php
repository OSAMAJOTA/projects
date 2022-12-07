@extends('layouts.admin')
@section('title')
الضبط المخازن
@endsection

@section('contentheader')
الاصناف
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.inv_itemCard.index') }}">  الاصناف </a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات   المخازن</h3>
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('admin.inv_itemCard.ajax_search') }}">
        
          <a href="{{ route('admin.inv_itemCard.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
     
        <div id="ajax_responce_serarchDiv">
          
          @if (@isset($data) && !@empty($data))
          @php
           $i=1;   
          @endphp
          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
           <th>مسلسل</th>
           <th>الاسم </th>
           <th> النوع </th>
           <th>  الفئة</th>
           <th>  الصنف الاب</th>
           <th>  الوحدة الاب</th>
           <th>  الوحدة التجزئة</th>
           <th>حالة التفعيل</th>
         
           <th></th>

            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>
             <td>{{ $i }}</td>  
             <td>{{ $info->name }}</td>  
             <td>{{ $info->phone }}</td>  
             <td>{{ $info->address }}</td>  
             <td>@if($info->active==1) مفعل @else معطل @endif</td> 
             <td > 
     
              @php
             $dt=new DateTime($info->created_at);
             $date=$dt->format("Y-m-d");
             $time=$dt->format("h:i");
             $newDateTime=date("A",strtotime($time));
             $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
              @endphp
          {{ $date }} <br>
          {{ $time }}
          {{ $newDateTimeType }}  <br>
          بواسطة 
          {{ $info->added_by_admin}}
          
          
                          </td>
                          
     <td > 
  @if($info->updated_by>0 and $info->updated_by!=null )
                         @php
                        $dt=new DateTime($info->updated_at);
                        $date=$dt->format("Y-m-d");
                        $time=$dt->format("h:i");
                        $newDateTime=date("A",strtotime($time));
                        $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                         @endphp
                     {{ $date }}  <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     بواسطة 
                     {{ $data['updated_by_admin'] }}
                          @else
                     لايوجد تحديث
                            @endif
                     
       </td>           

             
         <td>


        <a href="{{ route('admin.inv_itemCard.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
        <a href="{{ route('admin.inv_itemCard.delete',$info->id) }}" class="btn btn-sm are_you_shue btn-danger">حزف</a> 
   
         </td>
           
   
           </tr> 
      @php
         $i++; 
      @endphp
         @endforeach
   
   
   
            </tbody>
             </table>
      <br>
           {{ $data->links() }}
       
           @else
           <div class="alert alert-danger">
             عفوا لاتوجد بيانات لعرضها !!
           </div>
                 @endif

        </div>
      
      
      


        </div>
      </div>
    </div>
</div>





@endsection

@section('script')
<script src="{{ asset('assets/admin/js/treasuries.js') }}"></script>

@endsection

