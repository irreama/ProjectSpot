<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/dashboard.css">
<h2>Dashboard</h2><p class="clear"></p>
<div class="left">
	<div id="todo">
		<h3>To-Do List</h3>
		<ol>
			<li>Find an MQP Group<br><a href="<?=base_url()?>index.php/browse">Browse groups now</a></li>
			<li>Complete your profile<br><a href="<?=base_url()?>index.php/profile/edit/4">Edit profile now</a></li>
			<li>You have a pending invite<br><a href="<?=base_url()?>index.php/invites">Check invites now</a></li>
		</ol>
	</div>
	<div class="wrap">
		<a class="help" href="<?=base_url()?>index.php/help">Need help?</a>
	</div>
</div>

<div class="right">
	<div id="dates">
		<h3>Important Dates</h3>
		<p>No upcoming important dates.</p>
		<a href="<?=base_url()?>index.php/important_dates">View all Important Dates</a>
	</div>

	<div id="resources">
		<h3>Resources</h3>
		<ul>
			<li><a href="http://www.wpi.edu/academics/cs/mqp.html" target="_blank">The Computer Science MQP</a></li>
			<li><a href="https://www.wpi.edu/offices/registrar/forms.html" target="_blank">Registrar Forms</a></li>
			<li><a href="http://www.wpi.edu/Pubs/E-project/browse/mqp_by_department/c.html" target="_blank">Electronic Projects Collection</a></li>
		</ul>	
		<a href="<?=base_url()?>index.php/resources">View all Resources</a>
		
	</div>
</div><p class="clear"></p>

<!--New Invites can go in todo list?-->