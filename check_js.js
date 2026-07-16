// JavaScript Document
$("#username").keyup(function() {
	
	var uu = document.me.username.value.replace(/[&\/\\#,+()$~%.'":;*?<>{}]/g,'');

	document.me.username.value=uu;
 
});
$("#passs").keyup(function() {
	
	var pp = document.me.passs.value.replace(/[&\/\\#,+()$~%.'":;*?<>{}]/g,'');

	document.me.passs.value=pp;
 
});
function query_user(){
	
	var username = $('#username').val();
  var office = $('#office').find(":selected").val();

alert(office);

        $.ajax({
            type:'POST',
            url:'query_user.php',
          //  dataType: "json",
            data:{username:username,office:office},
            success:function(data){
				
               // if(data.status == 'ok'){
                    $('#s_id').html(data);
               //     $('#qty_theory').val(data.result.Quantity);
                
                //    $('.user-content').slideDown();
              //  }else{
                //    $('.user-content').slideUp();
                  //  alert("User not found...");
               // } 
            }
        });
	
	}