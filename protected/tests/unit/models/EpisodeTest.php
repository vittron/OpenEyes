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
class EpisodeTest extends CDbTestCase {

	   /**
	    * @var Episode
	    */
	   protected $model;

	   /**
	    * Sets up the fixture, for example, opens a network connection.
	    * This method is called before a test is executed.
	    */
	   protected function setUp() {
		      parent::setUp();
		      $this->model = new Episode;
	   }

	   /**
	    * Tears down the fixture, for example, closes a network connection.
	    * This method is called after a test is executed.
	    */
	   protected function tearDown() {

	   }

	   /**
	    * @covers Episode::model
	    * @todo   Implement testModel().
	    */
	   public function testModel() {

		      $this->assertEquals('Episode', get_class(Episode::model()), 'Class name should match model.');
	   }

	   /**
	    * @covers Episode::tableName
	    * @todo   Implement testTableName().
	    */
	   public function testTableName() {

		      $this->assertEquals('episode', $this->model->tableName());
	   }

	   /**
	    * @covers Episode::defaultScope
	    * @todo   Implement testDefaultScope().
	    */
	   public function testDefaultScope() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::rules
	    * @todo   Implement testRules().
	    */
	   public function testRules() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::relations
	    * @todo   Implement testRelations().
	    */
	   public function testRelations() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::attributeLabels
	    * @todo   Implement testAttributeLabels().
	    */
	   public function testAttributeLabels() {

		      $expected = array(
			       'id' => 'ID',
			       'patient_id' => 'Patient',
			       'firm_id' => 'Firm',
			       'start_date' => 'Start Date',
			       'end_date' => 'End Date',
			       'episode_status_id' => 'Current Status',
		      );

		      $this->assertEquals($expected, $this->model->attributeLabels());
	   }

	   /**
	    * @covers Episode::search
	    * @todo   Implement testSearch().
	    */
	   public function testSearch() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::hasEventOfType
	    * @todo   Implement testHasEventOfType().
	    */
	   public function testHasEventOfType() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getBySubspecialtyAndPatient
	    * @todo   Implement testGetBySubspecialtyAndPatient().
	    */
	   public function testGetBySubspecialtyAndPatient() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getPrincipalDiagnosisDisorderTerm
	    * @todo   Implement testGetPrincipalDiagnosisDisorderTerm().
	    */
	   public function testGetPrincipalDiagnosisDisorderTerm() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getCurrentEpisodeByFirm
	    * @todo   Implement testGetCurrentEpisodeByFirm().
	    */
	   public function testGetCurrentEpisodeByFirm() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getMostRecentEventByType
	    * @todo   Implement testGetMostRecentEventByType().
	    */
	   public function testGetMostRecentEventByType() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getAllEventsByType
	    * @todo   Implement testGetAllEventsByType().
	    */
	   public function testGetAllEventsByType() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::save
	    * @todo   Implement testSave().
	    */
	   public function testSave() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getHidden
	    * @todo   Implement testGetHidden().
	    */
	   public function testGetHidden() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::getOpen
	    * @todo   Implement testGetOpen().
	    */
	   public function testGetOpen() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::setPrincipalDiagnosis
	    * @todo   Implement testSetPrincipalDiagnosis().
	    */
	   public function testSetPrincipalDiagnosis() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers Episode::audit
	    * @todo   Implement testAudit().
	    */
	   public function testAudit() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

}
