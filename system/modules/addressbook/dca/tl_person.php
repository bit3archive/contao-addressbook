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
 * Table tl_person
 */
$GLOBALS['TL_DCA']['tl_person'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_address_group',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'panelLayout'             => 'filter;search,limit',
			'headerFields'            => array('title'),
			'child_record_callback'   => array('tl_person', 'addPerson')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_person']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_person']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_person']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_content']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_person', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_person']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{personal_legend},sex,name,title,position,job,company,photo,description;{contact_legend:hide},email,fon,mobile,fax,homepage;{location_legend:hide},address,city,country;{im_legend:hide},icq,google,aim,yahoo,skype,jabber;{social_legend:hide},xing,facebook,stayfriends,wkw;{publish_legend:hide},published,start,stop'
	),

	// Fields
	'fields' => array
	(
		'invisible' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['invisible']
		),
		'sex' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['sex'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('', 'male', 'female'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_person'],
			'eval'                    => array('tl_class'=>'w50')
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'position' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['position'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'job' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['job'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'company' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['company'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_person', 'getCompanies'),
			'eval'                    => array('tl_class'=>'w50')
		),
		'photo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['photo'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true)
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE')
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['email'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'email', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'fon' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['fon'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'mobile' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['mobile'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'fax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['fax'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'phone', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'homepage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['homepage'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'url', 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'address' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['address'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'city' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['city'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['country'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'icq' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['icq'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'google' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['google'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'aim' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['aim'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'yahoo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['yahoo'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'skype' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['skype'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'jabber' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['jabber'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'xing' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['xing'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'facebook' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['facebook'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'stayfriends' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['stayfriends'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'wkw' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['wkw'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'twitter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['twitter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>10, 'rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50')
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_person']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>10, 'rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50')
		)
	)
);

/**
 * Class tl_person
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  InfinitySoft 2010
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Addressbook
 */
class tl_person extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function addPerson($arrRow)
	{
		$key = $arrRow['published'] ? 'published' : 'unpublished';

		$s .= '<div class="cte_type ' . $key . '">';
		if (strlen($arrRow['sex'])) $s .= sprintf('<div style="padding: 1px 0 2px 20px; background: url(system/modules/addressbook/html/%1$s.png) no-repeat scroll left center;"> ', $arrRow['sex']);
		$s .= $this->getCompanyName($arrRow['company']);
		$s .= '<strong>' . $arrRow['name'] . '</strong>';
		if (strlen($arrRow['job'])) $s .= ', ' . $arrRow['job'];
		if (strlen($arrRow['position'])) $s .= ', ' . $arrRow['position'];
		if (strlen($arrRow['photo'])) $s .= sprintf('<img src="%s" alt="" style="float: right; margin-left: 10px; box-shadow: 0 0 3px rgba(0,0,0,.5); -o-box-shadow: 0 0 3px rgba(0,0,0,.5); -moz-box-shadow: 0 0 3px rgba(0,0,0,.5); -webkit-box-shadow: 0 0 3px rgba(0,0,0,.5);" />', specialchars($this->getImage($arrRow['photo'], 80, 80, 'box')));
		if (strlen($arrRow['sex'])) $s .= '</div>';
		$s .= '</div>' . "\n";
		return $s;
	}
	
	public function getCompanyName($id) {
		$this->import('Addressbook');
		$name = $this->Addressbook->getCompanyName($id);
		if (strlen($name))
			return sprintf('(%s) ', $name);
		return '';
	}
	
	public function getCompanies() {
		if (!$this->User->isAdmin && !is_array($this->User->addressbooks))
		{
			return array();
		}
		$this->import('Addressbook');

		$arrForms = array();
		$arrForms['-'] = '-';
		
		$objForms = $this->Addressbook->getCompanies();

		while ($objForms->next())
		{
			$arrForms[$objForms->id] = $objForms->name;
		}

		return $arrForms;
	}

	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_article::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
								  ->limit(1)
								  ->execute($row['pid']);

		if (!$this->User->isAdmin && !$this->User->isAllowed(4, $objPage->row()))
		{
			return $this->generateImage($icon) . ' ';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'toggle');
		#$this->checkPermission();

		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_person::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish article ID "'.$intId.'"', 'tl_person toggleVisibility', TL_ERROR);
			$this->redirect('typolight/main.php?act=error');
		}

		$this->createInitialVersion('tl_person', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_person']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_person']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_person SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_person', $intId);
	}
}

?>