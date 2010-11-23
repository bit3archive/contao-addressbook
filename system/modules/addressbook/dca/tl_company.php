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
 * Table tl_company 
 */
$GLOBALS['TL_DCA']['tl_company'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'flag'                    => 1,
			'fields'                  => array('name')
		),
		'label' => array
		(
			'fields'                  => array('name'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
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
				'label'               => &$GLOBALS['TL_LANG']['tl_company']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_company']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_company']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_company']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{company_legend},name,description,photo,logo;{contact_legend:hide},email,fon,fax,homepage;{location_legend:hide},address,city,country'
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE')
		),
		'photo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['photo'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true)
		),
		'logo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['logo'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true)
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['email'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'email', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'fon' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['fon'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'mobile' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['mobile'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'fax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['fax'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'homepage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['homepage'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'url', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'address' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['address'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'city' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['city'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_company']['country'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		)
	)
);

?>