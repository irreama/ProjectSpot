<div class="left_col">
	<img src="/images/no_profile_icon2.png" width=200 height=200 alt="profile image"/>
	<a class="button-element-small">Clear Image</a>
	<a class="button-element-small">Upload an Image</a>
</div><!--left column-->

<div class="right_col">
	<div class="info">
		<div class="basic_info">
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
				<label><?php echo $profile_item['user_grad_year'] ?></label>
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
			<a class="button-element-small" href="/index.php/profile/interests/edit/<?php echo $profile_item['id']?>">
				Edit Interests
			</a>
		</div>	
		
		<div class="description">
			<label class="title">Describe yourself:</label>
			<textarea class="input_field full_width" name="user_description" rows=5 cols=50>
				<?php echo $profile_item['user_description']?>
			</textarea>
		</div>
		
		<div class="contact">
			<label class="title">Contact:</label><label><?php echo $profile_item['user_email']?></label>
		</div>
		
		<div class="button_panel">
			<a class="button-element-small cancel" href="/index.php/profile/view/<?php echo $profile_item['id']?>">Cancel</a>
			<input class="button-element-small edit" type="submit" name="submit" value="Save" />
		</div>

		<?php
		//Close the form
		echo form_close();
		?>
	</div>
</div><!--right column-->
<p class="clear"></p>