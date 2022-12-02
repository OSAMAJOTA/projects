






$(document).ready(function(){
    $(document).on('input','#search_by_text',function(e){
    var search_by_text=$(this).val();
    var token_search=$("#token_search").val();
    var ajax_search_url=$("#ajax_search_url").val();
    
    jQuery.ajax({
      url:ajax_search_url,
      type:'post',
      dataType:'html',
      cache:false,
      data:{search_by_text:search_by_text,"_token":token_search},
      success:function(data){
     
       $("#ajax_responce_serarchDiv").html(data);
      },
      error:function(){
    
      }
    });
    
    
    });
    
    $(document).on('click','#ajax_pagination_in_search a ',function(e){
    e.preventDefault();
    var search_by_text=$("#search_by_text").val();
    var url=$(this).attr("href");
    var token_search=$("#token_search").val();
    
    jQuery.ajax({
      url:url,
      type:'post',
      dataType:'html',
      cache:false,
      data:{search_by_text:search_by_text,"_token":token_search},
      success:function(data){
     
       $("#ajax_responce_serarchDiv").html(data);
      },
      error:function(){
    
      }
    });
    
   
    
    });

    $(document).on('click','.are_you_shue',function(e){
        var res =confirm("هل انت متأكد ؟");
        if(!res)
        {
          return false;
        }
        });


        $(document).on('click','#update_image',function(e){
            e.preventDefault();
            if(!$("#photo").length){ 
         $("#update_image").hide();
        $("#cancel_update_image").show();
          $("#oldimage").html('<br><input type="file" onchange="readURL(this)"  name="photo" id="photo" > ');
        
            }
        return false;
        });
        
        $(document).on('click','#cancel_update_image',function(e){
            e.preventDefault();
          
         $("#update_image").show();
        $("#cancel_update_image").hide();
          $("#oldimage").html('');
        
         
        return false;
        });


        
    });