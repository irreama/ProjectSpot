<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col">
</div><!--left column-->

<div class="right_col">
	<?php
	echo form_open('group/new/');
	?>
	<div class="info">
		<input type="hidden" name="group_creator" value="4"/>
		<label class="title">Title:</label><input type="text" name="group_name"/><br/>
		<label class="title">Description:</label>
		<textarea name="group_description"></textarea><br/>
		<br/>
		<label class="title">Group Contact:</label><input type="text" name="group_contact" value="test@wpi.edu"/>
		<input type="submit" name="submit" value="Create Group"/>
	</div>
	</form>
</div><!--right column-->