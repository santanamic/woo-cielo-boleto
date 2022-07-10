<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Notices_Builder Class
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
 * WC_Notices_Builder Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_Notices_Builder
{ 

    /**
	 *
     * Format output for HTML
     *
     * @access private
     * @param  string  $text  Notice text
     * @param  string  $type  error || info || sucess
     * @return void
	*
     */
	 
	private static function notice_format( $text, $type ) {

	     /**
		 *
		 * Simple HTML content for admin notice
		 *
		 */ 

		printf( '<div class="notice notice-%2$s is-dismissible"><p>%1$s</p></div>', $text, $type );
	}
	
    /**
	 *
     * PHP minimal version was not met
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function php_version() {
          
	     /**
		 *
		 * Builder admin notice
		 *
		 */ 

          return self::notice_format( __('Para o plugin <strong>Cielo Boleto</strong> funcionar você precisa da versão 5.6.0 ou superior do <strong>PHP</strong>. Entre em contato com seu host.', 'woo-cielo-boleto'), 'error' );
    }
	
    /**
	 *
     * WooCommerce minimal version was not met
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function plugins_version() {
          
	     /**
		 *
		 * Builder admin notice
		 *
		 */ 

          return self::notice_format( __('Para o plugin <strong>Cielo Boleto</strong> funcionar você precisa da versão 3.0.0 ou superior do <strong>WooCommerce</strong>.', 'woo-cielo-boleto'), 'error' );
    }
	
    /**
	 *
     * WooCommerce or ExtraCheckoutFieldsForBrazil is missing
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function plugins_missing() {
          
	     /**
		 *
		 * Builder admin notice
		 *
		 */ 

          return self::notice_format( __('Para o plugin <strong>Cielo Boleto</strong> funcionar você precisa dos plugin(s) <a href="plugin-install.php?tab=plugin-information&plugin=woocommerce" data-fancybox data-type="iframe">WooCommerce</a> e <a href="plugin-install.php?tab=plugin-information&plugin=woocommerce-extra-checkout-fields-for-brazil" data-fancybox data-type="iframe"> WooCommerce Extra Checkout Fields for Brazil</a> ativados.', 'woo-cielo-boleto'), 'error' );
    }

    /**
	 *
     * Woocommerce currency is invalid
     *
     * @access public
     * @return WC_Notices_Builder
     *
     */
	
	public static function currency_error() {

	     /**
		 *
		 * Show admin error notice
		 *
		 */ 

          return self::notice_format( __('Para receber pagamentos com a <strong>Cielo</strong> você precisa habilitar a Moeda <a href="admin.php?page=wc-settings&tab=general#pricing_options-description">Real brasileiro (R$) no WooCommerce.</a>', 'woo-cielo-boleto'), 'error');
    }
	
    /**
	 *
     * Invalid Gateway credentials
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function credentials_missing() {
          
	     /**
		 *
		 * Show admin error notice
		 *
		 */ 

          return self::notice_format( __('Para receber pagamentos com a <strong>Cielo</strong> certifiquese de inserir as credenciais de acesso no menu de <a href="admin.php?page=wc-settings&tab=checkout&section=woo-cielo-boleto">opções.</a>', 'woo-cielo-boleto'), 'error');
    }

    /**
	 *
     * Initial admin message
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function welcome_to_plugin() {
     
	     /**
		 *
		 * Show admin info notice
		 *
		 */ 

          return self::notice_format( __('Obrigado por baixar o plugin <strong>Cielo Boleto</strong> para ativá-lo acesse o menu de <a href="admin.php?page=wc-settings&tab=checkout&section=woo-cielo-boleto">opções</a>.', 'woo-cielo-boleto'), 'info');
    }

    /**
	 *
     * SSL require admin message
     *
     * @access public
     * @return WC_Notices_Builder
	 *
     */
	 
	public static function ssl_require() { 
     
	     /**
		 *
		 * Show admin error notice
		 *
		 */ 

          return self::notice_format( __('Para uma integração correta entre o plugin  <strong>Cielo Boleto</strong> e a API Cielo eCommerce, um certicado SSL precisa estar ativo em seu website.', 'woo-cielo-boleto'), 'error');
    }
}
