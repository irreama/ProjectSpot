<?php
print_r($users);
?>
<div class="page-title">
	<h2>Browse</h2>
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