<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<section class="box patient-info js-toggle-container">
	<h3 class="box-title">General Practitioner:</h3>
	<?php if ($this->checkAccess('OprnEditPatientInfo')) {?>
		<!-- //added edit button @nabin -->
		<!-- <div class="box-actions"> -->
			<button id="btn-edit_gp_info" class="secondary small top-edit">
				Edit
			</button>
		<!-- </div> -->
	<?php }?>
	<a href="#" class="toggle-trigger toggle-hide js-toggle">
		<span class="icon-showhide">
			Show/hide this section
		</span>
	</a>
	<div class="js-toggle-body">
		<div id="view_gp_info">
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Name:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo ($this->patient->gp) ? $this->patient->gp->contact->fullName : 'Unknown'; ?></div>
				</div>
			</div>
			<?php if (Yii::app()->user->checkAccess('admin')) { ?>
			<div class="row data-row highlight">
				<div class="large-4 column">
					<div class="data-label">GP Address:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo ($this->patient->gp && $this->patient->gp->contact->address) ? $this->patient->gp->contact->address->letterLine : 'Unknown'; ?></div>
				</div>
			</div>
			<div class="row data-row highlight">
				<div class="large-4 column">
					<div class="data-label">GP Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo ($this->patient->gp && $this->patient->gp->contact->primary_phone) ? $this->patient->gp->contact->primary_phone : 'Unknown'; ?></div>
				</div>
			</div>
			<?php } ?>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Address:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo ($this->patient->practice && $this->patient->practice->contact->address) ? $this->patient->practice->contact->address->letterLine : 'Unknown'; ?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo ($this->patient->practice && $this->patient->practice->phone) ? $this->patient->practice->phone : 'Unknown'; ?></div>
				</div>
			</div>
		</div>
		<!-- //added edit form and script @nabin -->
		<div id="edit_gp_info" style="display:none;">
			<?php
			$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
				'id'=>'edit-gp_info',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('class'=>'sliding'),
			))?>
			<input type="hidden" name="patient_id" value="<?php echo $this->patient ? $this->patient->id : ''?>" />
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP First name:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact,'first_name')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Last name:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact,'last_name')?></div>
				</div>
			</div>
			<?php if (Yii::app()->user->checkAccess('admin')) { ?>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Address1:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact->address,'address1')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Address2:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact->address,'address2')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP City:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact->address,'city')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Postcode:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact->address,'postcode')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP County:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact->address,'county')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Country:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeDropDownList($gp->contact->address, 'country_id',CHtml::listData(Country::model()->findAll(array('order'=>'name')),'id','name')) ?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">GP Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($gp->contact,'primary_phone')?></div>
				</div>
			</div>
			<?php } ?>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Address1:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice->contact->address,'address1',array('name'=>'PAddress[address1]','id'=>'PAddress_address1'))?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Address2:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice->contact->address,'address2',array('name'=>'PAddress[address2]','id'=>'PAddress_address2'))?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice City:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice->contact->address,'city',array('name'=>'PAddress[city]','id'=>'PAddress_city'))?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Postcode:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice->contact->address,'postcode',array('name'=>'PAddress[postcode]','id'=>'PAddress_postcode'))?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice County:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice->contact->address,'county',array('name'=>'PAddress[county]','id'=>'PAddress_county'))?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Country:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeDropDownList($practice->contact->address, 'country_id',CHtml::listData(Country::model()->findAll(array('order'=>'name')),'id','name'),array('name'=>'PAddress[country_id]','id'=>'PAddress_country_id')) ?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Practice Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($practice,'phone')?></div>
				</div>
			</div>
			<div id="gp_info_errors" class="alert-box alert hide"></div>
			<div class="buttons">
				<img src="<?php echo Yii::app()->assetManager->createUrl('img/ajax-loader.gif')?>" class="edit_gp_info_loader" style="display: none;" />
				<button type="button" class="secondary small btn_save_gp_info">
					Save
				</button>
				<button class="warning small btn_cancel_gp_info">
					Cancel
				</button>
			</div>
			<?php $this->endWidget()?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#btn-edit_gp_info').click(function() {
		$('#view_gp_info').slideToggle('fast');
		$('#edit_gp_info').slideToggle('fast');
		$('#btn-edit_gp_info').attr('disabled',true);
		$('#btn-edit_gp_info').addClass('disabled');
	});
	$('button.btn_cancel_gp_info').click(function() {
		$('#edit_gp_info').slideToggle('fast');
		$('#view_gp_info').slideToggle('fast');
		$('#btn-edit_gp_info').attr('disabled',false);
		$('#btn-edit_gp_info').removeClass('disabled');
		$('#gp_info_errors').html('').hide();
		return false;
	});
	handleButton($('button.btn_save_gp_info'), function () {
		$('#gp_info_errors').html('').hide();
		$('img.edit_gp_info_loader').show();
		$.post(
			<?= json_encode($this->createUrl('patient/editGpInfo')) ?>,
			$('#edit-gp_info').serialize(),
			function (result) {
				if (result == true) {
					location.href = <?= json_encode($this->createUrl('patient/view', array('id' => $this->patient->id))) ?>;
				} else {
					enableButtons();
					$('img.edit_gp_info_loader').hide();
					for (var i in result) {
						for (var j in result[i]) {
							$('#gp_info_errors').append('<div>' + result[i][j] + '</div>');
						}
					}
					$('#gp_info_errors').show();
				}
			},
			'json'
		);
	});
</script>