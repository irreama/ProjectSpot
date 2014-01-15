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
		<a class="edit button-element-small" href="/index.php/profile/edit/<?php echo $profile_item['id']?>">Edit Page</a>
		<?php
		}
	?>
	
	<div class="info">
		<div class="basic_info">
			<div class="name">
				<label class="title">Name:</label>
				<label>
					<?php echo $profile_item['user_first_name'] ?> <?php echo $profile_item['user_last_name'] ?>
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
				<label><?php echo $profile_item['user_gender'] ?></label>
			</div>
		</div>
		
		<div class="mqp">
			<?php
			if($profile_item['user_status'] == 'Advisor'){
			?>
			<label class="title">MQPs Advising:</label>
			<?php
				foreach($profile_item['ps_groups'] as $a_group){
				?>
				<a href="/index.php/group/view/<?php echo $a_group['group_id'];?>"><?php echo $a_group['group_name'];?></a>
				<?php
				}
			}
			else{
				if(!empty($profile_item['ps_groups'])){
			?>
			<label class="title">MQP:</label>
			<a href="/index.php/group/view/<?php echo $profile_item['ps_groups'][0]['group_id'];?>">
				<?php echo $profile_item['ps_groups'][0]['group_name'];?>
			</a>
			
			<?php
				}
				else{
					?>
				<?php
				}
			}
			?>
		</div>
		
		<div class="interests">
			<label class="title">Interests:</label>
			<label>
				<?php
					$tag_array = array();
					foreach ($profile_item['ps_tags'] as $tag){
						$tag_array[] = $tag['tag_text'];
					}
					echo implode(',&nbsp;', $tag_array);
				?>
			</label>
		</div>
		
		<div class="description">
			<label class="title">Description:</label>
			<label>
				<?php echo $profile_item['user_description'] ?>
			</label>
		</div>
		
		<div class="contact">
			<label class="title">Contact:</label>
			<label><?php echo $profile_item['user_email'];?></label>
		</div>
	</div>
</div><!--right column-->
<p class="clear"></p>