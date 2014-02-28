$(document).ready(function(){

//Handle the Interests Page
$("div").on("click", ".tag_item" function(event){
	var checkbox = $(this).children("input");
	checkbox.prop("checked", !checkbox.prop("checked"));

	if(checkbox.is(':checked')){
		//Add it to the form
		
		var new_box = '<input type="checkbox" name="tags[]" data-id="' + checkbox.data('id') + '" value="' + checkbox.data('id')+'" checked>' + checkbox.data('text');
		console.log(new_box);
		$('.chk_buff').before('<div class="tag_item">' + new_box +"</div>");
	}
	else{
		//Remove it from the form
		var id = checkbox.data('id');
		$('.tag_form div input[type="checkbox"][data-id="' + id +'"]').parent().remove();
		$('input[type="checkbox"][data-id="' + id +'"]').prop('checked', false);
	}
});

$('.tag_listing').on('change', 'input[type="checkbox"]', function(){
	console.log("Checkbox Changed");
	
})
var cookieVal = $.cookie("helpText"+window.location.pathname);
if (cookieVal == "1"){
	$(".help-text").hide();
}
$('.close').on('click', function(e){
	e.preventDefault();
	$(this).parent().hide();
	$.cookie("helpText"+window.location.pathname,"1",{expires:500});
});

});