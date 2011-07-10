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
 * Layer builder class.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_AdGoogleMapsPluginKml_MapBuilder_Layer_Kml extends Tx_AdGoogleMaps_MapBuilder_Layer_AbstractLayer {

	/**
	 * Initialize this objectManager.
	 *
	 * @return void
	 */
	public function initializeObject() {
		parent::initializeObject();
		Tx_AdGoogleMaps_Utility_FrontEnd::includeFrontEndResources('Tx_AdGoogleMapsPluginKml_MapBuilder_Layer_Kml');
	}

	/**
	 * Builds the layer items.
	 *
	 * @param mixed $value
	 * @param integer $index
	 * @return Tx_AdGoogleMaps_Plugin_Options_Layer_LayerInterface
	 */
	public function buildItem($index, $value) {
		// Get list titles.
		$listTitle = $this->layer->getListTitle();

		// Get list icons.
		$listIconOptions = array(
			'url' => $this->layer->getListIcon(),
			'width' => $this->layer->getListIconWidth(),
			'height' => $this->layer->getListIconHeight(),
		);

		$layerUid = sprintf('Kml_%d_%d', $this->layer->getUid(), $index);
		$kmlFile = $this->layer->getPluginKmlFile();
		$kmlUrl = $this->layer->getPluginKmlUrl();
		$layerOptions = array(
			'key' => $layerUid,
			'url' => ($kmlUrl ? $kmlUrl : $kmlFile),
			'preserveViewport' => TRUE,
			'suppressInfoWindows' => $this->layer->isPluginKmlSuppressInfoWindows(),
		);

		// Create layer.
		$layer = $this->objectManager->create('Tx_AdGoogleMapsPluginKml_Api_Layer_Kml', $layerOptions);

		// Create option object.
		$layerOptionsObject = $this->objectManager->create('Tx_AdGoogleMapsPluginKml_Plugin_Options_Layer_Kml');
		$layerOptionsObject->setUid($layerUid);
		$layerOptionsObject->setDrawFunctionName('drawKml');
		$layerOptionsObject->setOptions($layer);

		// Add layer options object to layer options.
		$pluginOptions = $this->googleMapsPlugin->getPluginOptions();
		$pluginOptions->addLayerOptions($layerOptionsObject);

		//	Create layer item.
		$pluginMapObjectIdentifier = $this->googleMapsPlugin->getPluginMapObjectIdentifier();
		$item = $this->objectManager->create('Tx_AdGoogleMaps_Domain_Model_Item');
		$item->setTitle($listTitle);
		$item->setIcon($listIconOptions['url']);
		$item->setIconWidth($listIconOptions['width']);
		$item->setIconHeight($listIconOptions['height']);
		$item->setMapControlFunctions($this->getItemMapControlFunctions($layerUid, FALSE));
		$item->setLayerOptions($layerOptionsObject);
		$this->layer->addItem($item);

		$this->categoryItemKeys[] = $layerUid;

		return $layer;
	}

}

?>