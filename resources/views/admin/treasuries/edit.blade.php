@extends('layouts.admin')

@section('title')
تعديل بيانات الخزنة 
@endsection

@section('contentheader')
الخزن
@endsection


@section('contentheaderlink')
<a href="{{ route('admin.treasuries.index') }}">الخزن </a>
@endsection

@section('contentheaderacive')
تعديل 
@endsection


@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title card_title_center">تعديل بيانات خزنة </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <form action="{{ route('admin.treasuries.update',$data['id']) }}" method="post" enctype="multipart/form-data">
              @csrf
                
      <div class="form-group">
        <label>اسم الخزنة</label>
        <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}   " placeholder="ادخل اسم الخزنة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
          <label> هل رئيسية</label>
          <select name="is_master" id="is_master" class="form-control">
           <option value="">اختر النوع</option>
           <option  {{ old('is_master',$data['is_master'])==1 ? 'selected' : ''}}  value="1"> نعم</option>
           <option  {{ old('is_master',$data['is_master'])==0 ? 'selected' : ''}} value="0"> لا</option>
        
          </select>
        
          @error('is_master')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        
        
          <div class="form-group">
            <label> اخر رقم ايصال صرف نقدية لهذة الخزنة</label>
            <input oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="last_isal_exhcange" id="last_isal_exhcange" class="form-control" value="{{ old('last_isal_exhcange',$data['last_isal_exhcange']) }} " placeholder="ادخل  اخر رقم ايصال صرف" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
            @error('last_isal_exhcange')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            <div class="form-group">
              <label> اخر رقم ايصال تحصيل نقدية لهذة الخزنة</label>
              <input oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="last_isal_collect" id="last_isal_collect" class="form-control"  value=" {{ old('last_isal_collect',$data['last_isal_collect']) }} " placeholder="ادخل اخر رقم ايصال تحصيل" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
              @error('last_isal_collect')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>
        
              <div class="form-group"> 
                <label>  حالة التفعيل</label>
                <select name="active" id="active" class="form-control">
                 <option value="">اختر الحالة</option>
                 <option  {{ old('active',$data['active'])==1 ? 'selected' : ''}}  value="1"> نعم</option>
                 <option  {{ old('active',$data['active'])==0 ? 'selected' : ''}} value="0"> لا</option>
              
                @error('active')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                <a href="{{ route('admin.treasuries.index') }}" class="btn btn-sm btn-danger">الغاء</a>    



              </div>



            </form>
      
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
