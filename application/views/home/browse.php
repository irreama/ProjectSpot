<link rel="stylesheet" type="text/css" href="/stylesheets/browse.css">
<div class="page-title">
	<h2>Find students, groups, advisors</h2>
</div>

<div class="search-bar">
	<input type="text"/>
	<input type="button" value="Filter"/>
</div>

<input type="checkbox" checked/><label>Students without MQPs</label>
<input type="checkbox" checked/><label>Students with MQPs</label>
<input type="checkbox" checked/><label>MQPs</label>
<input type="checkbox" checked/><label>Advisors</label>

<div>
<table>
	<tr>
		<th>Status</th>
		<th>Name</th>
		<th>Description</th>
	</tr>
	<tr>
	<?php
		foreach($users as $user){
		?>
		<tr>
			<td>
			<a href="/index.php/profile/view/<?php echo $user['id'];?>">
			<?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></a>
			</td>
		</tr>
		<?php
		}
	?>
	</tr>
</table>
</div>