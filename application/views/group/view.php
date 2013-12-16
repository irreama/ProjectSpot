<pre>
<?php
print_r($group_item);
?>
</pre>

<div class="page-title">
	<h2>This is a group page</h2>
</div>
<div class="left_col">
	<img src="unknown.png" width=200 height=200 alt="profile image"/>
</div><!--left column-->

<div class="right_col">
	<a href="edit_group.html"><button class="edit">Edit Page</button></a>
	<div class="info">
		<label class="title">Title:</label><label><?php echo $group_item['group_name'];?></label><br/>
		<label class="title">Major 1:</label><label>Madalyn Coryea</label><br/>
		<label class="title">Major 2:</label><label>Anthony Fisher</label><br/>
		<label class="title">Advisor:</label><label>David C. Brown</label><br/>
		<br/>
		<label class="title">Interests:</label><br/>
		<label class="title">Description:</label>
		<label>
			<?php echo $group_item['group_description'];?>
		</label><br/>
		<br/>
		<label class="title">Contact:</label><label><?php echo $group_item['group_contact'];?></label>
	</div>
</div><!--right column-->