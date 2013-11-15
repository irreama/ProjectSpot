<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to ProjectSpot</title>
		<link rel="stylesheet" type="text/css" href="default.css">
		<link rel="stylesheet" type="text/css" href="student.css">
	</head>
	
	<body>
		<div class="banner">
			<h1>ProjectSpot</h1>
			<div class="nav">
				<ul>
					<li><a href="index.html">Main Menu</a></li> <!--Change to /-->
					<li><a href="browse.html">Browse</a></li>
					<li><a href="student.html">Profile</a></li> <!--student, advisor pages (no profile template?)/-->
					<li><a href="group.html">Group</a></li>
					<li><a href="index.html">Logout</a></li>
				</ul>
			</div>
			<div>Welcome User</div>
		</div>
		
		<div class="content">
			<div class="left_col">
				<img src="unknown.png" width=200 height=200 alt="profile image"/>
				<button>Clear Image</button>
				<button>Upload an Image</button>
			</div><!--left column-->
			
			<div class="right_col">
				<div class="info">
					<label class="title">Name:</label><label>Madalyn Coryea</label><br/>
					<label class="title">Major 1:</label><label>Computer Science</label><br/>
					<label class="title">Major 2:</label><br/>
					<label class="title">Graduation Year:</label><label>2014</label><br/>
					<label class="title">Gender:</label>
						<input name="gender" type="radio" /><label>Female</label>
						<input name="gender" type="radio" /><label>Male</label>
						<input name="gender" type="radio" /><label>Other/No Answer</label><br/>
					<br/>
					<label class="title">MQP:</label><a href="group.html">ProjectSpot</a><br/>
					<br/>
					<label class="title">Interests:</label><br/>
					<a href="interests.html"><button class="edit">Edit Interests</button></a>
					
					<label class="title">Description:</label>
					<textarea rows=5 cols=50>I like graphics, and I really want to work with upbeat, spirited people who are passionate about the Web!
					</textarea>
					<br/>
					<label class="title">Contact:</label><label>mcoryea14@wpi.edu</label>
					
					<div class="button_panel">
						<a href="student.html"><button class="cancel">Cancel</button></a>
						<a href="student.html"><button class="edit">Save</button></a>
					</div>
				</div>
			</div><!--right column-->
		</div>
	</body>
</html>