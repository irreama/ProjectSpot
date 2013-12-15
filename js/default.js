$(document).ready(function(){

//Handle the Interests Page

$('.tag_item input[type="checkbox"]').change(function(){
	if($(this).checked){
		//Add it to the form
		
		$('.tag_form').append('<div class="tag_item">' + $(this).parent().html() +"</div>");
	}
	else{
		//Remove it from the form
		var id = $(this).data('id');
		$('.tag_form div input[type="checkbox"][data-id="' + id +'"]').parent().remove();
	}
})

});