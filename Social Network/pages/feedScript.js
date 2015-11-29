

$('.dropdown-div').on('click', function(event){
		$('.dropdown-div').removeClass('active');
		$(this).toggleClass('active');
		return false;
});

	//...

$(function() {

		var dd = new DropDown( $('.dd') );

		$(document).click(function() {
			// all dropdowns
			$('.dropdown-div').removeClass('active');
		});

});


/*$('#test').on('click', function(event){

	$("#fileToUpload").trigger('click');
}*/


document.getElementById('test').onclick = function() {
	console.log("teste");
}