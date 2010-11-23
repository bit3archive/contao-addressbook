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
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['addressList']    = '{type_legend},type,headline;{config_legend},addressListSource,addressListSort;{template_legend:hide},addressTemplate,personTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['addressDetails']  = '{type_legend},type,headline;{config_legend},addressSource;{template_legend:hide},personTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['addressListSource'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addressListSource'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_addressbook', 'getListSources'),
	'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['addressSource'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addressSource'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_addressbook', 'getSources'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['addressTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addressTemplate'],
	'default'                 => 'address_list',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getTemplateGroup('address_'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['personTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['personTemplate'],
	'default'                 => 'person_full',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getTemplateGroup('person_'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['addressListSort'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['addressListSort'],
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
	'reference'               => &$GLOBALS['TL_LANG']['tl_content']['addressSortField'],
	'eval'                    => array('tl_class'=>'w50')
);

class tl_content_addressbook extends Backend {
	private function addListItems(&$array, $list, $indent = 0) {
		$strIndent = '';
		for ($i=0; $i<$indent; $i++) $strIndent .= '&nbsp;&nbsp;&nbsp;&nbsp;';
		$array['list:'.$list->id] = $strIndent . $list->title;
		if ($list->children) {
			foreach ($list->children as $children) {
				$this->addListItems($array, $children, $indent+1);
			}
		}	
	}
	
	public function getListSources() {
		$this->import('Addressbook');
		
		$lists = array();
		$groups = array();
		$companies = array();
		
		$list = $this->Addressbook->getListStructure();
		$this->addListItems($lists, $list);
		
		$objGroup = $this->Addressbook->getAddressGroups();
		while ($objGroup->next())
			$groups['group:'.$objGroup->id] = $objGroup->title;
		
		$objCompany = $this->Addressbook->getCompanies();
		while ($objCompany->next())
			$companies['company:'.$objCompany->id] = $objCompany->name;
		
		return array(
			$GLOBALS['TL_LANG']['tl_content']['list'] => $lists,
			$GLOBALS['TL_LANG']['tl_content']['group'] => $groups,
			$GLOBALS['TL_LANG']['tl_content']['company'] => $companies
		);
	}
	
	public function getSources() {
		$this->import('Addressbook');
		
		$groups = array('0' => '-');
		
		$objGroup = $this->Addressbook->getAddressGroups();
		while ($objGroup->next()) {
			$children = array();
			$objPerson = $this->Addressbook->getPersonsByGroup($objGroup->id);
			while ($objPerson->next()) {
				$children[$objPerson->id] = (strlen($objPerson->title) ? sprintf('<strong>%s</strong> ', $objPerson->title) : '') . $objPerson->name;
			}
			$groups[$objGroup->title] = $children;
		}
		
		return $groups;
	}
}
?>