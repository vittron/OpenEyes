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
	<h3 class="box-title">Contact details:</h3>
	<?php if ($this->checkAccess('OprnEditPatientInfo')) {?>
		<!-- //added edit button @nabin -->
		<!-- <div class="box-actions"> -->
			<button id="btn-edit_contact_info" class="secondary small top-edit">
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
		<div id="view_contact_info">
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo !empty($this->patient->primary_phone) ? $this->patient->primary_phone : 'Unknown'?></div>
				</div>
			</div>
	        <div class="row data-row">
	            <div class="large-4 column">
	                <div class="data-label">Secondary Telephone:</div>
	            </div>
	            <div class="large-8 column">
	                <div class="data-value"><?php echo !empty($this->patient->secondary_phone) ? $this->patient->secondary_phone : 'Unknown'?></div>
	            </div>
	        </div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Email:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo !empty($this->patient->contact->address->email) ? $this->patient->contact->address->email : 'Unknown'?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Next of Kin:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">Unknown</div>
				</div>
			</div>
		</div>
		<!-- //added edit form and script @nabin -->
		<div id="edit_contact_info" style="display:none;">
			<?php
			$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
				'id'=>'edit-contact_info',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('class'=>'sliding'),
			))?>
			<input type="hidden" name="patient_id" value="<?php echo $this->patient ? $this->patient->id : ''?>" />	
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Telephone:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact,'primary_phone')?></div>
				</div>
			</div>
	        <div class="row data-row">
	            <div class="large-4 column">
	                <div class="data-label">Secondary Telephone:</div>
	            </div>
	            <div class="large-8 column">
	                <div class="data-value"><?php echo CHtml::activeTextField($contact,'secondary_phone')?></div>
	            </div>
	        </div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Email:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'email')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Next of Kin:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">Unknown</div>
				</div>
			</div>
			<div id="contact_info_errors" class="alert-box alert hide"></div>
			<div class="buttons">
				<img src="<?php echo Yii::app()->assetManager->createUrl('img/ajax-loader.gif')?>" class="edit_contact_info_loader" style="display: none;" />
				<button type="button" class="secondary small btn_save_contact_info">
					Save
				</button>
				<button class="warning small btn_cancel_contact_info">
					Cancel
				</button>
			</div>
			<?php $this->endWidget()?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#btn-edit_contact_info').click(function() {
		$('#view_contact_info').slideToggle('fast');
		$('#edit_contact_info').slideToggle('fast');
		$('#btn-edit_contact_info').attr('disabled',true);
		$('#btn-edit_contact_info').addClass('disabled');
	});
	$('button.btn_cancel_contact_info').click(function() {
		$('#edit_contact_info').slideToggle('fast');
		$('#view_contact_info').slideToggle('fast');
		$('#btn-edit_contact_info').attr('disabled',false);
		$('#btn-edit_contact_info').removeClass('disabled');
		$('#contact_info_errors').html('').hide();
		return false;
	});
	handleButton($('button.btn_save_contact_info'), function () {
		$('#contact_info_errors').html('').hide();
		$('img.edit_contact_info_loader').show();
		$.post(
			<?= json_encode($this->createUrl('patient/editPatientInfo')) ?>,
			$('#edit-contact_info').serialize(),
			function (result) {
				if (result == true) {
					location.href = <?= json_encode($this->createUrl('patient/view', array('id' => $this->patient->id))) ?>;
				} else {
					enableButtons();
					$('img.edit_contact_info_loader').hide();
					for (var i in result) {
						for (var j in result[i]) {
							$('#contact_info_errors').append('<div>' + result[i][j] + '</div>');
						}
					}
					$('#contact_info_errors').show();
				}
			},
			'json'
		);
	});
</script>