var udd = new DropDown( $('#user-dd') );

$('#loutForm').hover(function(){
    $('#user-dd').css({
 		'opacity' : '1',
 		'pointer-events' : 'auto',
 		'z-index' : '1'
   });
}, function(){
    $('#user-dd').css({
 		'opacity' : '0',
 		'pointer-events' : 'none',
 		'z-index' : '1'
   });
});






