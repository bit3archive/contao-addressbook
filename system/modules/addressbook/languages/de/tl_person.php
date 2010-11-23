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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_person']['sex'] = array('Geschlecht', 'Hier können Sie das Geschlecht der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['name'] = array('Name', 'Bitte geben Sie hier den vollen Namen der Person an.');
$GLOBALS['TL_LANG']['tl_person']['title'] = array('Titel', 'Hier können Sie den Titel der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['position'] = array('Position', 'Hier können Sie die Position der Person im Unternehmen angeben.');
$GLOBALS['TL_LANG']['tl_person']['job'] = array('Beruf', 'Hier können Sie den Beruf der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['company'] = array('Unternehmen', 'Hier können Sie das Unternehmen in dem die Person arbeitet auswählen.');
$GLOBALS['TL_LANG']['tl_person']['photo'] = array('Foto', 'Hier können Sie ein Foto der Person auswählen.');
$GLOBALS['TL_LANG']['tl_person']['description'] = array('Beschreibung', 'Hier können Sie einen beschreibenden Text zu der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['email'] = array('E-Mail', 'Hier können Sie die E-Mail Adresse der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['fon'] = array('Telefon', 'Hier können Sie die Telefonnummer der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['mobile'] = array('Handy', 'Hier können Sie die Handynummer der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['fax'] = array('Fax', 'Hier können Sie die Faxnummer der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['homepage'] = array('Homepage', 'Hier können Sie die Homepage der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['address'] = array('Adresse', 'Hier können Sie die Adresse der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['city'] = array('PLZ, Ort', 'Hier können Sie den Wohnort der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['country'] = array('Land', 'Hier können Sie das Land, in dem die Person lebt angeben.');
$GLOBALS['TL_LANG']['tl_person']['icq'] = array('ICQ', 'Hier können Sie die ICQ UIN der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['google'] = array('Google Talk', 'Hier können Sie den Google Talk Namen der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['aim'] = array('AIM', 'Hier können Sie den AIM Nick der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['yahoo'] = array('Yahoo', 'Hier können Sie den Yahoo Namen der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['skype'] = array('Skype', 'Hier können Sie den Skype Namen der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['jabber'] = array('Jabber', 'Hier können Sie die Jabber ID der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['xing'] = array('XING', 'Hier können Sie den XING Kontakt der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['facebook'] = array('Facebook', 'Hier können Sie den Facebook Kontakt der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['stayfriends'] = array('StayFriends', 'Hier können Sie den StayFriends Kontakt der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['wkw'] = array('Wer kennt Wen?', 'Hier können Sie den <em>Wer kennt Wen?</em> Kontakt der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['twitter'] = array('Twitter', 'Hier können Sie den Twitter Kontakt der Person angeben.');
$GLOBALS['TL_LANG']['tl_person']['published'] = array('Eintrag veröffentlichen', 'Den Eintrag auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_person']['start'] = array('Anzeigen ab', 'Den Eintrag erst ab diesem Tag auf der Webseite anzeigen.');
$GLOBALS['TL_LANG']['tl_person']['stop'] = array('Anzeigen bis', 'Den Eintrag nur bis zu diesem Tag auf der Webseite anzeigen.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_person']['personal_legend'] = 'Persönliche Informationen';
$GLOBALS['TL_LANG']['tl_person']['contact_legend'] = 'Kontaktdaten';
$GLOBALS['TL_LANG']['tl_person']['location_legend'] = 'Adresse';
$GLOBALS['TL_LANG']['tl_person']['im_legend'] = 'Instant Messaging';
$GLOBALS['TL_LANG']['tl_person']['social_legend'] = 'Soziale Netzwerke';
$GLOBALS['TL_LANG']['tl_person']['publish_legend'] = 'Veröffentlichung';

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_person']['male'] = 'Männlich';
$GLOBALS['TL_LANG']['tl_person']['female'] = 'Weiblich';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_person']['new']        = array('Neuen Personeneintrag', 'Einen neuen Personeneintrag anlegen');
$GLOBALS['TL_LANG']['tl_person']['show']       = array('Eintragdetails', 'Details des Eintrages ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_person']['edit']       = array('Eintrag bearbeiten', 'Eintrag ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_person']['cut']        = array('Eintrag ausschneiden', 'Eintrag ID %s ausschneiden');
$GLOBALS['TL_LANG']['tl_person']['copy']       = array('Eintrag duplizieren', 'Eintrag ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_person']['delete']     = array('Eintrag löschen', 'Eintrag ID %s löschen');
$GLOBALS['TL_LANG']['tl_person']['pasteafter'] = array('Einfügen nach', 'Nach Eintrag ID %s einfügen');
$GLOBALS['TL_LANG']['tl_person']['pasteinto']  = array('Einfügen in', 'In Eintrag ID %s einfügen');

?>