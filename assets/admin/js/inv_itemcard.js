$(document).ready(function(){
  $(document).on('change','#dose_has_retailunit',function(e){
    var uom_id=$("#uom_id").val();

    if(uom_id==''){
alert("اختر الوحدة الاب اولا");
$("#dose_has_retailunit").val("");

return false;

    }
    if($(this).val()==1){
$("#retail_uom_idDiv").show();
var retail_uom_id=$("#retail_uom_id").val();
if(retail_uom_id !=''){
  $(".relatied_retial_counter").show();

}else{
  $(".relatied_retial_counter").hide();

}

    }else{
    $(".relatied_retial_counter").hide();
    $("#retail_uom_idDiv").hide();
    }
  });
  });


 
    $(document).on('change','#uom_id',function(e){
      if($(this).val()!=''){


        var name=$("#uom_id option:selected").text();
        $(".parentuomname").text(name);

        var dose_has_retailunit=$("#dose_has_retailunit").val();
        if(dose_has_retailunit==1){
          var retail_uom_id=$("#retail_uom_id").val();
          if(retail_uom_id !=''){
            $(".relatied_retial_counter").show();

          }else{
            $(".relatied_retial_counter").hide();

          }

         

          
              }else{
              $(".relatied_retial_counter").hide();
              $("#retail_uom_idDiv").hide();
              }
             $(".relatied_parent_counter").show();

      }else{
        $(".parentuomname").text('');
        $(".relatied_retial_counter").hide();
        $(".relatied_parent_counter").hide();
        $("#retail_uom_idDiv").hide();

      }

      });


      $(document).ready(function(){
        $(document).on('change','#retail_uom_id',function(e){
          if($(this).val()!=''){
    
    
            var name=$("#retail_uom_id option:selected").text();
            $(".chailduomname").text(name);
            $(".relatied_retial_counter").show();
         
    
          }else{
            $(".chailduomname").text('');
            $(".relatied_retial_counter").hide();
          
    
          }
    
          });

          $(document).on('click','#do_add_item_card',function(e){
      var name=$('#name').val();
      if(name==""){
        alert(" من فضلك ادخل اسم الصنف");
        $("#name").focus();
        return false;
      }
      var item_type=$('#item_type').val();
      if(item_type==""){
        alert("من فضلك ادخل نوع الصنف ");
        $("#item_type").focus();
        return false;
      }
      var inv_itemcard_cataegories_id=$('#inv_itemcard_cataegories_id').val();
      if(inv_itemcard_cataegories_id==""){
        alert("من فضلك اختار فئة الصنف ");
        $("#inv_itemcard_cataegories_id").focus();
        return false;
      }
      var uom_id=$('#uom_id').val();
      if(uom_id==""){
        alert("من فضلك اختار وحدة القياس الاب للصنف ");
        $("#uom_id").focus();
        return false;
      }
      var dose_has_retailunit=$('#dose_has_retailunit').val();
      if(dose_has_retailunit==""){
        alert("من فضلك اختار حالة هل للصنف وحدة تجزئة    ");
        $("#dose_has_retailunit").focus();
        return false;
      }
      if(dose_has_retailunit==1){

        var retail_uom_id=$('#retail_uom_id').val();
      if(retail_uom_id==""){
        alert("من فضلك اختار حالة   وحدة قياس التجزئة الابن للصنف    ");
        $("#retail_uom_id").focus();
        return false;
      }

      var retail_uom_quntToParent=$('#retail_uom_quntToParent').val();
      if(retail_uom_quntToParent=="" || retail_uom_quntToParent==0){
        alert("من فضلك ادخل عدد وحدات الوحدة التجزئة بالنسبة للاب     ");
        $("#retail_uom_quntToParent").focus();
        return false;
      }

        
      }
      var price=$('#price').val();
      if(price==""){
        alert("من فضلك ادخل سعر  القطاعي للوحدة الاب      ");
        $("#price").focus();
        return false;
      }

      var nos_gomla_price=$('#nos_gomla_price').val();
      if(nos_gomla_price==""){
        alert(" من فضلك ادخل سعر النص جملة للوحدة الاب     ");
        $("#nos_gomla_price").focus();
        return false;
      }
      var gomla_price=$('#gomla_price').val();
      if(gomla_price==""){
        alert(" من فضلك ادخل سعر  الجملة للوحدة الاب     ");
        $("#gomla_price").focus();
        return false;
      }
      var cost_price=$('#cost_price').val();
      if(cost_price==""){
        alert(" من فضلك ادخل سعر  تكلفة الشراء للوحدة الاب     ");
        $("#cost_price").focus();
        return false;
      }
      if(dose_has_retailunit==1){
//strat valid chaild price if exsists
var price_retail=$('#price_retail').val();
if(price_retail==""){
  alert("من فضلك ادخل سعر  القطاعي للوحدة التجزئة      ");
  $("#price_retail").focus();
  return false;
}

var nos_gomla_price_retail=$('#nos_gomla_price_retail').val();
if(nos_gomla_price_retail==""){
  alert(" من فضلك ادخل سعر النص جملة للوحدة التجزئة     ");
  $("#nos_gomla_price_retail").focus();
  return false;
}
var nos_gomla_retail=$('#nos_gomla_retail').val();
if(nos_gomla_retail==""){
  alert(" من فضلك ادخل سعر  الجملة للوحدة التجزئة     ");
  $("#nos_gomla_retail").focus();
  return false;
}
var cost_price_retail=$('#cost_price_retail').val();
if(cost_price_retail==""){
  alert(" من فضلك ادخل سعر  تكلفة الشراء للوحدة التجزئة     ");
  $("#cost_price_retail").focus();
  return false;
}


      }
      
      var has_fixed_price=$('#has_fixed_price').val();
if(has_fixed_price==""){
  alert(" من فضلك اختار حالة هل للصنف سعر ثابت بالفوتير      ");
  $("#has_fixed_price").focus();
  return false;
}

var active=$('#active').val();
if(active==""){
  alert(" من فضلك اختار حالة هل    الصنف مفعل      ");
  $("#active").focus();
  return false;
}
     


          });


        });
