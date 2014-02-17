<div class="help-text">
	This page lets you browse all students, advisors, and MQP groups. Use the search bar to filter even more by 
	typing in a name, major,
	or area of computer science that interests you. Use the checkboxes below the search bar to set which kind of results 
	you want to see.
	<a class="close" href="#">X</a>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/browse.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?=base_url()?>/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>/js/browse.js"></script>
<div class="page-title">
	<h2>Find students, advisors, and groups</h2>
</div>

<div class="search-bar">
	<label class="filter">Filter:</label>
	<input type="text" id="search"/>

	<div class="search-filters">
		<input id="without-mqp-check" type="checkbox" checked/><label>Students without MQPs</label>
		<input id="with-mqp-check" type="checkbox" checked/><label>Students with MQPs</label>
		<input id="advisor-check" type="checkbox" checked/><label>Advisors</label>	
		<input id="mqp-check" type="checkbox" checked/><label>MQPs</label>
	</div>
</div>

<hr>

<div>
	<div id="students-section">
		<h3>Students</h3>
		<table id="students">
		<thead>
			<tr>
				<th>Status</th>
				<th>Name</th>
				<th>Major 1</th>
				<th>Major 2</th>
				<th>Interests</th>
				<th>MQP</th>
			</tr>
		</thead>
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
					if($user['user_status'] == "Student"){ ?>
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
		</table>
	</div>
	<div id="advisors-section">
		<h3>Advisors</h3>
		<table id="advisors">
			<thead>
			<tr>
				<th>Status</th>
				<th>Name</th>
				<th>Department</th>
				<th>Interests</th>
				<th>MQPs</th>
			</tr>
			</thead>
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
								<ul class="tags">
								<?php
									foreach($userProfile['groups'] as $group){
									?>
								
										<a href="<?=base_url()?>/index.php/group/view/<?php echo $group['id'];?>">
										<li class="fu"><?php echo $group['group_name'];?></li></a>
									
									<?php
									}
								?>	
								</ul>
							</td>
						</tr>
					<?php
					}
				}
			?>
		</table>
	</div>
	
	<div id="mqps-section">
		<h3>MQP Groups</h3>
		<table id="mqps">
			<thead>
			<tr>
				<th>Status</th>
				<th>Title</th>
				<th>Department</th>
				<th>Areas</th>
				<th>Advisors</th>
				<th>Members</th>
			</tr>
			</thead>
			<?php
				foreach($groups as $group){
					$CI->load->model('group_model');
					$CI->load->model('group_tag_rel_model');
					$CI->load->model('group_major_rel_model');
					$CI->load->model('major_model');
					$CI->load->model('group_user_rel_model');
					
					//Obtain the id of the group
					$groupProfile = $CI->group_model->getGroupProfile($group['id']);
					
					//get the departments
					$groupDepartments = $CI->group_major_rel_model->get_all_majors_by_group_id($group['id']);
					
					//get the tags
					$groupTags = $CI->group_tag_rel_model->get_all_tags_by_group_id($group['id']);
					
					//get the group's students
					$groupStudents = $CI->group_user_rel_model->getGroupStudents($group['id']);
					//get the group's advisors
					$groupAdvisors = $CI->group_user_rel_model->getGroupAdvisors($group['id']);
					
					$userID = $groupProfile['users'][0]['id'];
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
						<?php 
							$totalDepts = count($groupDepartments);
							foreach($groupDepartments as $i => $dept){
								$major = $CI->major_model->get_major_by_id($dept['major_id']);
								if ($i != $totalDepts - 1){
									echo $major['major_text'].',';
								}else{
									echo $major['major_text'];
								}
							}
						?>
					</td>
					<td>
						<?php 
							$totalTags = count($groupTags);
							foreach($groupTags as $i => $tag){
								if ($i != $totalTags - 1){
									echo $tag['tag_text'].', ';
								}else{
									echo htmlentities($tag['tag_text']);
								}
							}
						?>
					</td>
					<td>
						<?php
							$totalAdvisors = count($groupAdvisors);
							foreach($groupAdvisors as $i => $advisor){
								$firstName = $groupProfile['users'][0]['user_first_name'];
								$lastName = $groupProfile['users'][0]['user_last_name'];
						?>	
						<a href="<?=base_url()?>/index.php/profile/view/<?php echo $userID;?>">
							
						<?php				
								echo $firstName.' ';
								echo $lastName;
						?></a>
						<?php
							}
						?>	
					</td>
					<td>
						<?php
							$totalStudents = count($groupStudents);
							foreach($groupStudents as $i => $student){
								$firstName = $groupProfile['users'][0]['user_first_name'];
								$lastName = $groupProfile['users'][0]['user_last_name'];
						?>	
						<a href="<?=base_url()?>/index.php/profile/view/<?php echo $userID;?>">
							
						<?php				
								echo $firstName.' ';
								echo $lastName;
						?></a>
						<?php
							}
						?>	
					</td>
				</tr>
				<?php
				}
			?>
		</table>
	</div>
</div>