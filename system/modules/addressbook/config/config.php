<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
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
 * @copyright  InfinitySoft 2010
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Addressbook
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Back end modules
 */
$offset = array_search('content', array_keys($GLOBALS['BE_MOD'])) + 1;
$GLOBALS['BE_MOD'] = array_merge(
	array_slice($GLOBALS['BE_MOD'], 0, $offset),
	array(
		'address' => array(
			'address_group' => array(
				'tables' => array('tl_address_group', 'tl_person'),
				'icon'   => 'system/modules/addressbook/html/group.png'
			),
			'address_list' => array(
				'tables' => array('tl_address_list_item', 'tl_address_list'),
				'icon'   => 'system/modules/addressbook/html/list.png'
			),
			'company' => array(
				'tables' => array('tl_company'),
				'icon'   => 'system/modules/addressbook/html/company.png'
			)
		)
	),
	array_slice($GLOBALS['BE_MOD'], $offset)
);

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['address'] = array(
	'addressDetails' => 'ContentAddressDetails',
	'addressList'    => 'ContentAddressList'
);

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['address'] = array(
	'addressDetails' => 'ModuleAddressDetails',
	'addressList'    => 'ModuleAddressList'
);
 
?>