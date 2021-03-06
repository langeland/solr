<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Ingo Renner <ingo@typo3.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Remote API related methods
 *
 * @author Ingo Renner <ingo@typo3.org>
 * @package TYPO3
 * @subpackage solr
 */
class tx_solr_Api {

	/**
	 * Generates the API key for the REST API
	 *
	 * @return string API key for this installation
	 */
	public static function getApiKey() {
		return sha1(
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] .
			'tx_solr_api'
		);
	}

	/**
	 * Checks whether a string is a valid API key.
	 *
	 * @param string $apiKey API key to check for validity
	 * @return boolean TRUE if the API key is valid, FALSE otherwise
	 */
	public static function isValidApiKey($apiKey) {
		return ($apiKey === self::getApiKey());
	}

}

if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/solr/classes/class.tx_solr_api.php'])	{
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/solr/classes/class.tx_solr_api.php']);
}

?>