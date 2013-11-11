<h2>Edit Profile</h2>
<pre>
<?php
print_r($profile_item);
?>
</pre>

<?php

//Start Generating form fields and their data
echo form_open('profile/edit');
//Hidden ID Field
echo form_hidden('id', $profile_item['id']);

//First name
echo form_label('First Name', 'user_first_name');
echo form_input('user_first_name', $profile_item['user_first_name']);

//Last Name
echo form_label('Last Name', 'user_last_name');
echo form_input('user_last_name', $profile_item['user_last_name']);

//Email
echo form_label('Email', 'user_email');
echo form_input('user_email', $profile_item['user_email']);

//Grad Year

//Generate an Array of years from this year to 2155 (The last year available in the MySQL year type)
$currYear = date('Y');
while($currYear <= 2155){
	$years[$currYear] = $currYear;
	$currYear++;
}

echo form_label('Graduation Year', 'user_grad_year');
echo form_dropdown('user_grad_year', $years, $profile_item['user_grad_year']);

//Gender
echo form_label('Gender', 'user_gender');
echo form_checkbox('user_gender', 'Male', ($profile_item['user_gender'] == "Male" ? TRUE : FALSE));
echo form_checkbox('user_gender', 'Female', ($profile_item['user_gender'] == "Female" ? TRUE : FALSE));
echo form_checkbox('user_gender', 'Undisclosed/Other', ($profile_item['user_gender'] == "Undisclosed/Other" ? TRUE : FALSE));

//Description
echo form_label('Description', 'user_description');
echo form_textarea('user_description', $profile_item['user_description']);

//Submit Button
echo form_submit('submit', 'Save Profile');

echo form_close();
?>