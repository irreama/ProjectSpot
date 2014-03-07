<link rel="stylesheet" type="text/css" href="<?=base_url()?>stylesheets/admin_dates.css">
<div class="page-title">

</div>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>URL</th>
			<th>Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dates as $aDate){ ?>
		<tr>
			<td><?= $aDate['date_title']?></td>
			<td><?= $aDate['date_link']?></td>
			<td><?= $aDate['date_timestamp']?></td>
			<td><?= $aDate['id']?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>