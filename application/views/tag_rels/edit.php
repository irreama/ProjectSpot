<pre>
<?php
	print_r($tag_item);
?>
</pre>
<div class="page-title">
	<h2>Edit Interests</h2>
</div>
<div class="left_col">

<?php
echo form_open('profile/edit/'.$profile_item['id']);
//Hidden ID Field
echo form_hidden('id', $tag_item['item_id']);
foreach($tag_item['user_tags'] as $a_user_tag);
?>


</div><!--left column-->

<div class="right_col">
	<a href="/index.php/edit_student"><button class="edit">Save Interests</button></a>
</div><!--right column-->