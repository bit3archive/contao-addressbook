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
 * Class Addressbook
 *
 * Addressbook data access class.
 * @copyright  InfinityLabs - Olck & Lins GbR - 2009-2010
 * @author     Tristan Lins <tristan.lins@infinitylabs.de>
 * @package    Addressbook
 */
class Addressbook extends Controller {
	
	public static $personFields = array(
		'sorting',
		'sex',
		'name',
		'title',
		'position',
		'job',
		'email',
		'fon',
		'mobile',
		'fax',
		'homepage',
		'address',
		'city',
		'country',
		'icq',
		'google',
		'aim',
		'yahoo',
		'skype',
		'jabber',
		'xing',
		'facebook',
		'stayfriends',
		'wkw',
		'twitter',
		'published',
		'random'
	);
	
	public static $groupFields = array(
		'title',
		'random'
	);
	
	public static $companyFields = array(
		'name',
		'email',
		'fon',
		'fax',
		'homepage',
		'address',
		'city',
		'country',
		'random'
	);
	
	public static $listFields = array(
		'sorting',
		'title'
	);
	
	protected function checkSort($sort, $array, $defaultSort) {
		$sort = explode(',', $sort);
		$valid = array();
		foreach ($sort as $item) {
			if (preg_match('#^(\w+)( ASC| DESC)?$#', $item, $match) && in_array($match[1], $array)) {
				if ($match[1] == 'random')
					$valid[] = 'RAND()';
				else
					$valid[] = $item;
			}
		}
		if (count($valid))
			return implode(', ', $valid);
		else
			return $defaultSort;
	}
	
	public function getCompanies($sort = 'name') {
		$this->import('Database');
		return $this->Database->execute('SELECT * FROM tl_company ORDER BY '.$this->checkSort($sort, Addressbook::$companyFields, 'name'));
	}
	
	public function getCompany($id) {
		$this->import('Database');
		$objCompany = $this->Database->prepare('SELECT * FROM tl_company WHERE id = ?')
									 ->execute($id);
		if ($objCompany->next())
			return $objCompany;
		return false;
	}
	
	public function getCompanyName($id) {
		$this->import('Database');
		$id = intval($id);
		if ($id > 0) {
			$obj = $this->Database->prepare("SELECT name FROM tl_company WHERE id=?")
						->limit(1)
						->execute(intval($id));
			if ($obj->next() && strlen($obj->name)) {
				return $obj->name;
			}
		}
		return '';
	}
	
	public function getAddressGroups($sort = 'title') {
		$this->import('Database');
		return $this->Database->execute('SELECT * FROM tl_address_group ORDER BY '.$this->checkSort($sort, Addressbook::$groupFields, 'title'));
	}
	
	public function getAddressGroup($id) {
		$this->import('Database');
		$objAddressGroup = $this->Database->prepare('SELECT * FROM tl_address_group WHERE id = ?')
										  ->execute($id);
		if ($objAddressGroup->next())
			return $objAddressGroup;
		return false;
	}
	
	public function getPersonsByCompany($company, $sort = 'sorting') {
		$this->import('Database');
		return $this->Database->prepare('SELECT *, CONCAT(\'company:\', ?) as `from` FROM tl_person WHERE company = ? ORDER BY '.$this->checkSort($sort, Addressbook::$personFields, 'sorting'))
							  ->execute($company, $company);
	}
	
	public function getPersonsByGroup($group, $sort = 'sorting') {
		$this->import('Database');
		return $this->Database->prepare('SELECT *, CONCAT(\'group:\', ?) as `from` FROM tl_person WHERE pid = ? ORDER BY '.$this->checkSort($sort, Addressbook::$personFields, 'sorting'))
							  ->execute($group, $group);
	}
	
	public function getPersonsByList($list, $rootID = false) {
		$this->import('Database');
		if ($rootID === false)
			$rootID = $list->id;
		return $this->Database->prepare('SELECT p.*, CONCAT(\'list:\', ?, \':\', i.id) as `from` FROM tl_person p INNER JOIN tl_address_list_item i ON i.person = p.id WHERE i.pid = ? ORDER BY i.sorting')
							  ->execute($rootID, $list);
	}
	
	public function getPerson($id) {
		$this->import('Database');
		$objPerson = $this->Database->prepare('SELECT * FROM tl_person WHERE id = ?')
									 ->execute($id);
		if ($objPerson->next())
			return $objPerson;
		return false;
	}
	
	private function reverseSort($sort) {
		if (preg_match('#^(\w+)( ASC| DESC)$#', $sort, $match)) {
			switch ($match[2]) {
			case ' ASC': return $match[1] . ' DESC';
			case ' DESC': return $match[1] . ' ASC';
			}
		} else {
			return $sort . ' DESC';
		}
	}
	
	private function walkPersonByCompany($id, $company, $sort = 'sorting', $reverse = false) {
		$objPerson = $this->getPersonsByCompany($company, $reverse ? $this->reverseSort($sort) : $sort);
		while ($objPerson->next()) {
			if ($objPerson->id == $id) {
				if ($objPerson->next()) {
					$person = (Object)$objPerson->row();
					$person->from = sprintf('company:%s', $group);
					return $person;
				}
				break;
			}
		}
		return false;
	}
	
	public function getPreviousPersonByCompany($id, $company, $sort = 'sorting') {
		return $this->walkPersonByCompany($id, $company, $sort, true);
	}
	
	public function getNextPersonByCompany($id, $company, $sort = 'sorting') {
		return $this->walkPersonByCompany($id, $company, $sort, false);
	}
	
