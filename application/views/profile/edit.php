<?php
//Start Generating form fields and their data
echo form_open('profile/edit/'.$profile_item['id']);
//Hidden ID Field
echo form_hidden('id', $profile_item['id']);

?>
<div class="left_col">
	<img src="unknown.png" width=200 height=200 alt="profile image"/>
	<button>Clear Image</button>
	<button>Upload an Image</button>
</div><!--left column-->

<div class="right_col">
	<div class="info">
		<label class="title">Name:</label><label><?php echo $profile_item['user_first_name']?> <?php echo $profile_item['user_last_name']?></label><br/>
		<label class="title">Major 1:</label><label><?php echo $profile_item['user_major1']?></label><br/>
		<label class="title">Major 2:</label><label><?php echo $profile_item['user_major2']?></label><br/>
		<label class="title">Graduation Year:</label><label><?php echo $profile_item['user_grad_year']?></label><br/>
		<label class="title">Gender:</label>
			<input name="user_gender" type="radio" value="Female"<? echo($profile_item['user_gender'] == "Female" ? " checked" : "")?>/><label>Female</label>
			<input name="user_gender" type="radio" value="Male"<? echo($profile_item['user_gender'] == "Female" ? " checked" : "")?>/><label>Male</label>
			<input name="user_gender" type="radio" value="Other"<? echo($profile_item['user_gender'] == "Other" ? " checked" : "")?>/><label>Other/No Answer</label><br/>
		<br/>
		<label class="title">MQP:</label>None<br/>
		<br/>
		<label class="title">Interests:</label><br/>
		<a href="interests/profile/edit/<?php echo $profile_item['id']?>"><button class="edit">Edit Interests</button></a>
		
		<label class="title">Description:</label>
		<textarea name="user_description" rows=5 cols=50><?php echo $profile_item['user_description']?>
		</textarea>
		<br/>
		<label class="title">Contact:</label><label><?php echo $profile_item['user_email']?></label>
		
		<div class="button_panel">
			<a href="profile/view/<?php echo $profile_item['id']?>"><button class="cancel">Cancel</button></a>
			<input type="submit" name="submit" value="Save" />
		</div>
	</div>
</div><!--right column-->
<p class="clear"></p>