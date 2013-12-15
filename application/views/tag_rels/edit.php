<pre>
<?php
	//print_r($tag_item);
?>
</pre>
<div class="page-title">
	<h2>Edit Interests</h2>
</div>
<div class="left_col">
	<div>
		My Interests
	</div>
	<div class="tag_form_container tag_listing">
	<?php
	//Open our form

	$attributes = array(
		'class' => 'tag_form'
	);
	echo form_open('profile/interests/edit/'.$tag_item['item_id'], $attributes);
	//Hidden ID Field
	echo form_hidden('id', $tag_item['item_id']);
	foreach($tag_item['user_tags'] as $a_user_tag){

	}
	?>
	<input type="submit" name="submit" value="Save Interests" />
	<?php
	echo form_close();
	?>
	</div>

</div><!--left column-->

<div class="right_col">
	<div>
		Available Interests
	</div>
	<div class="tag_listing">
	<?php 
	foreach($tag_item['tags'] as $a_tag){
	?>
	<div class="tag_item">
		<input type="checkbox" name="tag" data-id="<?php echo $a_tag['id'];?>" data-text="<?php echo $a_tag['tag_text'];?>"><?php echo $a_tag['tag_text'];?>
	</div>
	<?php
	}
	?>
	</div>
</div><!--right column-->