	private function walkPersonByGroup($id, $group, $sort = 'sorting', $reverse = false) {
		$objPerson = $this->getPersonsByGroup($group, $reverse ? $this->reverseSort($sort) : $sort);
		while ($objPerson->next()) {
			if ($objPerson->id == $id) {
				if ($objPerson->next()) {
					$person = (Object)$objPerson->row();
					$person->from = sprintf('group:%s', $group);
					return $person;
				}
				break;
			}
		}
		return false;
	}
	
	public function getPreviousPersonByGroup($id, $group, $sort = 'sorting') {
		return $this->walkPersonByGroup($id, $group, $sort, true);
	}
	
	public function getNextPersonByGroup($id, $group, $sort = 'sorting') {
		return $this->walkPersonByGroup($id, $group, $sort, false);
	}
	
	private function walkListWithItems($id, $rootID, $reverse = false) {
		$objList = $this->Database->prepare('SELECT * FROM (SELECT l1.*, (SELECT COUNT(*) FROM tl_address_list_item i WHERE i.pid = l1.id) as items FROM tl_address_list l1 INNER JOIN tl_address_list l2 ON l2.pid = l1.pid WHERE l2.id = ?) as t WHERE items > 0 ORDER BY sorting' . ($reverse ? ' DESC' : ''))
								  ->execute($id);
		while ($objList->next()) {
			if ($objList->id == $id) {
				if ($objList->next())
					return $objList;
				else
					return false;
			}
		}
		if ($id != $rootID) {
			$objList = $this->Database->prepare('SELECT pid FROM tl_address_list WHERE id = ?')
									  ->execute($id);
			if ($objList->next())
				return $this->walkListWithItems($objList->pid, $rootID, $reverse);
		}
		return false;
	}
	
	private function walkPersonByList($id, $list, $item, $reverse = false) {
		$objItem = $this->Database->prepare('SELECT i1.id, i1.pid, i1.person FROM tl_address_list_item i1 INNER JOIN tl_address_list_item i2 ON i2.pid = i1.pid WHERE i2.id = ? ORDER BY i1.sorting' . ($reverse ? ' DESC' : ''))
								  ->execute($item);
		while ($objItem->next()) {
			if ($objItem->id == $item) {
				if ($objItem->next()) {
					$person = (Object)$this->getPerson($objItem->person)->row();
					$person->from = sprintf('list:%s:%s', $list, $objItem->id);
					return $person;
				} else if ($objItem->pid != $list) {
					if ($previousList = $this->walkListWithItems($objItem->pid, $list, $reverse)) {
						$objItem = $this->Database->prepare('SELECT * FROM tl_address_list_item WHERE pid = ? ORDER BY sorting' . ($reverse ? ' DESC' : '') . ' LIMIT 1')
												  ->execute($previousList->id);
												  
						if ($objItem->next()) {
							$person = (Object)$this->getPerson($objItem->person)->row();
							$person->from = sprintf('list:%s:%s', $list, $objItem->id);
							return $person;
						}
					}
				}
			}
		}
		return false;
	}
	
	public function getPreviousPersonByList($id, $list, $item) {
		return $this->walkPersonByList($id, $list, $item, true);
	}
	
	public function getNextPersonByList($id, $list, $item) {
		return $this->walkPersonByList($id, $list, $item, false);
	}
	
	public function getPreviousPerson($id, $from, $sort = 'sorting') {
		$m = explode(':', $from);
		switch ($m[0]) {
		case 'company';
			return $this->getPreviousPersonByCompany($id, $m[1], $sort);
		
		case 'group':
			return $this->getPreviousPersonByGroup($id, $m[1], $sort);
		
		case 'list':
			return $this->getPreviousPersonByList($id, $m[1], $m[2]);
		}
		return false;
	}
	
	public function getNextPerson($id, $from, $sort = 'sorting') {
		$m = explode(':', $from);
		switch ($m[0]) {
		case 'company';
			return $this->getNextPersonByCompany($id, $m[1], $sort);
		
		case 'group':
			return $this->getNextPersonByGroup($id, $m[1], $sort);
		
		case 'list':
			return $this->getNextPersonByList($id, $m[1], $m[2]);
		}
		return false;
	}
	
	public function getListChildren($pid = 0) {
		$this->import('Database');
		$objList = $this->Database->prepare('SELECT * FROM tl_address_list WHERE pid = ? ORDER BY sorting')
								  ->execute($pid);
		$array = array();
		while ($objList->next()) {
			$item = $objList->row();
			$item['children'] = $this->getListChildren($objList->id, $sort);	
			$array[] = (Object)$item;
		}
		if (count($array))
			return $array;
		return false;
	}
	
	public function getListStructure($id = 0) {
		if ($id == 0) {
			return (Object)array(
				'id' => 0,
				'pid' => 0,
				'sorting' => 0,
				'tstamp' => time(),
				'title' => 'ROOT',
				'description' => '',
				'children' => $this->getListChildren()
			);
		}
		$this->import('Database');
		$objList = $this->Database->prepare('SELECT * FROM tl_address_list WHERE id = ? ORDER BY sorting')
								  ->execute($id);
		if ($objList->next()) {
			$list = $objList->row();
			$list['children'] = $this->getListChildren($objList->id);
			return (Object)$list;
		}
		return false;
	}
	
	private function extendListStructure(&$list, $rootID = false) {
		if ($rootID === false)
			$rootID = $list->id;
		$list->persons = array();
		$objPersons = $this->getPersonsByList($list->id, $rootID);
		while ($objPersons->next()) {
			$list->persons[] = (Object)$objPersons->row();
		}
		if ($list->children) {
			foreach ($list->children as &$children) {
				$this->extendListStructure($children, $rootID);
			}
		}
	}
	
	public function getList($id) {
		$list = $this->getListStructure($id);
		$this->extendListStructure($list);
		return $list;
	}
	
}
?>