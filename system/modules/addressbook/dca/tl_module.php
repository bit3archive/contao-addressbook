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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['addressList']    = '{title_legend},name,headline,type;{config_legend},addressListSource,addressListSort;{template_legend:hide},addressTemplate,personTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['addressSingle']  = '{title_legend},name,headline,type;{config_legend},addressEntry;{template_legend:hide},addressTemplate,personTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['addressListSource'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['addressListSource'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_addressbook', 'getListSources'),
	'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['addressSource'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['addressSource'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'              => 'tl_person.name',
	'eval'                    => array('multiple'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['addressTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['addressTemplate'],
	'default'                 => 'address_list',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getTemplateGroup('address_'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['personTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['personTemplate'],
	'default'                 => 'person_full',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getTemplateGroup('person_'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['addressListSort'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['addressListSort'],
	'default'                 => 'sorting',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array(
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
	),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['addressSortField'],
	'eval'                    => array('tl_class'=>'w50')
);

class tl_module_addressbook extends Backend {
	function getListSources() {
		$this->import('Addressbook');
		
		$groups = array();
		$companies = array();
		
		$objGroup = $this->Addressbook->getAddressGroups();
		while ($objGroup->next())
			$groups['group:'.$objGroup->id] = $objGroup->title;
		
		$objCompany = $this->Addressbook->getCompanies();
		while ($objCompany->next())
			$companies['company:'.$objCompany->id] = $objCompany->name;
		
		return array(
			$GLOBALS['TL_LANG']['tl_module']['group'] => $groups,
			$GLOBALS['TL_LANG']['tl_module']['company'] => $companies
		);
	}
}
?>