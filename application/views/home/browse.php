<link rel="stylesheet" type="text/css" href="/stylesheets/browse.css">
<div class="page-title">
	<h2>Find students, groups, advisors</h2>
</div>

<a href="/index.php/browse"><h3>Students</h3></a>
<a href="/index.php/browse"><h3>Groups</h3></a>
<a href="/index.php/browse"><h3>Advisors</h3></a>

<div class="search-bar">
	<input type="text"/>
	<input type="button" value="Filter"/>
</div>

<ul>
<?php
	foreach($users as $user){
	?>
	<a href="/index.php/profile/view/<?php echo $user['id'];?>"><li><?php echo $user['user_first_name'];?> <?php echo $user['user_last_name'];?></li></a>
	<?php
	}
?>
</ul>