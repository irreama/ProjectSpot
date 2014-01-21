<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col clearfix">
	<img src="<?=base_url()?>images/no_profile_icon2.png" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col clearfix">
	<a class="edit button-element-small" href="<?=base_url()?>index.php/group/edit/<?php echo $group_item['id'];?>">Edit Page</a>
	<div class="info">
		<div class="basic_info">
			<label class="title">Project Title:</label>
			<label><?php echo $group_item['group_name'];?></label>
			<div class="members">
				<?php
					foreach($group_item['users'] as $a_user){
					?>
					<label class="title">
						<?php echo($a_user['user_status'] == "Advisor" ? "Advisor" : $a_user['user_major1']['major_text']);?>:
					</label>
					<label>
						<?php echo $a_user['user_first_name'];?> 
						<?php echo $a_user['user_last_name'];?>
					</label>
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
		</div>
		<div class="description">
			<label class="title">Description:</label>
			<label>
				<?php echo $group_item['group_description'];?>
			</label>
		</div>
		<div class="contact">
			<label class="title">Contact:</label>
			<label><?php echo $group_item['group_contact'];?></label>
		</div>
	</div>
</div><!--right column-->
<p class="clear"></p>