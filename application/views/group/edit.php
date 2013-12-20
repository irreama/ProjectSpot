<pre>
<?php
//print_r($group_item);
?>
</pre>

<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col">
	<img src="/images/no_profile_icon2.png" width=200 height=200 alt="profile image"/>
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
			<input class="input_field" type="text" name="group_name" value="<?php echo $group_item['group_name'];?>"/>
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
			<a class="button-element-small" href="/index.php/group/interests/edit/<?php echo $group_item['id']?>">Edit Interests</a>
		</div>
		<div class="description">
			<label class="title">Description:</label>
			<textarea class="full_width" rows=5 cols=50 name="group_description"><?php echo $group_item['group_description'];?></textarea name="group_description">
		</div>
		<div class="contact">
			<label class="title">Contact:</label><input class="input_field" type="text" name="group_contact" value="<?php echo $group_item['group_contact'];?>"/>
		</div>
		<div class="button_panel">
			<a class="button-element-small cancel" href="/index.php/group/view/<?php echo $group_item['id']?>">Cancel</a>
			<input class="button-element-small edit" type="submit" name="submit" value="Save" />
		</div>
	</div>
	</form>
</div><!--right column-->
<p class="clear"></p>