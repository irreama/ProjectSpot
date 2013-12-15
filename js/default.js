$(document).ready(function(){

//Handle the Interests Page

$('.tag_listing').on('change', 'input[type="checkbox"]', function(){
	console.log("Checkbox Changed");
	if($(this).is(':checked')){
		//Add it to the form
		console.log($(this).parent().html());
		$('.tag_form').append('<div class="tag_item">' + $(this).parent().html() +"</div>");
	}
	else{
		//Remove it from the form
		var id = $(this).data('id');
		$('.tag_form div input[type="checkbox"][data-id="' + id +'"]').parent().remove();
	}
})

});