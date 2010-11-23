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
 * Class AddressList
 *
 * Address lists management class.
 * @copyright  InfinityLabs - Olck & Lins GbR - 2009-2010
 * @author     Tristan Lins <tristan.lins@infinitylabs.de>
 * @package    Addressbook
 */
class AddressList extends Frontend {
	
	protected function getCurrentPerson() {
		if (!$this->currentPerson) {
			$person = $this->Input->get('person');
			if (preg_match('#_(\d+(\:group\:\d+|\:company\:\d+|\:list\:\d+\:\d+)?)$#', $person, $m)) {
				$this->currentPerson = $m[1];
			}
		}
		return $this->currentPerson;
	}
	protected function generateByListRef(&$list, $rootID = false, $upath = 'root', $level = 0) {
		global $objPage;
		if ($rootID === false)
			$rootID = $list->id;
		$addressTemplate = new FrontendTemplate($this->addressTemplate);
		$addressTemplate->upath = $upath;
		$addressTemplate->cupath = '';
		$addressTemplate->pupath = '';
		$addressTemplate->level = 'level_' . $level;
		$addressTemplate->intLevel = $level;
		$addressTemplate->id = $list->id;
		$addressTemplate->title = $list->title;
		$addressTemplate->description = $list->description;
		$parsed = array();
		if ($list->children) {
			foreach ($list->children as $child) {
				$parsed[] = $this->generateByListRef($child, $rootID, $upath . '-' . $list->id, $level + 1);
			}
			$addressTemplate->cupath = $upath . '-' . $list->id;
		}
		if ($list->persons) {
			$objTemplate = new FrontendTemplate($this->personTemplate);
			$currentPerson = $this->getCurrentPerson();
			foreach ($list->persons as $person) {
				$objTemplate->setData((array)$person);
				$objTemplate->active = ($person->id . (strlen($person->from) ? ':' . $person->from : '')) == $currentPerson;
				$objTemplate->href = $this->generateFrontendUrl($objPage->row(), '/person/' . $person->name . '_' . $person->id . (strlen($person->from) ? ':' . $person->from : ''));
				if (strlen($from)) {
					$objTemplate->previous = $this->getPreviousPerson($person->id, $person->from);
					$objTemplate->next = $this->getNextPerson($person->id, $person->from);
				}
				$objTemplate->group = (object)$this->Addressbook->getAddressGroup($objTemplate->pid)->row();
				if ($objTemplate->company)
					$objTemplate->company = (object)$this->Addressbook->getCompany($objTemplate->company)->row();
				$objTemplate->upath = $upath . '-' . $list->id;
				$parsed[] = $objTemplate->parse();
			}
			$addressTemplate->pupath = $upath . '-' . $list->id;
		}
		$addressTemplate->entries = $parsed;
		return $addressTemplate->parse();
	}
	
	protected function generateByList($id) {
		if ($list = $this->Addressbook->getList($id)) {
			return $this->generateByListRef($list);
		}
		return '';
	}
	
	protected function generateByGroup($id) {
		if ($objGroup = $this->Addressbook->getGroup($id)) {
			$addressTemplate = new FrontendTemplate($this->addressTemplate);
			$addressTemplate->upath = 'group';
			$addressTemplate->title = $objGroup->title;
			$addressTemplate->description = $objGroup->description;
			$parsed = array();
			if ($objPerson = $this->Addressbook->getPersonsByGroup($id, $this->addressListSort)) {
				$objTemplate = new FrontendTemplate($this->personTemplate);
				while ($objPerson->next()) {
					$objTemplate->setData($objPerson->row());
					$objTemplate->href = $this->generateFrontendUrl($objPage->row(), '/person/' . $objPerson->name . '_' . $objPerson->id . (strlen($objPerson->from) ? ':' . $objPerson->from : ''));
					if (strlen($from)) {
						$objTemplate->previous = $this->getPreviousPerson($objPerson->id, $objPerson->from);
						$objTemplate->next = $this->getNextPerson($objPerson->id, $objPerson->from);
					}
					$objTemplate->group = (object)$objGroup->row();
					if ($objTemplate->company)
						$objTemplate->company = (object)$this->Addressbook->getCompany($objTemplate->company)->row();
					$objTemplate->upath = 'group';
					$parsed[] = $objTemplate->parse();
				}
				
			}
			$addressTemplate->entries = $parsed;
			return $addressTemplate->parse();
		}
		return '';
	}
	
	protected function generateByCompany($id) {
		if ($objCompany = $this->Addressbook->getCompany($id)) {
			$addressTemplate = new FrontendTemplate($this->addressTemplate);
			$addressTemplate->upath = 'company';
			$addressTemplate->title = $objCompany->name;
			$addressTemplate->description = $objCompany->description;
			$parsed = array();
			if ($objPerson = $this->Addressbook->getPersonsByCompany($id, $this->addressListSort)) {
				$objTemplate = new FrontendTemplate($this->personTemplate);
				while ($objPerson->next()) {
					$objTemplate->setData($objPerson->row());
					$objTemplate->href = $this->generateFrontendUrl($objPage->row(), '/person/' . $objPerson->name . '_' . $objPerson->id . (strlen($objPerson->from) ? ':' . $objPerson->from : ''));
					if (strlen($from)) {
						$objTemplate->previous = $this->getPreviousPerson($objPerson->id, $objPerson->from);
						$objTemplate->next = $this->getNextPerson($objPerson->id, $objPerson->from);
					}
					$objTemplate->group = (object)$this->Addressbook->getAddressGroup($objTemplate->pid)->row();
					if ($objTemplate->company)
						$objTemplate->company = (object)$objCompany->row();
					$objTemplate->upath = 'company';
					$parsed[] = $objTemplate->parse();
				}
				
			}
			$addressTemplate->entries = $parsed;
			return $addressTemplate->parse();
		}
		return '';
	}
	
	/**
	 * Generate module
	 */
	public function generateContent()
	{
		$this->import('Addressbook');
		
		$source = explode(':', $this->addressListSource, 2);
		$type = $source[0];
		$id = $source[1];
		
		switch ($type) {
		case 'list':
			return $this->generateByList($id);
			
		case 'group':
			return $this->generateByGroup($id);
			
		case 'company':
			return $this->generateByCompany($id);
		}
		return '';
	}
	
}
?>