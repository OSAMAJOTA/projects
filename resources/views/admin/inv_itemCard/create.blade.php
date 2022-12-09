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
اضافه
@endsection



@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">اضافة  صنف جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
    
      <form action="{{ route('admin.inv_itemCard.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
      <div class="form-group">
<label>باركود الصنف -في حالة عدم الادخال سيولد بشكل الي </label>
<input name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" placeholder="  الباركود" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('barcode')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
  <label> اسم الصنف   </label>
  <input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="ادخل   اسم اصنف" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
  </div>
  <div class="form-group"> 
    <label>   نوع الصنف</label>
    <select name="item_type" id="item_type" class="form-control">
     <option value="">اختر النوع</option>
    <option   @if(old('item_type')==1) selected="selected"  @endif value="1"> مخزني</option>
    <option   @if(old('item_type')==2) selected="selected"  @endif value="2"> استهلاكي</option>
    <option   @if(old('item_type')==3) selected="selected"  @endif value="3"> عهدة</option>

  
    </select>
  
    @error('active')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>



      <div class="form-group"> 
        <label>  حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
         <option value="">اختر الحالة</option>
        <option   @if(old('active')==1) selected="selected"  @endif value="1"> نعم</option>
         <option @if(old('active')==0 and old('active')!="" ) selected="selected"   @endif value="0"> لا</option>
      
      
        </select>
      
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-sm"> اضافة</button>
        <a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      
      </div>
        
            
            </form>  
        
            

            </div>  

      


        </div>
      </div>
    </div>
</div>





@endsection


