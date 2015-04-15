//alert(555); OK
$(function(){
	$('#msgLogin').html(new Date());

	/*$( "input[type=submit], a, button" )
      .button()
      .click(function( event ) {
        event.preventDefault();
      });*/

	$('#btnLogin').click(function(event){
		event.preventDefault();
		var url='/nommali/login/login.php';
		var data=$('#frmLogin3').serializeArray();
		$.ajax({
			// url:'../login/login.php',
			url:url,
			type:'post',
			// type:'get',
			// data:$('#frmLogin3').serializeArray(),
			data:data,
			dataType:'json',
			beforeSend:function(){
				$('#frmLogin3').block();
				// $.blockUI({
				// 	message:'<h3>Loading</h3>',
				// 	css:{color:'red', background:'yellow',
				// 		 border:'none'}
				// });
			},
			error:function(xhr, textStatus){
				// alert('xhr:'+ xhr +', textStatus:'+textStatus);
				var msg = 'xhr: ' + xhr.status;
				//alert(msg);
				$('#msgLogin').html('<h4 style="color:red;">msg:' + msg+"</h4>");
			},
			complete:function(){
				$('#frmLogin3').unblock();
				// $.unblockUI();	
			},
			success:function(result){
				// $('#msgLogin').html('result:' + result);
				$('#msgLogin').html('result:' + result.msg);
				$('#welcomeAdmin').html(result.msgWelcome);
				if(result.msgWelcome !== ""){
					var logoutBtn = '<form action="/nommali/login/logout.php">';
					logoutBtn += '<input type="submit" value="ออกจากระบบ">';
					logoutBtn += '</form>';
					$('#logout').html(logoutBtn);
				}
			}
		});
	});

	$(".inputNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

});