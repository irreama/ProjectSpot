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

<?php
echo form_open('/index.php/profile/interests/edit/'.$tag_item['item_id']);
//Hidden ID Field
echo form_hidden('id', $tag_item['item_id']);
foreach($tag_item['user_tags'] as $a_user_tag){

}
echo form_close();
?>


</div><!--left column-->

<div class="right_col">
	<div>
		Available Interests
	</div>
	<?php 
	foreach($tag_item['tags'] as $a_tag){
	?>
	<div>
		<input type="checkbox" name="tag" data-id="<?php echo $a_tag['id'];?>" data-text="<?php echo $a_tag['tag_text'];?>"><?php echo $a_tag['tag_text'];?>
	</div>
	<?php
	}
	?>
	<a href="/index.php/edit_student"><button class="edit">Save Interests</button></a>
</div><!--right column-->