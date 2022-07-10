<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Validation Class
 *
 * This file is part of <santanamic/woo-cielo-boleto>
 * Created by WILLIAN SANTANA <https://github.com/santanamic>
 *
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 *
 * Para a informaçao dos direitos autorais e de licença voce deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 *
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 *
 * @package woo-cielo-boleto
 * @author @santanamic
 *
 */

defined('ABSPATH') || exit; // Exit if accessed directly

/**
 *
 * WC_Validation Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
 */

class WC_Validation extends WC_Validation_Builder
{

	/**
	 *
	 * Check is valid environment
	 *
	 * @access public
	 * @return boolean
	 *
	 */

	public static function is_valid_environment()
	{

		/**
		 *
		 * Closes if the PHP version is not compatible
		 *
		 */

		if (!WC_Validation::is_valid_phpversion())
			return WC_Notices::php_version();

		/**
		 *
		 * Closes if Woocommerce is not enabled
		 *
		 */

		if (!WC_Validation::is_woo_install())
			return WC_Notices::plugins_missing();

		/**
		 *
		 * Closes if the Woocommerce version is not compatible
		 *
		 */

		if (!WC_Validation::is_valid_wooversion())
			return WC_Notices::plugins_version();

		/**
		 *
		 * Closes if ExtraCheckoutFieldsBrazil is not enabled
		 * 			 *
		 */

		if (!WC_Validation::is_ecffb_install())
			return WC_Notices::plugins_missing();

		/**
		 *
		 * Closes if Woocommerce currency is not supported
		 *
		 */

		if (!WC_Validation::is_valid_currency('BRL'))
			return WC_Notices::currency_error();

		/**
		 *
		 * Detect SSL
		 *
		 */

		if (!WC_Validation::is_ssl_exists())
			WC_Notices::ssl_require();

		/**
		 *
		 * Return if pass validation
		 *
		 */

		return true;
	}

	/**
	 *
	 * Verify that the gateway configuration is valid
	 *
	 * @access public
	 * @return boolean
	 *
	 */

	public static function is_valid_gateway()
	{

		/**
		 *
		 * Check enabled gateway
		 *
		 */

		if (!WC_Validation::is_active_gateway())
			return WC_Notices::welcome_to_plugin();

		/**
		 *
		 * Only show a message if credentials do not seem to
		 *
		 */

		if (WC_Validation::is_empty_credentials())
			return WC_Notices::credentials_missing();

		/**
		 *
		 * Return if pass validation
		 *
		 */

		return true;
	}
}
