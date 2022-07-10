<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Validation_Builder Class
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

defined( 'ABSPATH' ) || exit; // Exit if accessed directly
 
/**
 *
 * WC_Validation_Builder Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_Validation_Builder
{	

    /**
	 *
     * Check PHP version
     *
     * @access public
     * @return boolean
	 *
     */

	public static function is_valid_phpversion() {
        return phpversion() >= '5.6';
    }
	
    /**
	 *
     * Check if WooCommerce is activated
     *
     * @access public
     * @return boolean
	 *
     */
	 
	public static function is_woo_install() {
		return class_exists ( 'WC_Payment_Gateway' );
	}
	
    /**
	 *
     * Check woocommerce version
     *
     * @access public
     * @return boolean
	 *
     */

	public static function is_valid_wooversion() {
        return wc()->version >= '3.0.0';
    }

    /**
	 *
     * Check if ExtraCheckoutFieldsForBrazil is activated
     *
     * @access public
     * @return boolean
	 *
     */
	
	public static function is_ecffb_install() {
		return class_exists ( 'Extra_Checkout_Fields_For_Brazil' );
	}
	
    /**
	 *
     * Verify that the default currency of woocommerce matches the method parameter
     *
     * @access public
	 * @param  string Base currency code. Ex: BRL
     * @return boolean
	 *
     */

	public static function is_valid_currency( $currency ) {
		return get_woocommerce_currency() === $currency;
	}	

    /**
	 *
     * Verify If the user populates as access credentials
     *
     * @access public
     * @return boolean
	 *
     */

	public static function is_empty_credentials() {
		$sandbox_status = WC_Helper::plugin_settings( 'testmode' );
		if( $sandbox_status === 'no' ) {
			return WC_Helper::plugin_settings( 'merchant_id' ) == '' ||  WC_Helper::plugin_settings('merchant_key') == '';
		}		
		if( $sandbox_status === 'yes' ) {
			return WC_Helper::plugin_settings( 'sandbox_merchant_id' ) == '' ||  WC_Helper::plugin_settings('sandbox_merchant_key') == '';
		}
    } 

    /**
	 *
     * Check is active gateway
     *
     * @access public
     * @return boolean
	 *
     */

	public static function is_active_gateway() {
        return WC_Helper::plugin_settings( 'enabled') === 'yes';
    } 
	
    /**
	 *
     * Checks if an SSL certificate exists
     *
     * @access public
     * @return boolean
	 *
     */

	public static function is_ssl_exists() {	

        /**
         *
         * Ser message if SSL not is being used.
         *
         */ 

		return is_ssl();
    }
}
