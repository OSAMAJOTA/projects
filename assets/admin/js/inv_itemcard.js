$(document).ready(function(){
  $(document).on('change','#dose_has_retailunit',function(e){
    var uom_id=$("#uom_id").val();

    if(uom_id==''){
alert("اختر الوحدة الاب اولا");
$("#dose_has_retailunit").val("");

return false;

    }
    if($(this).val()==1){
$(".relatied_retial_counter").show();

    }else{
    $(".relatied_retial_counter").hide();
    }
  });
  });


  $(document).ready(function(){
    $(document).on('change','#uom_id',function(e){
      if($(this).val()!=''){


        var name=$("#uom_id option:selected").text();
        $(".parentuomname").text(name);

        var dose_has_retailunit=$("#dose_has_retailunit").val();
        if(dose_has_retailunit==1){
          $(".relatied_retial_counter").show();
          
              }else{
              $(".relatied_retial_counter").hide();
              }
      }else{
        $(".parentuomname").text('');
        $(".relatied_retial_counter").hide();

      }

      });
    });