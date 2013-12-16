<div class="page-title">
	<h2>This is a<?php echo ($profile_item['user_status'] == 'Advisor' ? "n advisor" : " student"); ?> page</h2>
</div>
		
<div class="left_col">
	<img src="/images/no_profile_icon2.png" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col">
	<?php
		//Change this when we really go live. Use real authentication
		if($profile_item['id'] == 4){
		?>
		<a class="edit" href="/index.php/profile/edit/<?php echo $profile_item['id']?>">Edit Page</a>
		<?php
		}
	?>
	
	<div class="info">
		<label class="title">Name:</label><label><?php echo $profile_item['user_first_name'] ?> <?php echo $profile_item['user_last_name'] ?></label><br/>
		<label class="title">Major 1:</label><label><?php echo $profile_item['user_major1']['major_text'] ?></label><br/>
		<label class="title">Major 2:</label><label><?php echo $profile_item['user_major2']['major_text'] ?></label><br/>
		<label class="title">Graduation Year:</label><label><?php echo $profile_item['user_grad_year'] ?></label><br/>
		<label class="title">Gender:</label><label><?php echo $profile_item['user_gender'] ?></label><br/>
		<br/>
		<?php
		if($profile_item['user_status'] == 'Advisor'){
		?>
		<label class="title">MQPs Advising:</label><br/>
		<?php
			foreach($profile_item['ps_groups'] as $a_group){
			?>
			<a href="/index.php/group/view/<?php echo $a_group['group_id'];?>"><?php echo $a_group['group_name'];?></a><br/>
			<?php
			}
		}
		else{
			if(!empty($profile_item['ps_groups'])){
		?>
		<label class="title">MQP:</label><a href="/index.php/group/view/<?php echo $profile_item['ps_groups'][0]['group_id'];?>"><?php echo $profile_item['ps_groups'][0]['group_name'];?></a><br/>
		<?php
			}
			else{
				?>
			<?php
			}
		}
		?>
		<br/>
		<label class="title">Interests:</label><br/>
		<label>
		<?php
			foreach ($profile_item['ps_tags'] as $tag){
				?>
				<label><?php echo $tag['tag_text'];?></label><br/>
				<?php
			}
		?>
		</label>
		<label class="title">Description:</label>
		<label>
			<?php echo $profile_item['user_description'] ?>
		</label><br/>
		<br/>
		<label class="title">Contact:</label><label><?php echo $profile_item['user_email'];?></label>
	</div>
</div><!--right column-->
<p class="clear"></p>