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
		<label class="title">Title:</label><input type="text" name="group_name" value="<?php echo $group_item['group_name'];?>"/><br/>
		<?php
		foreach($group_item['users'] as $a_user){
		?>
		<label class="title"><?php echo($a_user['user_status'] == "Advisor" ? "Advisor" : $a_user['user_major1']['major_text']);?>:</label><label><?php echo $a_user['user_first_name'];?> <?php echo $a_user['user_last_name'];?></label><br/>
		<?php
		}
		?>
		
		<br/>
		<label class="title">Interests:</label><br/>
		<?php
			foreach ($group_item['tags'] as $tag){
				?>
				<p><?php echo $tag['tag_text']?></p>
				<?php
			}
		?>
		<a class="button-element-small" href="/index.php/group/interests/edit/<?php echo $group_item['id']?>">Edit Interests</a>
		<label class="title">Description:</label>
		<textarea rows=5 cols=50 name="group_description"><?php echo $group_item['group_description'];?></textarea name="group_description"><br/>
		<br/>
		<label class="title">Contact:</label><input type="text" name="group_contact" value="<?php echo $group_item['group_contact'];?>"/>
		<div class="button_panel">
			<a class="button-element-small" href="/index.php/group/view/<?php echo $group_item['id']?>">Cancel</a>
			<input type="submit" name="submit" value="Save" />
		</div>
	</div>
	</form>
</div><!--right column-->
<p class="clear"></p>