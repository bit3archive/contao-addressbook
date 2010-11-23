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
 * Back end modules
 */
$GLOBALS['BE_MOD'] = array_merge(
	array_slice($GLOBALS['BE_MOD'], 0, 1),
	array(
		'address' => array(
			'address_group' => array(
				'tables' => array('tl_address_group', 'tl_person'),
				'icon'   => 'system/modules/addressbook/html/group.png'
			),
			'company' => array(
				'tables' => array('tl_company'),
				'icon'   => 'system/modules/addressbook/html/company.png'
			)
		)
	),
	array_slice($GLOBALS['BE_MOD'], 1)
);

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['address'] = array(
#	'addressSingle' => 'ContentAddress',
	'addressList'   => 'ContentAddressList'
);

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['address'] = array(
#	'addressSingle' => 'ModuleAddress',
	'addressList'   => 'ModuleAddressList'
);
 
?>