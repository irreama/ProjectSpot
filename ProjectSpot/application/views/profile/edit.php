<div class="help-text">
	Here you can edit and customize your personal profile page. You can change your information, upload a photo, and select your
	interests. You can also add a descripting of yourself, indicating what you're looking for in a MQP.
	<a class="close" href="#">X</a>
</div>
<div class="page-title">
	<h2>Edit Profile Page</h2>
	<hr>
</div>
<div class="left_col">
	<img id="userAvatar" src="<?=base_url()?><?=($profile_item['user_avatar'] ? $profile_item['user_avatar'] : "images/no_profile_icon2.png")?>" width=200 height=200 alt="profile image"/>
	<form id="avatarForm" method="post" enctype="multipart/form-data">
		<div class="button-element-small special-button">
			<label>Upload an Image</label>
			<input id="chooseAvatar" name="userfile" type="file" />
		</div>
		<input id="clearAvatar" class="button-element-small full-width" type="button" value="Clear Image"/>
	</form>
</div><!--left column-->

<div class="right_col">
	<div class="info">
		<div class="basic_info">
			<?php echo validation_errors(); ?>
			<?php
			//Start Generating form fields and their data
			echo form_open('profile/edit/'.$profile_item['id']);
			//Hidden ID Field
			echo form_hidden('id', $profile_item['id']);
			?>
			
			<div class="name">
				<label class="title">Name:</label>
				<label>
					<?php echo $profile_item['user_first_name']?> <?php echo $profile_item['user_last_name']?>
				</label>
			</div>
			
			<div class="major">
				<?php
				if($profile_item['user_status'] == 'Advisor'){
				?>
				
				<label class="title">Department:</label>
				<label><?php echo $profile_item['user_major1']['major_text'] ?></label>
				
				<?php
				}
				else{
				?>
				
				<div>
					<label class="title">Major 1:</label>
					<label><?php echo $profile_item['user_major1']['major_text'] ?></label>
				</div>
				<div>
					<label class="title">Major 2:</label>
					<label><?php echo $profile_item['user_major2']['major_text'] ?></label>
				</div>
					<?php
				}
				?>
			</div>
			
			<div class="grad_year">
				<?php
				if($profile_item['user_status'] != 'Advisor'){
				?>
				<label class="title">Graduation Year:</label>
				<select name="user_grad_year">
					<option value=""<?=(empty($profile_item['user_grad_year']) ? ' selected="selected"' : '')?>>Not Specified</option>
				<?php
				$currYear = date("Y");
				$startYear = $currYear - 2;

				for($i = $startYear; $i <= ($startYear + 15); $i++){
				?>

					<option value="<?=$i?>"<?=($profile_item['user_grad_year'] == $i ? ' selected="selected"' : '')?>><?=$i?></option>
				<?php
				}
				?>
				</select>
				<?php
				}
				?>
			</div>
			
			<div class="gender">
				<label class="title">Gender:</label>
				<label><input name="user_gender" type="radio" value="Female"<?php echo($profile_item['user_gender'] == "Female" ? " checked" : "")?>/>Female</label>
				<label><input name="user_gender" type="radio" value="Male"<?php echo($profile_item['user_gender'] == "Male" ? " checked" : "")?>/>Male</label>
				<label><input name="user_gender" type="radio" value="Not Provided"<?php echo($profile_item['user_gender'] == "Not Provided" ? " checked" : "")?>/>Other/No Answer</label>
			</div>
		</div>
		
		<div class="mqp">
			<label class="title">MQP:</label>
		</div>
		
		<div class="interests">
			<label class="title">Interests:</label>
			<?php
				$tag_array = array();
				foreach ($profile_item['ps_tags'] as $tag){
					$tag_array[] = $tag['tag_text'];
				}
				echo implode(',&nbsp;', $tag_array);
			?>
			<a class="button-element-small" href="<?=base_url()?>index.php/profile/interests/edit">
				Edit Interests
			</a>
		</div>	
		
		<div class="description">
			<label class="title">Describe yourself:</label>
			<textarea class="input_field full_width" name="user_description" rows=5><?php echo $profile_item['user_description']?></textarea>
		</div>
		
		<div class="contact">
			<label class="title">Contact:</label><label><?php echo $profile_item['user_email']?></label>
		</div>
		<?php
		if($profile_item['user_status'] == "Advisor"){
		?>
		<div class="website">
			<label class="title">Web Site:</label><input type="text" name="user_site" value="<?php echo $profile_item['user_site']?>"/>
		</div>
		<?php
		}
		?>
		
					
		<div class="information profile-info">
			<h3>Why can't I change some information?</h3>
			<p>
				Name, major, graduation year, and contact is pulled from WPI. If you think there is an error,
				you should contact the school and make sure your information is up-to-date. An MQP will be displayed
				on your profile only once you have joined a group in ProjectSpot.
			</p>
		</div>
			
		<div class="button_panel">
			<a class="button-element-small cancel" href="<?=base_url()?>index.php/profile/view/<?php echo $profile_item['id']?>">Cancel</a>
			<input class="button-element-small edit" type="submit" name="submit" value="Save" />
		</div>

		<?php
		//Close the form
		echo form_close();
		?>
	</div>
</div><!--right column-->
<p class="clear"></p>
<script type="text/javascript">
$(document).ready(function(){
	$("#chooseAvatar").change(function(){
		var formData = new FormData($("#avatarForm")[0]);

		$.ajax({
			url: '<?=base_url()?>index.php/profile/uploadAvatar',
			type: "POST",
			data: formData,
			dataType: "json",
			success:function(data){
				console.log(data);
				if(data.success){
					$("#userAvatar").attr('src', '<?=base_url()?>'+data.filePath);
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
			url: '<?=base_url()?>index.php/profile/clearAvatar',
			type: "POST",
			success:function(data){
				$("#userAvatar").attr('src', '<?=base_url()?>images/no_profile_icon2.png');
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
});
</script>