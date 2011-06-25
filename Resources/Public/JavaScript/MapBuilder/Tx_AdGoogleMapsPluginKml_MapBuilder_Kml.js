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
 * Extends the Google Maps API JavaScript class for the MapBuilder.
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
Tx_AdGoogleMaps_MapBuilder.prototype.drawKml = function(layerIndex){
	var _this = this;
	var layerOptions = this.getLayerOptions(layerIndex);
	var layerUid = layerOptions.uid;
	layerOptions.options.map = this.map;
	// Set layer object.
	var layer = new google.maps.KmlLayer(layerOptions.options.url, layerOptions.options);
	var layerObject = this.setLayer(layerUid, {
		options: layerOptions,
		layer: layer
	});
	// Set bounds after default viewport changed.
	google.maps.event.addListener(layer, 'defaultviewport_changed', function(event) {
		layerObject.setBounds(layer.getDefaultViewport());
	});
	// Must return the layerUid.
	return layerUid;
};