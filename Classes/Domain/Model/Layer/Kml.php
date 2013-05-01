<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Arno Dudek <webmaster@adgrafik.at>
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
 * Model: Layer.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsPluginKml_Domain_Model_Layer_Kml extends Tx_AdGoogleMaps_Domain_Model_Layer {

	/**
	 * @var string
	 */
	protected $pluginKmlFile;

	/**
	 * @var string
	 */
	protected $pluginKmlUrl;

	/**
	 * @var boolean
	 */
	protected $pluginKmlSuppressInfoWindows;

	/**
	 * Sets this pluginKmlFile
	 *
	 * @param string $pluginKmlFile
	 * @return void
	 */
	public function setPluginKmlFile($pluginKmlFile) {
		$this->pluginKmlFile = $pluginKmlFile;
	}

	/**
	 * Returns this pluginKmlFile
	 *
	 * @return string
	 */
	public function getPluginKmlFile() {
		return t3lib_div::getIndpEnv('TYPO3_SITE_URL') . Tx_AdGoogleMaps_Utility_BackEnd::getRelativeUploadPathAndFileName('ad_google_maps_plugin_kml', 'kmlFiles', $this->getPropertyValue('pluginKmlFile', 'layer'));
	}

	/**
	 * Sets this pluginKmlUrl
	 *
	 * @param string $pluginKmlUrl
	 * @return void
	 */
	public function setPluginKmlUrl($pluginKmlUrl) {
		$this->pluginKmlUrl = $pluginKmlUrl;
	}

	/**
	 * Returns this pluginKmlUrl
	 *
	 * @return string
	 */
	public function getPluginKmlUrl() {
		return $this->getPropertyValue('pluginKmlUrl', 'layer');
	}

	/**
	 * Sets this pluginKmlSuppressInfoWindows.
	 *
	 * @param boolean $pluginKmlSuppressInfoWindows
	 * @return void
	 */
	public function setPluginKmlSuppressInfoWindows($pluginKmlSuppressInfoWindows) {
		$this->pluginKmlSuppressInfoWindows = (boolean) $pluginKmlSuppressInfoWindows;
	}

	/**
	 * Returns this pluginKmlSuppressInfoWindows.
	 *
	 * @return boolean
	 */
	public function isPluginKmlSuppressInfoWindows() {
		return (boolean) $this->getPropertyValue('pluginKmlSuppressInfoWindows', 'layer');
	}

}

?>