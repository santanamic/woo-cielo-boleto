<?php

/**
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

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die; // If uninstall not called from WordPress exit
}

/*
 *
 * Only remove ALL product and page data if WC_REMOVE_ALL_DATA constant is set to true in user's
 * wp-config.php. This is to prevent data loss when deleting the plugin from the backend
 * and to ensure only the site owner can perform this action.
 *
 */
 
if ( defined( 'WC_REMOVE_ALL_DATA' ) && true === WC_REMOVE_ALL_DATA ) {
	
    /**
     *
     * Delete all plugin option
     *
     */ 
	 
	delete_option( 'woocommerce_woo-cielo-boleto_settings' );
}