<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011-2012 Ingo Renner <ingo@typo3.org>
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
 * Errors command class to render error messages for errors that may have
 * occurred during searching.
 *
 * @author	Ingo Renner <ingo@typo3.org>
 * @package	TYPO3
 * @subpackage	solr
 */
class tx_solr_pi_results_ErrorsCommand implements tx_solr_PluginCommand {

	/**
	 * Parent plugin
	 *
	 * @var	tx_solr_pi_results
	 */
	protected $parentPlugin;

	/**
	 * Configuration
	 *
	 * @var	array
	 */
	protected $configuration;

	/**
	 * Constructor.
	 *
	 * @param tx_solr_pluginbase_CommandPluginBase Parent plugin object.
	 */
	public function __construct(tx_solr_pluginbase_CommandPluginBase $parentPlugin) {
		$this->parentPlugin  = $parentPlugin;
		$this->configuration = $parentPlugin->conf;
	}

	/**
	 * Provides the values for the markers in the errors template subpart.
	 *
	 * @return	array	Array of markers in the errors template subpart
	 */
	public function execute() {
		$marker = array();

		$errors = $this->getErrors();
		if (!empty($errors)) {
			$marker['loop_errors|error'] = $errors;
		} else {
			$marker = NULL;
		}

		return $marker;
	}

	/**
	 * Gets errors that may have been found with the user's query.
	 *
	 * @return	array	An array of errors, each error is an array itself and has a message and a code key.
	 */
	protected function getErrors() {
		$errors = array();

			// detect empty user queries
		$userQuery = $this->parentPlugin->getRawUserQuery();

		if (!is_null($userQuery)
			&& !$this->configuration['search.']['query.']['allowEmptyQuery']
			&& empty($userQuery)
		) {
			$errors[] = array(
				'message' => '###LLL:error_emptyQuery###',
				'code'    => 1300893669
			);
		}

			// TODO add a way to let other components provide errors, too

		return $errors;
	}
}


if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/solr/pi_results/class.tx_solr_pi_results_errorscommand.php'])	{
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/solr/pi_results/class.tx_solr_pi_results_errorscommand.php']);
}

?>