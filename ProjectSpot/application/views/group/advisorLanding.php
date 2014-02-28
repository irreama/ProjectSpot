<!--Rename this stylesheet link after whatever you name this file, and then put in stylesheets folder -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/YOUR_NAME_HERE.css">

<a class="edit button-element-small" href="<?=base_url()?>index.php/group/new/">Create a Group</a>

<!--for loop here: each project is it's own div. projects listed in alphabetical order-->
<?php
	foreach($group_item as $aGroup){
	?>

	<div class="project">
		<!--This <a> tag is a link to the page for this group-->
		<a class="project-tile" href="<?=base_url()?>index.php/group/view/<?=$aGroup['group_id']?>">
			<div class="project-span">
				<!--This image is either the group's image or the default-->
				<img src="<?=base_url()?><?=($aGroup['group_avatar'] ? $aGroup['group_avatar'] : "images/no_profile_icon2.png")?>" alt="project1"/>
				<!--Group title-->
				<h3><?=$aGroup['group_name']?></h3>
			</div>
		</a>
	</div>

	<?php
	}
?>
