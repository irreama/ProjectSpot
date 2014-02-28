<div class="help-text">
	This is your personal Profile page. It can be seen by other
	ProjectSpot users. Add information to allow users with similar
	interests to find you. This improves your chance of finding an MQP
	group.
	<a class="close" href="#">X</a>
</div>
<div class="page-title">
	<h2>This is a<?php echo ($profile_item['user_status'] == 'Advisor' ? "n advisor" : " student"); ?> profile page</h2>
</div>
		
<div class="left_col">
	<img src="<?=base_url()?><?=($profile_item['user_avatar'] ? $profile_item['user_avatar'] : "images/no_profile_icon2.png")?>" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col">
	<?php
		$CI =& get_instance();
		$CI->load->model('group_user_rel_model');

		//Snag the logged in user's group
		$groups = $CI->group_user_rel_model->get_all_groups_by_user_id($CI->session->userdata('user_id'));
		if($groups){
			$currGroup = $groups[0]['group_id'];
		}
		
		if($profile_item['id'] == $CI->session->userdata('user_id')){
		?>
		<a class="edit button-element-small" href="<?=base_url()?>index.php/profile/edit/<?php echo $profile_item['id']?>">Edit Page</a>
		<?php
		}
		else if($profile_item['user_status'] != "Advisor" && $CI->group_user_rel_model->isUserInAnyGroup($profile_item['id'])){
			//Hacky way to not display 
		}
		else if(($groups && $CI->group_user_rel_model->isUserInAnyGroup($CI->session->userdata('user_id')) && $CI->group_user_rel_model->canUserRequestToJoin($profile_item['id'], $currGroup))){
			?>
			<button id="inviteButton" type="button" class="edit button-element-small" id="invite" data-uid="<?=$profile_item['id']?>" data-gid="<?=$currGroup?>">Invite to Group</button>
			<?php
		}
		else{
			?>
			<div class="disabled-button edit button-element-small">Invite to Group</div>
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
				<a href="<?=base_url()?>index.php/group/view/<?php echo $a_group['group_id'];?>"><?php echo $a_group['group_name'];?></a>
				<?php
				}
			}
			else{
				if(!empty($profile_item['ps_groups'])){
			?>
			<label class="title">MQP:</label>
			<a href="<?=base_url()?>index.php/group/view/<?php echo $profile_item['ps_groups'][0]['group_id'];?>">
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
<script>
$(document).ready(function(){
	$("#inviteButton").click(function(){
		var button = $(this);
		$.ajax({
			type:"POST",
			url:'<?=base_url()?>/index.php/group/invite',
			data:{
				gid:$(this).data("gid"),
				uid:$(this).data("uid")
			},
			success:function(data){
				console.log(data);
				button.addClass("disabled-button");
			}
		})
	})
});
</script>