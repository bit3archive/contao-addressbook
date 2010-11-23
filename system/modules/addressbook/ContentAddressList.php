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
 * Class ContentAddressList
 *
 * Addressbook listing content element.
 * @copyright  InfinityLabs - Olck & Lins GbR - 2009-2010
 * @author     Tristan Lins <tristan.lins@infinitylabs.de>
 * @package    Addressbook
 */
class ContentAddressList extends ContentElement {
	
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_addresslist';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ADDRESS LIST ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		$this->import('Addressbook');
		if ($objPerson = $this->Addressbook->getPersons($this->addressListSource, $this->addressListSort)) {
			$objTemplate = new FrontendTemplate($this->addressTemplate);
			
			$parsed = array();
			while ($objPerson->next()) {
				$objTemplate->setData($objPerson->row());
				$objTemplate->group = (object)$this->Addressbook->getAddressGroup($objTemplate->pid)->row();
				if ($objTemplate->company)
					$objTemplate->company = (object)$this->Addressbook->getCompany($objTemplate->company)->row();
				$parsed[] = $objTemplate->parse();
			}
			
			$this->Template->entries = $parsed;
		}
	}
	
}
?>