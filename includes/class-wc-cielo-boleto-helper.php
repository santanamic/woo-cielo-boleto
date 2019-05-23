<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Helper Class
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
 * WC_Helper Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_Helper 
{	
	
    /**
     *
     * Alert admin message. The plugin can not function
     * 
     * @access public
     * @param  array WP default plugin links
     * @return array WP updated plugin links
     *
     */ 
	
    public static function admin_plugin_links( $links ) {

        /**
         *
         * Add link shortcut config to page plugins
         *
         */ 
        
        $links[] = '<a href="' . esc_url(admin_url('admin.php?page=wc-settings&tab=checkout&section=woo-cielo-boleto')) . '">' . __('Configurações', 'woo-cielo-boleto') . '</a>';
        
        /**
         *
         * Add link shortcut support to page plugins
         *
         */ 
        
        $links[] = '<a href="http://bit.ly/cielo-boleto-support">' . __('Suporte', 'woo-cielo-boleto') . '</a>';

        /**
         *
         * Add link shortcut docs to page plugins
         *
         */ 
        
        $links[] = '<a href="http://bit.ly/cielo-boleto-docs">' . __('Documentação', 'woo-cielo-boleto') . '</a>';
        
        /**
         *
         * WordPress links array updated.
         *
         */ 
		
        return $links;
    }

    /**
     *
     * Set admin scripts
     * 
     * @access public
     * @return void
     *
     */ 
	
    public static function admin_plugin_scripts() {

        /**
         *
         * Set CSS core
         *
         */ 
        
        wp_enqueue_style('woo-cielo-boleto-admin-style', WOOCOMMERCE_CIELO_BOLETO_DIR_URL . 'admin/assets/css/style.css');
        
        /**
         *
         * Set CSS fancybox
         *
         */ 
        
        wp_enqueue_style('woo-cielo-boleto-admin-style-fancybox',  WOOCOMMERCE_CIELO_BOLETO_DIR_URL . 'admin/assets/css/jquery.fancybox.min.css');
        
        /**
         *
         * Set javascript fancybox
         *
         */ 
        
        wp_enqueue_script('woo-cielo-boleto-admin-script-fancybox', WOOCOMMERCE_CIELO_BOLETO_DIR_URL . 'admin/assets/js/jquery.fancybox.min.js');
        

        /**
         *
         * Set javascript core
         *
         */ 
        
        wp_enqueue_script('woo-cielo-boleto-admin-script', WOOCOMMERCE_CIELO_BOLETO_DIR_URL . 'admin/assets/js/script.js');
    }

    /**
     *
     * Get plugin options
     * 
     * @access public
     * @param  string An option of the plugin configuration form
     * @return mixed
     *
     */ 
	
    public static function plugin_settings( $option ) {

        /**
         *
         * Get WordPress array data
         *
         */ 
        
        $data = get_option('woocommerce_woo-cielo-boleto_settings');
        
        /**
         *
         * Valid array data
         *
         */ 
		 
		if( is_array( $data ) && $data != null ) {
			
			/**
			 *
			 * Check if option exist in data
			 *
			 */ 
			
			if( array_key_exists( $option, $data ) ) {

				/**
				 *
				 * Return value option
				 *
				 */ 

				return $data[$option];
			}
			else {

				/**
				 *
				 * Here it is important that the return is false
				 *
				 */ 

				return false;
			}
		}
		
		else {
			
			/**
			 *
			 * Return false for invalid data
			 *
			 */ 
			
			return false;
		}
    }
	
	/**
	 *
	 * Handle a custom 'CieloBoleto_PaymentId' query var to get orders with the 'CieloBoleto_PaymentId' meta.
	 *
     * @access public
	 * @param array $query - Args for WP_Query.
	 * @param array $query_vars - Query vars from WC_Order_Query.
	 * @return array modified $query
	 */
	
	public static function handle_query_var( $query, $query_vars ) {
        
		/**
         *
         * Check if set value
         *
         */ 
		 
		if ( ! empty( $query_vars['CieloBoleto_PaymentId'] ) ) {

		/**
         *
         * Declare custom value param in array
         *
         */
		 
			$query['meta_query'][] = array(
				'key' => 'CieloBoleto_PaymentId',
				'value' => esc_attr( $query_vars['CieloBoleto_PaymentId'] ),
			);
		}

		/**
         *
         * Return of the complete object
         *
         */
		 
		return $query;
	}
	
	/**
	 *
	 * Load the plugin text domain for translation.
	 *
     * @access public
	 * @return void
	 *
	 */
	 
	public static function load_plugin_textdomain() {
		
		/**
         *
         * Set domain path
         *
         */
		 
		load_plugin_textdomain( 'woo-cielo-boleto', false,  dirname ( WOOCOMMERCE_CIELO_BOLETO_BASENAME ) . '/languages' );
	}
	
	/**
	 *
	 * Send email notification.
	 *
	 * @param string $address Email address.
	 * @param string $subject Email subject.
	 * @param string $title   Email title.
	 * @param string $message Email message.
	 *
	 */
	 
	protected function send_email($address, $subject, $title, $message) {
		$mailer = WC()->mailer();
		$mailer->send($address, $subject, $mailer->wrap_message($title, $message));
	}
}

?>