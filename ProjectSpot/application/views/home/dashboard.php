<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/dashboard.css">
<div class="help-text">
	This is the Dashboard. From here you can see your To-Do list, which
	helps you. You can also get to useful Resources about the MQP, as well
	as Important Dates that are listed by the CS department.
	<a class="close" href="#">X</a>
</div>
<h2>Dashboard</h2><p class="clear"></p>
<?php 
	$ci = & get_instance();
?>
<div class="welcome">Welcome, <?=$ci->session->userdata('display_name') ?>!</div>
<div class="left">
	<div id="todo">
		<h3>To-Do List</h3>
		<ol>
			<?php
			foreach($messages['user'] as $aUserMessage){
			?>

			<li><?=$aUserMessage['text']?><br><a href="<?=base_url()?>index.php/<?=$aUserMessage['link']?>"><?=$aUserMessage['linkText']?></a></li><br>
			<?php
			}
			?>
			<!--li>You have a pending invite<br><a href="<?=base_url()?>index.php/invites">Check invites now</a></li-->
		</ol>

	<?php
	foreach($messages['group'] as $aGroup){
		?>
		<h4><?=$aGroup['name']?></h4>
		<ol>
			<?php
			foreach($aGroup['messages'] as $aGroupMessage){
			?>

			<li><?=$aGroupMessage['text']?><br><a href="<?=base_url()?>index.php/<?=$aGroupMessage['link']?>"><?=$aGroupMessage['linkText']?></a></li><br>
			<?php
			}
			?>
			<!--li>You have a pending invite<br><a href="<?=base_url()?>index.php/invites">Check invites now</a></li-->
		</ol>
		<?php
	}
	?>
		
	</div>
	<!--div class="wrap">
		<a class="help" href="<?=base_url()?>index.php/help">Need help?</a>
	</div-->
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