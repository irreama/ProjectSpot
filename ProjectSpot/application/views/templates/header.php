<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title ?> - ProjectSpot</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/default.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/student.css">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="<?=base_url()?>js/default.js"></script>
	</head>
	
	<body>
		<div id="container">
			<div class="banner">
				<h1 class="clearfix">ProjectSpot</h1>
				<div class="nav clearfix">
					<ul>
						<li><a href="<?=base_url()?>"><img class="nav-image" src="<?=base_url()?>images/home_icon.png"><span>Dashboard</span></a></li> <!--Change to /-->
						<li><a href="<?=base_url()?>index.php/profile/view/4"><img class="nav-image" src="<?=base_url()?>images/profile_icon.png"><span>Profile</span></a></li> <!--student, advisor pages (no profile template?)/-->
						<li><a href="<?=base_url()?>index.php/group"><img class="nav-image" src="<?=base_url()?>images/group_icon.png"><span>Group</span></a></li>
						<li><a href="<?=base_url()?>index.php/browse"><img class="nav-image" src="<?=base_url()?>images/find_icon2.png"><span>Find</span></a></li>
						<li><a href="<?=base_url()?>index.php/invites"><img class="nav-image" src="<?=base_url()?>images/mail_icon.png"><span>Invites</span></a></li>
					</ul>
				</div>
			</div>
			<div class="welcome">Welcome Test User, <a href="<?=base_url()?>index.php/home">Logout</a></div>
			
			<div class="content">