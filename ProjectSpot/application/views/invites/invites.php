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
			if(count($invites['incoming'])){
				foreach ($invites['incoming'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" id="invite">
				<label> 
					You have been invited by <a href="<?=base_url()?>"><?=$anInvite['group']['group_name']?></a>
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
			<p>There are no incoming invites to display</p>
			<?php
			}
			?>
		</div>
	</div>
	<div id="sent">
		<h3>Sent To</h3><hr>
		<div class="student">
			<h4>Student</h4>
			<?php
			if(isset($invites['outgoing']['students']) && count($invites['outgoing']['students'])){
				foreach($invites['outgoing']['students'] as $anInvite){
			?>
			<div data-invite-id="<?=$anInvite['id']?>" class="invite">
				<label>
					<?=($uid == $anInvite['sender']['id'] ? "You have" : $anInvite['sender']['user_first_name'] . " " . $anInvite['sender']['user_last_name'] . " has") ?> invited <a href="<?=base_url()?>"><?=$anInvite['recipient']['user_first_name']?> <?=$anInvite['recipient']['user_last_name']?></a>
					to join your MQP group 
				</label>
				<a class="invite-button button-element-small inline reject">X Revoke</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>There are no student invites to display</p>
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
					<?=($uid == $anInvite['sender']['id'] ? "You have" : $anInvite['sender']['user_first_name'] . " " . $anInvite['sender']['user_last_name'] . " has") ?> invited <a href="<?=base_url()?>"><?=$anInvite['recipient']['user_first_name']?> <?=$anInvite['recipient']['user_last_name']?></a>
					to advise your MQP group 
				</label>
				<a class="invite-button button-element-small inline reject">X Revoke</a>
			</div>
			<?php
				}
			}
			else{
			?>
			<p>There are no advisor invites to display</p>
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
	});
	</script>
