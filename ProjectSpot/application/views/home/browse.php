<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/browse.css">
<div class="page-title">
	<h2>Find students, advisors, and groups</h2>
</div>

<div class="search-bar">
	<input type="text"/>
	<input class="button-element-small" type="button" value="Filter"/>

	<div class="search-filters">
		<input type="checkbox" checked/><label>Students without MQPs</label>
		<input type="checkbox" checked/><label>Students with MQPs</label>
		<input type="checkbox" checked/><label>MQPs</label>
		<input type="checkbox" checked/><label>Advisors</label>
	</div>
</div>

<hr>

<div>
	<h3>Students</h3>
	<table>
		<tr>
			<th>Status</th>
			<th>Name</th>
			<th>Major 1</th>
			<th>Major 2</th>
			<th>Interests</th>
			<th>MQP</th>
		</tr>
		<tr>
		<?php 
			foreach($users as $user){
				//Load the major Model in (Only needs to be done once in scope)
				$CI =& get_instance();
				$CI->load->model('major_model');
				$CI->load->model('user_model');
				$CI->load->model('user_tag_rel_model');
	 
				//Obtain the id of the major you want
				$userProfile = $CI->user_model->getUserProfile($user['id']);
				$majorId1 = $user['user_major1'];
				$majorId2 = $user['user_major2'];
	 
				//Get the major
				$major1 = $CI->major_model->get_major_by_id($majorId1);
				$major2 = $CI->major_model->get_major_by_id($majorId2);
				
				$major2Text = !empty($major2['major_text']) ? $major2['major_text'] : "";
				
				//get the group
				$userGroupID = !empty($userProfile['groups'][0]['id']) ? $userProfile['groups'][0]['id'] : "";
				$userGroupName = !empty($userProfile['groups'][0]['group_name']) ? $userProfile['groups'][0]['group_name'] : "";

				//get the tags
				$userTags = $CI->user_tag_rel_model->get_all_tags_by_user_id($user['id']);				
		?>
				<?php //if user_status = ENUM "Student" --> what do we do about "Admins" who have roles???
				if($user['user_status'] == "Admin" || $user['user_status'] == "Student"){ ?>
					<tr>
						<td>
							<?php echo $user['user_status'];?>
						</td>
						<td>
						<a href="<?=base_url()?>/index.php/profile/view/<?php echo $user['id'];?>">
						<?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></a>
						</td>
						<td>
							<?php echo $major1['major_text'];?>
						</td>
						<td>
							<?php echo $major2Text;?>
						</td>
						<td>
							<?php 
								$totalTags = count($userTags);
								foreach($userTags as $i => $tag){
									if ($i != $totalTags - 1){
										echo $tag['tag_text'].', ';
									}else{
										echo $tag['tag_text'];
									}
								}
							?>
						</td>
						<td>
							<a href="<?=base_url()?>/index.php/group/view/<?php echo $userGroupID;?>">
							<?php echo $userGroupName;?></a>
						</td>
					</tr>
			<?php
				}
			}
		?>
		</tr>
	</table>
	<h3>Advisors</h3>
	<table>
		<tr>
			<th>Status</th>
			<th>Name</th>
			<th>Department</th>
			<th>Interests</th>
			<th>MQPs</th>
		</tr>
		<tr>
		<?php
			foreach($users as $user){	 
				//Obtain the id of the major you want
				$majorId = $user['user_major1'];
	 
				 //Get the major
				$department = $CI->major_model->get_major_by_id($majorId);
				
				//get the groups
				$userProfile = $CI->user_model->getUserProfile($user['id']);
				$userGroupID = !empty($userProfile['groups'][0]['id']) ? $userProfile['groups'][0]['id'] : "";
				$userGroupName = !empty($userProfile['groups'][0]['group_name']) ? $userProfile['groups'][0]['group_name'] : "";
				
				//get the tags
				$userTags = $CI->user_tag_rel_model->get_all_tags_by_user_id($user['id']);
				
			?>
				<?php //if user_status = ENUM "Advisor"
				if($user['user_status'] == "Advisor"){ ?>
					<tr>
						<td>
							<?php echo $user['user_status'];?>
						</td>
						<td>
							<a href="<?=base_url()?>/index.php/profile/view/<?php echo $user['id'];?>">
							<?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></a>
						</td>
						<td>
							<?php echo $department['major_text'];?>
						</td>
						<td>
							<?php 
								$totalTags = count($userTags);
								foreach($userTags as $i => $tag){
									if ($i != $totalTags - 1){
										echo $tag['tag_text'].', ';
									}else{
										echo $tag['tag_text'];
									}
								}
							?>
						</td>
						<td>
							<a href="<?=base_url()?>/index.php/group/view/<?php echo $userGroupID;?>">
							<?php echo $userGroupName;?></a>
						</td>
					</tr>
				<?php
				}
			}
		?>
		</tr>
	</table>
	
	<h3>MQP Groups</h3>
	<table>
		<tr>
			<th>Status</th>
			<th>Title</th>
			<th>Department</th>
			<th>Areas</th>
			<th>Members</th>
			<th>Advisors</th>
		</tr>
		<tr>
		<?php
			foreach($groups as $group){
				$CI->load->model('group_model');
				
				//Obtain the id of the group
				$groupProfile = $CI->group_model->getGroupProfile($group['id']);
				
				//get the group members
				$groupMemberFirstName = $groupProfile['users'][0]['user_first_name'];
				$groupMemberLastName = $groupProfile['users'][0]['user_last_name'];
				//$groupMembers = $groupMemberFirstName + $groupMemberLastName;
			?>
			<tr>
				<td>
					MQP Group
				</td>
				<td>
				<a href="<?=base_url()?>/index.php/group/view/<?php echo $group['id'];?>">
				<?php echo $group['group_name'];?></a>
				</td>
				<td>
					Unk
				</td>
				<td>
					Dbs
				</td>
				<td>
					<?php echo $groupMemberFirstName.' ';?><?php echo $groupMemberLastName;?>
				</td>
			</tr>
			<?php
			}
		?>
		</tr>
	</table>
</div>