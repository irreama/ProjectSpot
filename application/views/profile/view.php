<pre>
<?php

print_r($profile_item);

?>
</pre>

<div class="page-title">
	<h2>This is a student page</h2>
</div>
		
<div class="left_col">
	<img src="unknown.png" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col">
	<?php
		//Change this when we really go live. Use real authentication
		if($profile_item['id'] == 4){
		?>
		<a class="edit" href="profile/view/<?php echo $profile_item['id']?>">Edit Page</a>
		<?php
		}
	?>
	
	<div class="info">
		<label class="title">Name:</label><label><?php echo $profile_item['user_first_name'] ?> <?php echo $profile_item['user_last_name'] ?></label><br/>
		<label class="title">Major 1:</label><label><?php echo $profile_item['user_major1'] ?></label><br/>
		<label class="title">Major 2:</label><label><?php echo $profile_item['user_major2'] ?></label><br/>
		<label class="title">Graduation Year:</label><label><?php echo $profile_item['user_grad_year'] ?></label><br/>
		<label class="title">Gender:</label><label><?php echo $profile_item['user_gender'] ?></label><br/>
		<br/>
		<label class="title">MQP:</label><a href="group.html">ProjectSpot</a><br/>
		<br/>
		<label class="title">Interests:</label><br/>
		<label>
		<?php
			foreach ($profile_item['ps_tags'] as $tag){
				?>
				<p><?php echo $tag['tag_text']?></p>
				<?php
			}
		?>
		</label>
		<label class="title">Description:</label>
		<label>
			<?php echo $profile_item['user_description'] ?>
		</label><br/>
		<br/>
		<label class="title">Contact:</label><label><?php echo $profile_item['user_email'] ?></label>
	</div>
</div><!--right column-->
<p class="clear"></p>