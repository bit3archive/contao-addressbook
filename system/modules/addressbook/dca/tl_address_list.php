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
 * Table tl_address_list 
 */
$GLOBALS['TL_DCA']['tl_address_list'] = array
(

	// Config
	'config' => array
	(
		'label'                       => &$GLOBALS['TL_LANG']['tl_address_list']['label'],
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_address_list_item'),
		'enableVersioning'            => true,
		'onsubmit_callback'           => array(array('tl_address_list', 'updateFlatList'))
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 5,
			'icon'                    => '/system/modules/addressbook/html/list.png'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
			'label_callback'          => array('tl_address_list', 'addIcon')
		),
		'global_operations' => array
		(
			'items' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list']['items'],
				'href'                => 'table=tl_address_list_item'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list']['copy'],
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
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_address_list']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{list_legend},title,description'
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_address_list']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_address_list']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE')
		)
	)
);

class tl_address_list extends Backend {
	
	public function updateFlatList(DataContainer $dc) {
		$this->import('Addressbook');
		$this->Addressbook->updateFlatList($dc->id);
	}
	
	/**
	 * Add an image to each item in the tree
	 * @param array
	 * @param string
	 * @param object
	 * @param string
	 * @param boolean
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
	{
		$image = '/system/modules/addressbook/html/list.png';
		
		if ($blnReturnImage) {
			return $this->generateImage($image, '', $imageAttribute);
		}
		
		// Return image
		return '<a href="'.$this->generateFrontendUrl($row).'" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['view']).'"' . (($dc->table != 'tl_page') ? ' class="tl_gray"' : '') . LINK_NEW_WINDOW . '>'.$this->generateImage($image, '', $imageAttribute).'</a> '.$label;
	}
	
}
?>