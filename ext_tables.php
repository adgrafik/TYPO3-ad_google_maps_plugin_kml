<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$extensionConfiguration = Tx_AdGoogleMaps_Utility_BackEnd::getExtensionConfiguration('ad_google_maps');
// l10n_mode for the image or file field.
$excludeFileTranslation = Tx_AdGoogleMaps_Utility_BackEnd::getExtensionConfigurationValue('excludeFileTranslation');

// TCA configuration for tx_adgooglemaps_domain_model_layer
t3lib_div::loadTCA('tx_adgooglemaps_domain_model_layer');

$tempColumns = array(
	'tx_adgooglemapspluginkml_file' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_kml/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.file',
		'exclude' => true,
		'l10n_mode' => $excludeFileTranslation,
		'config' => array(
			'type'          => 'group',
			'internal_type' => 'file',
			'allowed'       => 'kml,kmz',
			'max_size'      => 3000,
			'uploadfolder'  => Tx_AdGoogleMaps_Utility_BackEnd::getAbsoluteUploadPath('ad_google_maps_plugin_kml', 'kmlFiles'),
			'show_thumbs'   => 1,
			'size'          => 1,
			'minitems'      => 0,
			'maxitems'      => 1,
		),
	),
	'tx_adgooglemapspluginkml_url' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_kml/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.url',
		'exclude' => true,
		'l10n_mode' => $excludeFileTranslation,
		'config' => array(
			'type' => 'input',
			'default' => '0',
			'checkbox' => '0',
			'size' => 24,
			'eval' => 'trim',
		),
	),
	'tx_adgooglemapspluginkml_suppress_info_windows' => array(
		'label' => 'LLL:EXT:ad_google_maps_plugin_kml/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.suppressInfoWindows',
		'exclude' => true,
		'l10n_mode' => $excludeFileTranslation,
		'config' => array(
			'type' => 'check'
		),
	),
);

t3lib_extMgm::addTCAcolumns('tx_adgooglemaps_domain_model_layer', $tempColumns, 1);
t3lib_extMgm::addLLrefForTCAdescr('tx_adgooglemaps_domain_model_layer', 'EXT:ad_google_maps_plugin_kml/Resources/Private/Language/locallang_tca_csh_layer.xml');
// Add layer type icon.
$TCA['tx_adgooglemaps_domain_model_layer']['ctrl']['typeicons']['Tx_AdGoogleMapsPluginKml_PluginAdapter_LayerBuilder_Kml'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/TCA/IconKml.gif';
$TCA['tx_adgooglemaps_domain_model_layer']['columns']['type']['config']['items'][] = array('LLL:EXT:ad_google_maps_plugin_kml/Resources/Private/Language/locallang_tca.xml:tx_adgooglemaps_domain_model_layer.type.kml', 'Tx_AdGoogleMapsPluginKml_PluginAdapter_LayerBuilder_Kml', 'EXT:ad_google_maps_plugin_kml/Resources/Public/Icons/TCA/IconKml.gif');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_kml_a'] = array('showitem' => 'tx_adgooglemapspluginkml_url');
$TCA['tx_adgooglemaps_domain_model_layer']['palettes']['layer_kml_b'] = array('showitem' => 'tx_adgooglemapspluginkml_suppress_info_windows');
$TCA['tx_adgooglemaps_domain_model_layer']['types']['Tx_AdGoogleMapsPluginKml_PluginAdapter_LayerBuilder_Kml']['showitem'] = '
	type;;1;;1-1-1, title, tx_adgooglemapspluginkml_file;;layer_kml_a, --palette--;;layer_kml_b, categories;;;;1-1-1,
	--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, 
	starttime, endtime, fe_group';

// Add static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'ad: Google Maps Plugin KML-Layer');

?>