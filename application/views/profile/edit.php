<div class="left_col">
	<img src="/images/no_profile_icon2.png" width=200 height=200 alt="profile image"/>
	<button>Clear Image</button>
	<button>Upload an Image</button>
</div><!--left column-->

<div class="right_col">
	<div class="info">
		<?php
		//Start Generating form fields and their data
		echo form_open('profile/edit/'.$profile_item['id']);
		//Hidden ID Field
		echo form_hidden('id', $profile_item['id']);

		?>
		<label class="title">Name:</label><label><?php echo $profile_item['user_first_name']?> <?php echo $profile_item['user_last_name']?></label><br/>
		<?php
		if($profile_item['user_status'] == 'Advisor'){
		?>
		<label class="title">Department:</label><label><?php echo $profile_item['user_major1']['major_text'] ?></label><br/>
		<?php
		}
		else{
		?>
		<label class="title">Major 1:</label><label><?php echo $profile_item['user_major1']['major_text'] ?></label><br/>
		<label class="title">Major 2:</label><label><?php echo $profile_item['user_major2']['major_text'] ?></label><br/>
		<?php
		}
		
		if($profile_item['user_status'] != 'Advisor'){
		?>
		<label class="title">Graduation Year:</label><label><?php echo $profile_item['user_grad_year'] ?></label><br/>
		<?php
		}
		?>
		<label class="title">Gender:</label>
			<input name="user_gender" type="radio" value="Female"<?php echo($profile_item['user_gender'] == "Female" ? " checked" : "")?>/><label>Female</label>
			<input name="user_gender" type="radio" value="Male"<?php echo($profile_item['user_gender'] == "Male" ? " checked" : "")?>/><label>Male</label>
			<input name="user_gender" type="radio" value="Not Provided"<?php echo($profile_item['user_gender'] == "Not Provided" ? " checked" : "")?>/><label>Other/No Answer</label><br/>
		<br/>
		<label class="title">MQP:</label>None<br/>
		<br/>
		<label class="title">Interests:</label><br/>
		<?php
			$tag_array = array();
			foreach ($profile_item['ps_tags'] as $tag){
				$tag_array[] = $tag['tag_text'];
			}
			echo implode(',&nbsp;', $tag_array);
		?>
		<a href="/index.php/profile/interests/edit/<?php echo $profile_item['id']?>"><button class="edit" type="button">Edit Interests</button></a>
		
		<label class="title">Describe yourself:</label>
		<textarea class="input_field full_width" name="user_description" rows=5 cols=50><?php echo $profile_item['user_description']?></textarea>
		<br/>
		<label class="title">Contact:</label><label><?php echo $profile_item['user_email']?></label>
		
		<div class="button_panel">
			<a href="/index.php/profile/view/<?php echo $profile_item['id']?>"><button type="button" class="cancel">Cancel</button></a>
			<input class="edit" type="submit" name="submit" value="Save" />
		</div>

		<?php
		//Close the form
		echo form_close();
		?>
	</div>
</div><!--right column-->
<p class="clear"></p>