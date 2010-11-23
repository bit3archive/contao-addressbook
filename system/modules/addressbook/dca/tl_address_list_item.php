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
 * Table tl_address_list_item 
 */
$GLOBALS['TL_DCA']['tl_address_list_item'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_address_list',
		'enableVersioning'            => true,
		'onsubmit_callback'           => array(array('tl_address_list_item', 'updateFlatList'))
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 6,
			'flag'                    => 11,
			'fields'                  => array('sorting')
		),
		'label' => array
		(
			'fields'                  => array('person'),
			'format'                  => '%s',
			'label_callback'          => array('tl_address_list_item', 'getLabel')
		),
		'global_operations' => array
		(
			'structure' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list_item']['structure'],
				'href'                => 'table=tl_address_list'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list_item']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list_item']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_person']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list_item']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list_item']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{list_item_legend},person'
	),

	// Fields
	'fields' => array
	(
		'person' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_address_list_item']['person'],
			'inputType'               => 'select',
			'options_callback'        => array('tl_address_list_item', 'listPersons'),
			'eval'                    => array('mandatory'=>true)
		),
	)
);

class tl_address_list_item extends Backend {
	
	public function updateFlatList(DataContainer $dc) {
		$this->import('Addressbook');
		$this->Addressbook->updateFlatList($dc->activeRecord->pid);
	}
	
	/*
	 * @param array
	 * @param string
	 * @return string
	 */
	public function getLabel($row, $label) {
		$s = '';
		$objPerson = $this->Database->prepare('SELECT sex,company,name,job,position FROM tl_person WHERE id=?')
									->execute($row['person']);
		
		if ($objPerson->next()) {
			if (strlen($objPerson->sex)) $s .= sprintf('<div style="padding: 1px 0 2px 20px; background: url(system/modules/addressbook/html/%1$s.png) no-repeat scroll left center;"> ', $objPerson->sex);
			$s .= $this->getCompanyName($objPerson->company);
			$s .= '<strong>' . $objPerson->name . '</strong>';
			if (strlen($objPerson->job)) $s .= ', ' . $objPerson->job;
			if (strlen($objPerson->position)) $s .= ', ' . $objPerson->position;
			if (strlen($objPerson->sex)) $s .= '</div>';
		} else {
			$s .= '- deleted -';
		}
		
		return $s;
	}
	
	public function listPersons() {
		$this->import('Addressbook');
		$options = array();
		$objAddressGroups = $this->Addressbook->getAddressGroups();
		while ($objAddressGroups->next()) {
			$options[$objAddressGroups->title] = array();
			$objPerson = $this->Addressbook->getPersonsByGroup($objAddressGroups->id);
			while ($objPerson->next()) {
				$s = '';
				if (strlen($objPerson->sex)) $s .= sprintf('<img src="system/modules/addressbook/html/%1$s.png" alt="" /> ', $objPerson->sex);
				$s .= $this->getCompanyName($objPerson->company);
				$s .= '<strong>' . $objPerson->name . '</strong>';
				if (strlen($objPerson->job)) $s .= ', ' . $objPerson->job;
				if (strlen($objPerson->position)) $s .= ', ' . $objPerson->position;
				$options[$objAddressGroups->title][$objPerson->id] = $s; 
			}
		}
		return $options;
	}
	
	public function getCompanyName($id) {
		$this->import('Addressbook');
		$name = $this->Addressbook->getCompanyName($id);
		if (strlen($name))
			return sprintf('(%s) ', $name);
		return '';
	}
	
}

?>