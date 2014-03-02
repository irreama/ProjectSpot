<div class="help-text">
	Here you can see which MQP groups have invited you to join. If you are already in a group, you can see which members
	have requested to join your group. You can also see invitations you've sent out to other members and groups in ProjectSpot.
	You can revoke these invitations if you wish.
	<a class="close" href="#">X</a>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/invites.css">
<h2>Invitations</h2>
	<div id="received">	
		<h3>Received From</h3><hr>
		<div class="group">
			<h4>Group</h4>
			<?php
			if(isset($invites['incoming']['group']) && count($invites['incoming']['group'])){
				foreach ($invites['incoming']['group'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" id="invite">
				<label> 
					You have been invited by <a href="<?=base_url()?>group/view/<?=$anInvite['group']['id']?>"><?=$anInvite['group']['group_name']?></a>
					to join their MQP Group
				</label>
				<a class="invite-button button-element-small inline accept">&#10003; Accept</a>
				<a class="invite-button button-element-small inline reject">X Reject</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>You have not been invited to join any groups.</p>
			<?php
			}
			?>
		</div>
		<div class="requests">
			<h4>Requests</h4>
			<?php
			if(isset($invites['incoming']['requests']) && count($invites['incoming']['requests'])){
				foreach ($invites['incoming']['requests'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" id="invite">
				<label>
					<a href="<?=base_url()?>index.php/profile/view/<?=$anInvite['requester']['id']?>"><?=$anInvite['requester']['user_first_name']?> <?=$anInvite['requester']['user_last_name']?></a> has requested to join your group,
					<a href="<?=base_url()?>index.php/group/view/<?=$anInvite['group']['id']?>"><?=$anInvite['group']['group_name']?></a>
				</label>
				<a class="request-button button-element-small inline accept">&#10003; Accept</a>
				<a class="request-button button-element-small inline reject">X Reject</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>No one has requested to join your group</p>
			<?php
			}
			?>
		</div>
	</div>
	<?php
	$CI = & get_instance();

	$CI->load->model("group_user_rel_model");
	?>
	<div id="sent">
		<h3>Sent To</h3><hr>
<?php
	if($CI->group_user_rel_model->isUserInAnyGroup($CI->session->userdata("user_id"))){
	?>
		<div class="student">
			<h4>Student</h4>
			<?php
			
			if(isset($invites['outgoing']['students']) && count($invites['outgoing']['students'])){
				foreach($invites['outgoing']['students'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" class="invite">
				<label>
					<?=($uid == $anInvite['sender']['id'] ? "You have" : "<a href='" . base_url(). "index.php/profile/view/".$anInvite['sender']['id']."'>". $anInvite['sender']['user_first_name'] . " " . $anInvite['sender']['user_last_name'] . "</a> has") ?> invited <a href="<?=base_url()?>"><?=$anInvite['recipient']['user_first_name']?> <?=$anInvite['recipient']['user_last_name']?></a>
					to join your MQP group 
				</label>
				<a class="invite-button button-element-small inline reject">X Revoke</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>There are currently no students invited to your group</p>
			<?php
			}
			?>
		</div>
		<div class="advisor">
			<h4>Advisor</h4>
			<?php
			if(isset($invites['outgoing']['advisors']) && count($invites['outgoing']['advisors'])){
				foreach($invites['outgoing']['advisors'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" class="invite">
				<label>
					<?=($uid == $anInvite['sender']['id'] ? "You have" : "<a href='" . base_url() ."index.php/profile/view/".$anInvite['sender']['id']."'>". $anInvite['sender']['user_first_name'] . " " . $anInvite['sender']['user_last_name'] . "</a> has") ?> invited <a href="<?=base_url()?>"><?=$anInvite['recipient']['user_first_name']?> <?=$anInvite['recipient']['user_last_name']?></a>
					to advise your MQP group 
				</label>
				<a class="invite-button button-element-small inline reject">X Revoke</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>There are currently no advisors invited to your group</p>
			<?php
			}
			?>
		</div>
		<?php
}
		?>
		<div class="group">
			<h4>Group</h4>
			<?php
			if(isset($invites['outgoing']['groups']) && count($invites['outgoing']['groups'])){
				foreach($invites['outgoing']['groups'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" class="invite">
				<label>
					You have requested to join <?=$anInvite['group']['group_name']?>
				</label>
				<a class="invite-button button-element-small inline reject">X Revoke</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>You currently have not requested to join any groups</p>
			<?php
			}
			?>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		$("a.invite-button").click(function(event){
			var action = "none";
			var invParent = $(this).parent();
			if($(this).hasClass("reject")){
				action = "reject";
			}
			else if($(this).hasClass("accept")){
				action = "accept";
			}

			if(action != "none"){
				$.ajax({
					type:"POST",
					url:'<?=base_url()?>/index.php/group/'+action+'Invite',
					data:{
						id:invParent.data("invite-id")
					},
					success:function(data){
						console.log(data);
						if(data == "true"){
							invParent.fadeOut(function(){
								invParent.remove();
							});
							
						}
						else{
							console.log("Nay");
						}
					}
				})
			}
		});

		$("a.request-button").click(function(event){
			var action = "none";
			var invParent = $(this).parent();
			if($(this).hasClass("reject")){
				action = "reject";
			}
			else if($(this).hasClass("accept")){
				action = "accept";
			}

			if(action != "none"){
				$.ajax({
					type:"POST",
					url:'<?=base_url()?>/index.php/group/'+action+'Request',
					data:{
						id:invParent.data("invite-id")
					},
					success:function(data){
						console.log(data);
						if(data == "true"){
							invParent.fadeOut(function(){
								invParent.remove();
							});
							
						}
						else{
							console.log("Nay");
						}
					}
				})
			}
		});
	});
	</script>
