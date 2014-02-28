<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/create_group.css">
<div class="page-title">
	<h2>Create a new group</h2>
</div>
	
<div class="group-form">
	<?php echo validation_errors(); ?>
	<?php
	echo form_open('group/new/');
	?>
	<div class="info">
		<input type="hidden" name="group_creator" value="4"/>
		
		<div>
			<label class="title">Project Title:</label>
			<input class="group_name" type="text" name="group_name"/>
		</div>
		
		<div>
			<label class="title">Description of the Project:</label>
			<textarea class="group_description" name="group_description"></textarea>
		</div>
		<div>
			<label class="title">Majors, skills, and requirements for new members:</label>
			<textarea class="group_needs" name="group_needs"></textarea>
		</div>
		
		<!-- Anthony where is the other description box? -->
		
		<div>
			<label class="title">Group Contact:</label>
			<input class="group_contact" type="text" name="group_contact" value="<?=$contact?>"/>
		</div>

		<div>
			<label class="title">Group Website:</label>
			<input class="group_site" type="text" name="group_site"/>
		</div>
		
		<div class="information">
			<h3>Why can't I add group members?</h3>
			<p>
				ProjectSpot works off-of a request-system. To add a member, that person must have created a profile by logging in.
				You can then add that person by going to his/her profile page, and clicking the "invite to group" button.
			</p>
		</div>
		
		<input class="enter button-element" type="submit" name="submit" value="Create Group"/>
	</div>
	</form>
</div>
