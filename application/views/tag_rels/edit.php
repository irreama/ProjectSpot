<link rel="stylesheet" type="text/css" href="/stylesheets/interests.css">
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
	echo form_open($tag_item['type'].'/interests/edit/'.$tag_item['item_id'], $attributes);
	//Hidden ID Field
	echo form_hidden('id', $tag_item['item_id']);
	if(!empty($tag_item['item_tags'])){
		foreach($tag_item['item_tags'] as $a_tag){
	?>
	<div class="tag_item">
		<input type="checkbox" name="tags[]" data-id="<?php echo $a_tag['id'];?>" value="<?php echo $a_tag['id'];?>" checked><?php echo $a_tag['tag_text'];?>
	</div>
	<?php
		}
	}
	?>
	<div class="chk_buff"></div>
	<div class="interest-buttons">
		<a class="button-element-small cancel" href="/index.php/<?php echo $tag_item['type'];?>/edit/<?php echo $tag_item['item_id'];?>">Cancel</a>
		<input class="button-element-small edit" type="submit" name="submit" value="Save Interests" />
	</div>
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
		<input type="checkbox" name="tag" data-id="<?php echo $a_tag['id'];?>" data-text="<?php echo $a_tag['tag_text'];?>"<?php
		if(!empty($tag_item['item_tags'])){
			echo (in_array($a_tag, $tag_item['item_tags']) ? "checked" : "");
		}
		?>><?php echo $a_tag['tag_text'];?>
	</div>
	<?php
	}
	?>
	</div>
</div><!--right column-->
<p class="clear"></p>