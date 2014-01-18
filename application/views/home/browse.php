<link rel="stylesheet" type="text/css" href="/stylesheets/browse.css">
<div class="page-title">
	<h2>Find students, groups, advisors</h2>
</div>

<div class="search-bar">
	<input type="text"/>
	<input class="button-element-small" type="button" value="Filter"/>
</div>

<input type="checkbox" checked/><label>Students without MQPs</label>
<input type="checkbox" checked/><label>Students with MQPs</label>
<input type="checkbox" checked/><label>MQPs</label>
<input type="checkbox" checked/><label>Advisors</label>

<div>
	<h3>Students</h3>
	<table>
		<tr>
			<th>Status</th>
			<th>Name</th>
			<th>Major</th>
			<th>Interests</th>
			<th>MQP</th>
		</tr>
		<tr>
		<?php
			foreach($users as $user){
			?>
				<?php //if user_status = ENUM "Student" --> what do we do about "Admins" who have roles???
				if($user['user_status'] == "Student"){ ?>
					<tr>
						<td>
							<?php echo $user['user_status'];?>
						</td>
						<td>
						<a href="/index.php/profile/view/<?php echo $user['id'];?>">
						<?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></a>
						</td>
						<td>
							<?php echo $user['user_major1'];?> <?php echo $user['user_major2'];?>
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
			?>
				<?php //if user_status = ENUM "Advisor"
				if($user['user_status'] == "Advisor"){ ?>
					<tr>
						<td>
							<?php echo $user['user_status'];?>
						</td>
						<td>
							<a href="/index.php/profile/view/<?php echo $user['id'];?>">
							<?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></a>
						</td>
						<td>
							<?php echo $user['user_major1'];?>
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
		</tr>
		<tr>
		<?php
			foreach($groups as $group){
			?>
			<tr>
				<td>
					MQP Group
				</td>
				<td>
				<a href="/index.php/group/view/<?php echo $group['id'];?>">
				<?php echo $group['group_name'];?></a>
				</td>
			</tr>
			<?php
			}
		?>
		</tr>
	</table>
</div>