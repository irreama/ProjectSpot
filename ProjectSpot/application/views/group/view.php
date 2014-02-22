<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col clearfix">
	<img src="<?=base_url()?><?=($group_item['group_avatar'] ? $group_item['group_avatar'] : "images/no_profile_icon2.png")?>" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col clearfix">
	<?php
	$CI =& get_instance();

	$CI->load->model('group_user_rel_model');
	if($CI->group_user_rel_model->isUserInGroup(4,$group_item['id'])){
		?>
	<a class="edit button-element-small" href="<?=base_url()?>index.php/group/edit/<?php echo $group_item['id'];?>">Edit Page</a>
	<?php
	}
	else if(!$CI->group_user_rel_model->isUserInAnyGroup($CI->session->userdata('user_id')) && $CI->group_user_rel_model->canUserRequestToJoin($CI->session->userdata('user_id'),$group_item['id'])){
		?>
	<button type="button" class="edit button-element-small" id="requestInvite" data-uid="4" data-gid="<?=$group_item['id']?>">Request to Join</button>
		<?php
	}
	?>
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
		<div class="needs">
			<label class="title">Group Needs:</label>
			<label>
				<?php echo $group_item['group_needs'];?>
			</label>
		</div>
		<div class="contact">
			<label class="title">Contact:</label>
			<label><?php echo $group_item['group_contact'];?></label>
		</div>
		<div class="site">
			<label class="title">Site:</label>
			<label><?php echo $group_item['group_site'];?></label>
		</div>
	</div>
</div><!--right column-->
<p class="clear"></p>
<script>
$(document).ready(function(){
	$("#requestInvite").click(function(){
		$.ajax({
			type:"POST",
			url:'<?=base_url()?>/index.php/group/requestToInvite',
			data:{
				gid:$(this).data("gid"),
				uid:$(this).data("uid")
			},
			success:function(data){
				console.log(data);
			}
		})
	})
});
</script>