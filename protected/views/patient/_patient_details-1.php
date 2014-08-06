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
	<h3 class="box-title">Personal Details:</h3>
	<?php if ($this->checkAccess('OprnEditPatientInfo')) {?>
		<!-- //added edit button @nabin -->
		<!-- <div class="box-actions"> -->
			<button id="btn-edit_patient_info" class="secondary small top-edit">
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
		<div id="view_patient_info">	
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">First name(s):</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo $this->patient->first_name?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Last name:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo $this->patient->last_name?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Address:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo $this->patient->getSummaryAddress()?>
					</div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Date of Birth:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo ($this->patient->dob) ? $this->patient->NHSDate('dob') : 'Unknown' ?>
					</div>
				</div>
			</div>

			<div class="row data-row">
				<?php if ($this->patient->date_of_death) { ?>
					<div class="large-4 column">
						<div class="data-label">Date of Death:</div>
					</div>
					<div class="large-8 column">
						<div class="data-value">
							<?php echo $this->patient->NHSDate('date_of_death') . ' (Age '.$this->patient->getAge().')' ?>
						</div>
					</div>
				<?php } else {?>
					<div class="large-4 column">
						<div class="data-label">Age:</div>
					</div>
					<div class="large-8 column">
						<div class="data-value">
							<?php echo $this->patient->getAge()?>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Gender:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo $this->patient->getGenderString() ?>
					</div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Ethnic Group:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo $this->patient->getEthnicGroupString() ?>
					</div>
				</div>
			</div>
		</div>
		<!-- //added edit form and script @nabin -->
		<div id="edit_patient_info" style="display: none;">
		<?php
			$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
				'id'=>'edit-patient_info',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('class'=>'sliding'),
			))?>
			<input type="hidden" name="patient_id" value="<?php echo $this->patient ? $this->patient->id : ''?>" />
			
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">First name(s):</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact,'first_name')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Last name:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact,'last_name')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Address1:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'address1')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Address2:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'address2')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">City:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'city')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Postcode:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'postcode')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">County:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeTextField($contact->address,'county')?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Country:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value"><?php echo CHtml::activeDropDownList($contact->address, 'country_id',CHtml::listData(Country::model()->findAll(array('order'=>'name')),'id','name')) ?></div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Date of Birth:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						    'model'=>$this->patient,
						    'attribute'=>'dob',
						    // additional javascript options for the date picker plugin
						    'options'=>array(
						        'showAnim'=>'fold',
						        'dateFormat'=>'d M yy'
						    ),
						    'htmlOptions'=>array(
						        'value' => $this->patient->NHSDate('dob')
						    ),
						));?>
					</div>
				</div>
			</div>

			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Date of Death:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						    'model'=>$this->patient,
						    'attribute'=>'date_of_death',
						    // additional javascript options for the date picker plugin
						    'options'=>array(
						        'showAnim'=>'fold',
						        'dateFormat'=>'d M yy'
						    ),
						    'htmlOptions'=>array(
						        'value' => $this->patient->NHSDate('date_of_death')
						    ),
						));?>
					</div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Gender:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo CHtml::activeDropDownList($this->patient, 'gender',array('M'=>'Male','F'=>'Female')) ?>
					</div>
				</div>
			</div>
			<div class="row data-row">
				<div class="large-4 column">
					<div class="data-label">Ethnic Group:</div>
				</div>
				<div class="large-8 column">
					<div class="data-value">
						<?php echo CHtml::activeDropDownList($this->patient, 'ethnic_group_id',CHtml::listData(EthnicGroup::model()->findAll(array('order'=>'name')),'id','name')) ?>
					</div>
				</div>
			</div>
			<div id="patient_info_errors" class="alert-box alert hide"></div>
			<div class="buttons">
				<img src="<?php echo Yii::app()->assetManager->createUrl('img/ajax-loader.gif')?>" class="edit_patient_info_loader" style="display: none;" />
				<button type="button" class="secondary small btn_save_patient_info">
					Save
				</button>
				<button class="warning small btn_cancel_patient_info">
					Cancel
				</button>
			</div>	
			<?php $this->endWidget()?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#btn-edit_patient_info').click(function() {
		$('#view_patient_info').slideToggle('fast');
		$('#edit_patient_info').slideToggle('fast');
		$('#btn-edit_patient_info').attr('disabled',true);
		$('#btn-edit_patient_info').addClass('disabled');
	});
	$('button.btn_cancel_patient_info').click(function() {
		$('#edit_patient_info').slideToggle('fast');
		$('#view_patient_info').slideToggle('fast');
		$('#btn-edit_patient_info').attr('disabled',false);
		$('#btn-edit_patient_info').removeClass('disabled');
		$('#patient_info_errors').html('').hide();
		return false;
	});
	handleButton($('button.btn_save_patient_info'), function () {
		$('#patient_info_errors').html('').hide();
		$('img.edit_patient_info_loader').show();
		$.post(
			<?= json_encode($this->createUrl('patient/editPatientInfo')) ?>,
			$('#edit-patient_info').serialize(),
			function (result) {
				if (result == true) {
					location.href = <?= json_encode($this->createUrl('patient/view', array('id' => $this->patient->id))) ?>;
				} else {
					enableButtons();
					$('img.edit_patient_info_loader').hide();
					for (var i in result) {
						for (var j in result[i]) {
							$('#patient_info_errors').append('<div>' + result[i][j] + '</div>');
						}
					}
					$('#patient_info_errors').show();
				}
			},
			'json'
		);
	});
</script>