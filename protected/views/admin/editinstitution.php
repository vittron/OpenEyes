<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

?>
<div class="box admin">
    <h2>Edit institution</h2>
    <?php $this->renderPartial('_form_institution', array(
        'institution' => $institution,
        'address' => $address,
        'errors' => $errors,
    )); ?>
</div>

<div class="box admin">
	<h2>Sites</h2>
	<form id="admin_institution_sites">
		<table class="grid">
			<thead>
				<tr>
					<th>ID</th>
					<th>Remote ID</th>
					<th>Name</th>
					<th>Address</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$criteria = new CDbCriteria;
				$criteria->compare('institution_id',$institution->id);
				$criteria->order = 'name asc';
				foreach (Site::model()->findAll($criteria) as $i => $site) {?>
					<tr class="clickable" data-id="<?php echo $site->id?>" data-uri="admin/editsite?site_id=<?php echo $site->id?>">
						<td><?php echo $site->id?></td>
						<td><?php echo $site->remote_id?>&nbsp;</td>
						<td><?php echo $site->name?>&nbsp;</td>
						<td><?php echo $site->getLetterAddress(array('delimiter'=>', '))?>&nbsp;</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>

<script type="text/javascript">
	handleButton($('#et_cancel'),function(e) {
		e.preventDefault();
		window.location.href = baseUrl+'/admin/institutions';
	});
</script>
