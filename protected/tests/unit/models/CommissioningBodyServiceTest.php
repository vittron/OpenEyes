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

class CommissioningBodyServiceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers CommissioningBodyService::getCorrespondenceName()
	 */
	public function testgetCorrespondenceAddress_nostatic()
	{
		$cbs_name = 'Test Name';
		$cbs_type = new CommissioningBodyServiceType();
		$cbs_type->correspondence_name = null;

		$cbs = new CommissioningBodyService();
		$cbs->name = $cbs_name;
		$cbs->type = $cbs_type;

		$this->assertEquals(array($cbs_name), $cbs->getCorrespondenceName(), 'Correspondence Name should be retrieved from contact when type correspondence name is null');
	}

	/**
	 * @covers CommissioningBodyService::getCorrespondenceName()
	 */
	public function testgetCorrespondenceAddress_withstatic()
	{
		$cbs_name = 'Test Name';
		$cbs_type_name = 'CBS Type Test Name';

		$cbs_type = new CommissioningBodyServiceType();
		$cbs_type->correspondence_name = $cbs_type_name;

		$cbs = new CommissioningBodyService();
		$cbs->name = $cbs_name;
		$cbs->type = $cbs_type;

		$this->assertEquals(array($cbs_name, $cbs_type_name), $cbs->getCorrespondenceName(), 'Correspondence Name should have type name appended when available in the CBS type');
	}

}