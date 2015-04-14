//alert(555); OK
$(function(){
	$('#msgLogin').html(new Date());

	$('#btnLogin').click(function(event){
		event.preventDefault();
		// alert('hostname:'+location.hostname);
		// alert('pathname:'+location.pathname);
		// alert('href:'+location.href);
		var url=location.pathname+'login/login.php';
		// url = 'login.php';
		// var data="?name=555"
		var data=$('#frmLogin3').serializeArray();
		// var data=$('#frmLogin3').serialize();
		// alert('url='+url)
		$.ajax({
			// url:'../login/login.php',
			url:url,
			type:'post',
			// type:'get',
			// data:$('#frmLogin3').serializeArray(),
			data:data,
			// data:data,
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
				alert(msg);
				//$('#msgLogin').html('msg:' + msg);
			},
			complete:function(){
				$('#frmLogin3').unblock();
				// $.unblockUI();	
			},
			success:function(result){
				$('#msgLogin').html('result:' + result);
			}
		});
	});
});