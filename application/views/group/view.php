<pre>
<?php
//print_r($group_item);
?>
</pre>

<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col">
	<img src="unknown.png" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col">
	<a href="/index.php/group/edit/<?php echo $group_item['id'];?>"><button class="edit">Edit Page</button></a>
	<div class="info">
		<label class="title">Title:</label><label><?php echo $group_item['group_name'];?></label><br/>
		<?php
		foreach($group_item['users'] as $a_user){
		?>
		<label class="title"><?php echo($a_user['user_status'] == "Advisor" ? "Advisor" : $a_user['user_major1']);?>:</label><label>Madalyn Coryea</label><br/>
		<?php
		}
		?>
		
		<br/>
		<label class="title">Interests:</label><br/>
		<?php
			foreach ($group['tags'] as $tag){
				?>
				<p><?php echo $tag['tag_text']?></p>
				<?php
			}
		?>
		<label class="title">Description:</label>
		<label>
			<?php echo $group_item['group_description'];?>
		</label><br/>
		<br/>
		<label class="title">Contact:</label><label><?php echo $group_item['group_contact'];?></label>
	</div>
</div><!--right column-->