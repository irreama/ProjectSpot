<pre>
<?php
//print_r($group_item);
?>
</pre>

<div class="page-title">
	<h2>Edit Group Page</h2>
	<hr>
</div>
<div class="left_col">
	<img id="groupAvatar" src="<?=base_url()?><?=($group_item['group_avatar'] ? $group_item['group_avatar'] : "images/no_profile_icon2.png")?>" width=200 height=200 alt="profile image"/>
	<form id="avatarForm" method="post" enctype="multipart/form-data">
		<div class="button-element-small special-button">
			<label>Upload an Image</label>
			<input id="chooseAvatar" name="userfile" type="file" />
			<input type="hidden" name="gid" value="<?=$group_item['id']?>"/>
		</div>
		<input id="clearAvatar" class="button-element-small full-width" type="button" value="Clear Image"/>
	</form>
</div><!--left column-->

<div class="right_col">
	<?php
	//Start Generating form fields and their data
	echo form_open('group/edit/'.$group_item['id']);
	//Hidden ID Field
	echo form_hidden('id', $group_item['id']);
	?>
	<div class="info">
		<div class="basic_info">
			<label class="title">Project Title:</label>
			<input class="input_field input_width" type="text" name="group_name" value="<?php echo $group_item['group_name'];?>"/>
			<div>
				<?php
				foreach($group_item['users'] as $a_user){
				?>
				<label class="title"><?php echo($a_user['user_status'] == "Advisor" ? "Advisor" : $a_user['user_major1']['major_text']);?>:</label><label><?php echo $a_user['user_first_name'];?> <?php echo $a_user['user_last_name'];?></label>
				<?php
				}
			?>
			</div>
		</div>
		
		<div class="interests">
			<label class="title">Interests:</label>
			<?php
				$tag_array = array();
				foreach ($group_item['tags'] as $tag){
					$tag_array[] = $tag['tag_text'];
				}
				echo implode(',&nbsp;', $tag_array);
			?>
			<a class="button-element-small" href="<?=base_url()?>index.php/group/interests/edit/<?php echo $group_item['id']?>">Edit Interests</a>
		</div>
		
		<div class="description">
			<label class="title">Give a description of your group:</label>
			<textarea class="input_field full_width" rows=5 name="group_description"><?php echo $group_item['group_description'];?></textarea>
		</div>
		
		<div class="contact">
			<label class="title">Contact:</label><input class="input_field input_width" type="text" name="group_contact" value="<?php echo $group_item['group_contact'];?>"/>
		</div>
		
		<div class="button_panel">
			<a class="button-element-small cancel" href="<?=base_url()?>index.php/group/view/<?php echo $group_item['id']?>">Cancel</a>
			<input class="button-element-small edit" type="submit" name="submit" value="Save" />
		</div>
	</div>
	</form>
</div><!--right column-->
<p class="clear"></p>
<script type="text/javascript">
$(document).ready(function(){
	$("#chooseAvatar").change(function(){
		var formData = new FormData($("#avatarForm")[0]);

		$.ajax({
			url: '<?=base_url()?>index.php/group/uploadAvatar',
			type: "POST",
			data: formData,
			dataType: "json",
			success:function(data){
				console.log(data);
				if(data.success){
					$("#groupAvatar").attr('src', '<?=base_url()?>'+data.filePath);
				}
				else{
					alert(data.errors);
					$("#avatarForm")[0].reset();
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

	$("#clearAvatar").click(function(){
		$.ajax({
			url: '<?=base_url()?>index.php/group/clearAvatar',
			type: "POST",
			success:function(data){
				$("#groupAvatar").attr('src', '<?=base_url()?>images/no_profile_icon2.png');
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
});
</script>