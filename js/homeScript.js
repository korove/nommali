//alert(555); OK
var CONFIG = (function() {
     var private = {
         'LOADING_TIME': '1'
     };

     return {
        get: function(name) { return private[name]; }
    };
})();

//alert('LOADING_TIME: ' + CONFIG.get('LOADING_TIME'));  // 1
function isEmpty(str) {
    return (!str || 0 === str.length);
}

$(function(){
	$('#msgLogin').html(new Date());

	$("#demo1").paginate({
		count 		: 100,
		start 		: 1,
		display     : 8,
		border					: true,
		border_color			: '#fff',
		text_color  			: '#fff',
		background_color    	: 'black',	
		border_hover_color		: '#ccc',
		text_hover_color  		: '#000',
		background_hover_color	: '#fff', 
		images					: false,
		mouse					: 'press'
	});
	$("#demo2").paginate({
		count 		: 50,
		start 		: 5,
		display     : 10,
		border					: false,
		text_color  			: '#888',
		background_color    	: '#EEE',	
		text_hover_color  		: 'black',
		background_hover_color	: '#CFCFCF'
	});
	$("#demo3").paginate({
		count 		: 50,
		start 		: 20,
		display     : 12,
		border					: true,
		border_color			: '#BEF8B8',
		text_color  			: '#68BA64',
		background_color    	: '#E3F2E1',	
		border_hover_color		: '#68BA64',
		text_hover_color  		: 'black',
		background_hover_color	: '#CAE6C6', 
		rotate      : false,
		images		: false,
		mouse		: 'press'
	});
	$("#demo4").paginate({
		count 		: 50,
		start 		: 20,
		display     : 12,
		border					: false,
		text_color  			: '#79B5E3',
		background_color    	: 'none',	
		text_hover_color  		: '#2573AF',
		background_hover_color	: 'none', 
		images		: false,
		mouse		: 'press'
	});

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