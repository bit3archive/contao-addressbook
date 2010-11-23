<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2009-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  InfinityLabs - Olck & Lins GbR - 2009-2010
 * @author     Tristan Lins <tristan.lins@infinitylabs.de>
 * @package    Addressbook
 * @license    LGPL 
 * @filesource
 */


/**
 * Class AddressDetails
 *
 * Address details class.
 * @copyright  InfinityLabs - Olck & Lins GbR - 2009-2010
 * @author     Tristan Lins <tristan.lins@infinitylabs.de>
 * @package    Addressbook
 */
class AddressDetails extends Frontend {
	
	/**
	 * Generate module
	 */
	public function generateContent()
	{
		global $objPage;
		$this->import('Addressbook');
		$this->import('Input');
		
		$person = $this->Input->get('person');
		$from = '';
		if (preg_match('#_(\d+)(\:group\:\d+|\:company\:\d+|\:list\:\d+\:\d+)?$#', $person, $m)) {
			$person = $m[1];
			$from = substr($m[2], 1);
		} else {
			$person = $this->addressSource;
		}
		
		$objPerson = $this->Addressbook->getPerson($person);
		if ($objPerson) {
			$objTemplate = new FrontendTemplate($this->personTemplate);
			$objTemplate->setData($objPerson->row());
			$objTemplate->href = $this->generateFrontendUrl($objPage->row(), '/person/' . $objPerson->name . '_' . $objPerson->id . (strlen($from) ? ':' . $from : ''));
			if (strlen($from)) {
				if ($previous = $this->Addressbook->getPreviousPerson($objPerson->id, $from)) {
					$objTemplate->previous = $this->generateFrontendUrl($objPage->row(), '/person/' . $previous->name . '_' . $previous->id . (strlen($previous->from) ? ':' . $previous->from : ''));
				}
				if ($next = $this->Addressbook->getNextPerson($objPerson->id, $from)) {
					$objTemplate->next = $this->generateFrontendUrl($objPage->row(), '/person/' . $next->name . '_' . $next->id . (strlen($next->from) ? ':' . $next->from : ''));
				}
			}
			$objTemplate->from = $from;
			$objTemplate->group = (object)$this->Addressbook->getAddressGroup($objTemplate->pid)->row();
			if ($objTemplate->company)
				$objTemplate->company = (object)$this->Addressbook->getCompany($objTemplate->company)->row();
			$objTemplate->upath = 'details';
			return $objTemplate->parse();
		} else {
			return '';
		}
	}
	
}
?>