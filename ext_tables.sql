#
# Table structure for table 'tx_adgooglemaps_domain_model_layer'
#
CREATE TABLE tx_adgooglemaps_domain_model_layer (
	tx_adgooglemapspluginkml_file text,
	tx_adgooglemapspluginkml_url text,
	tx_adgooglemapspluginkml_suppress_info_windows tinyint(4) unsigned DEFAULT '0' NOT NULL,
);