<h2>Edit Profile</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('profile/edit') ?>
	<input type="hidden" name="id" value="1"/>
	<label for="first_name">First Name</label>
	<input type="input" name="first_name"/><br />
	<label for="last_name">Last Name</label>
	<input type="input" name="last_name"/><br/>
	<label for="gender">Gender</label>
	<input type="radio" name="gender" value="Male"> Male</br>
	<input type="radio" name="gender" value="Female"> Female</br>
	<input type="radio" name="gender" value="Other/No Answer"> Other/No Answer</br>
	<label for="grad_year">Graduation Year</label>
	<select name="grad_year">
	<?php

		$year = date("Y");
		while($year <= 2155){
			echo "<option value='$year'>$year</option>";
			$year++;
		}
	?>
	</select>
	<label for="description">Description</label>
	<textarea name="description">

	</textarea>
	<input type="submit" name="submit" value="Save"/>
</form>