<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Log Class
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
 * WC_Log Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
 */

class WC_Log
{

    /**
     *
     * The woocommerce gateway class
     *
     * @var \WC_Payment_Gateway 
     *
     */

    private $gateway;

    /**
     *
     * Receives and set gateway
     *
     * @access public
     * @param \WC_Payment_Gateway Woocommerce class
     * @return void
     *
     */

    public function __construct(\WC_Payment_Gateway $gateway)
    {

        /**
         *
         * Set gateway instance
         *
         */

        $this->gateway = $gateway;
    }

    /**
     *
     * Insert log gateway
     * 
     * @access public
     * @param Mixed Log message
     * @return void
     *
     */

    public function add($data)
    {

        /**
         *
         * Declare gateway
         *
         */

        $gateway = $this->gateway;

        /**
         *
         * Check if log option has been enabled
         *
         */

        if ($gateway->debug === 'yes') {

            /**
             *
             * Set log
             *
             */

            wc_get_logger()->add($gateway->id, $data);
        }
    }
}
