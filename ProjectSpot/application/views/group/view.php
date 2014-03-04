<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col clearfix">
	<img src="<?=base_url()?><?=($group_item['group_avatar'] ? $group_item['group_avatar'] : "images/no_profile_icon2.png")?>" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col clearfix">
	<div id="button-div">
		<?php
		$CI =& get_instance();

		$CI->load->model('group_user_rel_model');
		if($CI->group_user_rel_model->isUserInGroup($CI->session->userdata('user_id'),$group_item['id'])){
			?>
		<a class="edit button-element-small" href="<?=base_url()?>index.php/group/edit/<?php echo $group_item['id'];?>">Edit Page</a>
		<?php
		}
		else if(!$CI->group_user_rel_model->isUserInAnyGroup($CI->session->userdata('user_id')) && $CI->group_user_rel_model->canUserRequestToJoin($CI->session->userdata('user_id'),$group_item['id'])){
			?>
		<button type="button" class="edit button-element-small" id="requestInvite" data-uid="<?=$CI->session->userdata('user_id')?>" data-gid="<?=$group_item['id']?>">Request to Join</button>
			<?php
		}
		else{
		?>
			<button type="button" class="edit disabled-button" disabled="disabled">Request to Join</button>
		<?php
		}
		?>
	</div>
	
	<div class="info">
		<div class="basic_info">
			<label class="title">Project Title:</label>
			<label><?php echo $group_item['group_name'];?></label>
			
			<div class="members">
				<label class="nl_title">Group Members:</label>
				<?php
					foreach($group_item['users'] as $a_user){
					?>
					<div>
						<label class="group_members">
							<?php echo($a_user['user_status'] == "Advisor" ? "Advisor" : $a_user['user_major1']['major_text']);?>:
						</label>
						<label>
							<a href="<?=base_url()?>index.php/profile/view/<?=$a_user['id']?>">
							<?php echo $a_user['user_first_name'];?> 
							<?php echo $a_user['user_last_name'];?>
						</a>
						</label>
					</div>
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
				echo implode(', ', $tag_array);
			?>
		</div>
		
		<div class="description">
			<label class="nl_title">Description:</label>
			<label>
				<?php echo $group_item['group_description'];?>
			</label>
		</div>
		
		<div class="needs">
			<label class="nl_title">Members this group is looking for:</label>
			<label>
				<?php echo $group_item['group_needs'];?>
			</label>
		</div>
		
		<div class="site">
			<label class="title">Group Website:</label>
			<?php
			$url = !empty($group_item['group_site']) ? $group_item['group_site'] : '';
			$scheme = parse_url($url, PHP_URL_SCHEME);
			if (!empty($url) && empty($scheme)) {
				$url = (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://') . $url;
			}
			?>
			<label><a href="<?=$url?>" target="_blank"><?=$url?></a></label>
		</div>
		
		<div class="contact">
			<label class="title">Contact:</label>
			<label><a href="mailto:<?php echo $group_item['group_contact'];?>"><?php echo $group_item['group_contact'];?></a></label>
		</div>
	</div>
</div><!--right column-->
<p class="clear"></p>

<script>
$(document).ready(function(){
	$("#requestInvite").click(function(){
		var button = $(this);
		$.ajax({
			type:"POST",
			url:'<?=base_url()?>/index.php/group/requestToInvite',
			data:{
				gid:$(this).data("gid"),
				uid:$(this).data("uid")
			},
			success:function(data){
				console.log(data);
				button.remove();
				$("#button-div").html('<div class="disabled-button edit" disabled="disabled">Request to Join</div>');
			}
		})
	})
});
</script>