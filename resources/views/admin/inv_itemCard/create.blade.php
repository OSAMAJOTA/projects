@extends('layouts.admin')
@section('title')
اضافة صنف
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


   
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">اضافة  صنف جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
     
         <form action="{{ route('admin.inv_itemCard.store') }}" method="post" enctype="multipart/form-data">
          <div class="row">
        @csrf
        
        <div class="col-md-6">
        
      <div class="form-group">
<label>باركود الصنف -في حالة عدم الادخال سيولد بشكل الي </label>
<input name="barcode" id="barcode" class="form-control" value="{{ old('barcode') }}" placeholder="  الباركود" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('barcode')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
  <label> اسم الصنف   </label>
  <input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="ادخل   اسم اصنف"  oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
  </div>
</div>
<div class="col-md-6">
  <div class="form-group"> 
    <label>   نوع الصنف</label>
    <select name="item_type" id="item_type" class="form-control">
     <option value="">اختر النوع</option>
    <option   @if(old('item_type')==1) selected="selected"  @endif value="1"> مخزني</option>
    <option   @if(old('item_type')==2) selected="selected"  @endif value="2">  استهلاكي منتهي بصلاحية</option>
    <option   @if(old('item_type')==3) selected="selected"  @endif value="3"> عهدة</option>

  
    </select>
  
    @error('item_type')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group"> 
      <label>   فئة الصنف</label>
      <select name="inv_itemcard_cataegories_id" id="inv_itemcard_cataegories_id" class="form-control ">
        <option value="">اختر الفئة</option>
        @if (@isset($inv_itemcard_cataegories) && !@empty($inv_itemcard_cataegories))
       @foreach ($inv_itemcard_cataegories as $info )
         <option @if(old('inv_itemcard_cataegories_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
       @endforeach
        @endif
       </select>
    
      @error('inv_itemcard_cataegories_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group"> 
        <label>   الصنف الاب له</label>
        <select name="parent_inv_itemcard_cataegories_id" id="parent_inv_itemcard_cataegories_id" class="form-control ">
          <option selected value="0"> هو اب</option>
          @if (@isset($item_card_data) && !@empty($item_card_data))
         @foreach ($item_card_data as $info )
           <option @if(old('parent_inv_itemcard_cataegories_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
         @endforeach
          @endif
         </select>
      
        @error('parent_inv_itemcard_cataegories_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
    <div class="col-md-6">
      <div class="form-group"> 
        <label>    وحدة قياس الاب</label>
        <select name="uom_id" id="uom_id" class="form-control ">
          <option value="">اختر الوحدة الاب</option>
          @if (@isset($inv_uom_parent) && !@empty($inv_uom_parent))
         @foreach ($inv_uom_parent as $info )
           <option @if(old('uom_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
         @endforeach
          @endif
         </select>
      
        @error('uom_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group"> 
          <label>    هل للصنف وحدة تجزئة</label>
          <select name="dose_has_retailunit" id="dose_has_retailunit" class="form-control">
           <option value="">اختر الحالة</option>
          <option   @if(old('dose_has_retailunit')==1) selected="selected"  @endif value="1"> نعم</option>
          <option @if(old('dose_has_retailunit')==0 and old('dose_has_retailunit')!="" ) selected="selected"   @endif value="0"> لا</option>

      
        
          </select>
        
          @error('dose_has_retailunit')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>
        <div class="col-md-6 "  @if(old('dose_has_retailunit')!=1) style="display:none;"@else   @endif   id="retail_uom_idDiv">
          <div class="form-group"> 
            <label>    وحدة قياس التجزئة الابن بالنسبة (<span class="parentuomname"></span>)</label>
            <select name="retail_uom_id" id="retail_uom_id" class="form-control ">
              <option value="">اختر الوحدة لابن</option>
              @if (@isset($inv_uom_child) && !@empty($inv_uom_child))
             @foreach ($inv_uom_child as $info )
               <option @if(old('retail_uom_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
             @endforeach
              @endif
             </select>
          
            @error('retail_uom_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div>
          <div class="col-md-6 relatied_retial_counter"  @if(old('retail_uom_id')!=1) style="display:none;"@else   @endif>

  <div class="form-group">
    <label>   عدد وحدات التجزئة (<span class="chailduomname"></span>)  بالنسبة للاب (<span class="parentuomname"></span>) </label>
    <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="retail_uom_quntToParent" id="retail_uom_quntToParent" class="form-control"  value="{{ old('retail_uom_quntToParent') }}" placeholder="ادخل  اخر رقم ايصال صرف" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
    @error('retail_uom_quntToParent')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
  </div>

  <div class="col-md-6 relatied_parent_counter"  @if(old('uom_id')!=1) style="display:none;"@else   @endif>

    <div class="form-group">
      <label> السعر القطاعي بوحدة(<span class="parentuomname"></span>) </label>
      <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="price" id="price" class="form-control"  value="{{ old('price') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
      @error('price')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>
    
  <div class="col-md-6 relatied_parent_counter"  @if(old('uom_id')!=1) style="display:none;"@else   @endif>

    <div class="form-group">
      <label> السعر نص جملة بوحدة(<span class="parentuomname"></span>) </label>
      <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="nos_gomla_price" id="nos_gomla_price" class="form-control"  value="{{ old('nos_gomla_price') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
      @error('nos_gomla_price')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>
    <div class="col-md-6 relatied_parent_counter"  @if(old('uom_id')!=1) style="display:none;"@else   @endif>

      <div class="form-group">
        <label> السعر  جملة بوحدة(<span class="parentuomname"></span>) </label>
        <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="gomla_price" id="gomla_price" class="form-control"  value="{{ old('nos_gomla_price') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
        @error('gomla_price')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
      <div class="col-md-6 relatied_parent_counter"  @if(old('uom_id')!=1) style="display:none;"@else   @endif>

        <div class="form-group">
          <label> السعر  تكلفة شراء بوحدة(<span class="parentuomname"></span>) </label>
          <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="cost_price" id="cost_price" class="form-control"  value="{{ old('nos_gomla_price') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
          @error('cost_price')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>

        <div class="col-md-6 relatied_retial_counter" @if(old('retail_uom_id')!=1) style="display:none;"@else   @endif>

    <div class="form-group">
      <label> السعر القطاعي بوحدة(<span class="chailduomname"></span>) </label>
      <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="price_retail" id="price_retail" class="form-control"  value="{{ old('price_retail') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
      @error('price_retail')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>
    </div>
    <div class="col-md-6 relatied_retial_counter" @if(old('retail_uom_id')!=1) style="display:none;"@else   @endif>

      <div class="form-group">
        <label> السعر النص جملة بوحدة(<span class="chailduomname"></span>) </label>
        <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="nos_gomla_price_retail" id="nos_gomla_price_retail" class="form-control"  value="{{ old('nos_gomla_price_retail') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
        @error('nos_gomla_price_retail')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
      <div class="col-md-6 relatied_retial_counter" @if(old('retail_uom_id')!=1) style="display:none;"@else   @endif>

        <div class="form-group">
          <label> السعر الجملة بوحدة(<span class="chailduomname"></span>) </label>
          <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="gomla_price_retail" id="gomla_price_retail" class="form-control"  value="{{ old('gomla_price_retail') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
          @error('gomla_price_retail')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>

        <div class="col-md-6 relatied_retial_counter" @if(old('retail_uom_id')!=1) style="display:none;"@else   @endif>

          <div class="form-group">
            <label> السعر الشراء بوحدة(<span class="chailduomname"></span>) </label>
            <input oninput="this.value=this.value.replace(/[^0-9.]/g,'');" name="cost_price_retail" id="cost_price_retail" class="form-control"  value="{{ old('cost_price_retail') }}" placeholder="ادخل  السعر" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
            @error('cost_price_retail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group"> 
              <label>   هل للصنف سعر ثابت</label>
              <select name="has_fixed_price" id="has_fixed_price" class="form-control">
               <option value="">اختر الحالة</option>
              <option   @if(old('has_fixed_price')==1) selected="selected"  @endif value="1">نعم ثابت ولا يتغير بالفواتير</option>
               <option @if(old('has_fixed_price')==0 and old('has_fixed_price')!="" ) selected="selected"   @endif value="0">  لا غير ثابت ويتغير بالفواتير</option>
            
            
              </select>
            
              @error('has_fixed_price')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>
            </div>

  <div class="col-md-6">
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
      </div>
      <div class="col-md-6" style="border:solid 2px #000 ; margin:10px;">
        <div class="form-group"> 
          <label>   صورة الصنف اذا وجدت</label>
          <img id="uploadedimg" src="#" alt="uploaded img" style="width: 200px; width:200px;">
         <input onchange="readURL(this)" type="file" id="Item_img" name="Item_img" class="form-control">
        
          </select>
        
          @error('active')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
        </div>
      <div class="col-md-12">
      <div class="form-group text-center">
        <button type="submit" id="do_add_item_card" class="btn btn-primary btn-sm"> اضافة</button>
        <a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      
      </div> 
    </div>
    
  </div> 
            
            </form>  
        

            </div>  

      


        </div>
      </div>






@endsection

<script type="text/javascript">
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#uploadedimg').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
</script> 
@section('scrip')
<script src="{{ asset('assets/admin/js/inv_itemcard.js') }}"></script>

@endsection

