<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Environment Class
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
 * WC_Environment Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_Environment
{	

    /**
	 *
     * Registering dependencies
     * Performs initial settings and registers gateway
	 * 
     * @access protected
     * @return void
	 *
     */ 
	
    protected static function init_gateway_environment() {

        /**
         *
         * Insert Shortcut to Gateway Settings
         *
         */ 
        
        add_filter('plugin_action_links_' . plugin_basename( WOOCOMMERCE_CIELO_BOLETO_BASENAME ), array('\CieloBoleto_478R4FRF\WC_Helper', 'admin_plugin_links'));
		
        /**
         *
         * Set meta value in woocommerce filter
         *
         */ 
		 
		add_filter( 'woocommerce_order_data_store_cpt_get_orders_query', array('\CieloBoleto_478R4FRF\WC_Helper', 'handle_query_var'), 10, 2 );

        /**
         *
         * Registering gateway(s)
         *
         */ 

        add_filter( 'woocommerce_payment_gateways', array('\CieloBoleto_478R4FRF\WC_Gateway_Register', 'add_gateway') );

    }   
}

?>