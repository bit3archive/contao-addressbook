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
	
	public function getPersons($id, $sort = 'sorting') {
		$this->import('Database');
		$id = explode(':', $id);
		$objPerson = false;
		switch ($id[0]) {
		case 'group':
			$objPerson = $this->getPersonsByGroup($id[1], $sort);
			break;
			
		case 'company':
			$objPerson = $this->getPersonsByCompany($id[1], $sort);
			break;
		}
		return $objPerson;
	}
	
	public function getPersonsByCompany($company, $sort = 'sorting') {
		$this->import('Database');
		return $this->Database->prepare('SELECT * FROM tl_person WHERE company = ? ORDER BY '.$this->checkSort($sort, Addressbook::$personFields, 'sorting'))
							  ->execute($company);
	}
	
	public function getPersonsByGroup($group, $sort = 'sorting') {
		$this->import('Database');
		return $this->Database->prepare('SELECT * FROM tl_person WHERE pid = ? ORDER BY '.$this->checkSort($sort, Addressbook::$personFields, 'sorting'))
							  ->execute($group);
	}
	
	public function getPerson($id) {
		$this->import('Database');
		$objPerson = $this->Database->prepare('SELECT * FROM tl_person WHERE id = ?')
									 ->execute($id);
		if ($objPerson->next())
			return $objPerson;
		return false;
	}
	
}
?>