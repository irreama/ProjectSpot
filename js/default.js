$(document).ready(function(){

//Handle the Interests Page

$('.tag_listing').on('change', 'input[type="checkbox"]', function(){
	console.log("Checkbox Changed");
	if($(this).is(':checked')){
		//Add it to the form
		
		var new_box = '<input type="checkbox" data-id="' + $(this).data('id') + '" value="' + $(this).data('id')+'" checked>' + $(this).data('text');
		console.log(new_box);
		$('.tag_form').append('<div class="tag_item">' + new_box +"</div>");
	}
	else{
		//Remove it from the form
		var id = $(this).data('id');
		$('.tag_form div input[type="checkbox"][data-id="' + id +'"]').parent().remove();
	}
})

});