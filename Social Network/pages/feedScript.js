

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