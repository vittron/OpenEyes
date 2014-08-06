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

class OEPDFPrint
{
	protected $letters = array();
	protected $pdf;

	public function __construct($author, $title, $subject)
	{
		$this->pdf = new OETCPDF('P', true);
		$this->pdf->SetAuthor($author);
		$this->pdf->SetTitle($title);
		$this->pdf->SetSubject($subject);
	}

	public function addLetter($letter)
	{
		$this->letters[] = $letter;
	}

	public function addLetterRender($letter)
	{
		$letter->render($this->pdf);
	}


	public function output()
	{
		foreach ($this->letters as $letter) {
			$letter->render($this->pdf);
		}
		$this->pdf->Output($this->pdf->getDocref().".pdf", "I");
	}

}