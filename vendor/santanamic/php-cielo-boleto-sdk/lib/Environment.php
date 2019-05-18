<?php

/**
 * Exception Class
 *
 * This file is part of <santanamic/php-cielo-boleto-sdk>
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
 * @package santanamic/php-cielo-boleto-sdk
 * @author  @santanamic
 * @link    https://github.com/santanamic/php-cielo-boleto-sdk.git
 */

namespace CieloBoleto_478R4FRF;

/**
 * Exceptions class for HTTP conections
 *
 * @category Class
 */

class Environment
{

    /**
     * URL for requests
     *
     * @var string
     */

    private $api;
	
    /**
     * URL for inquiries
     *
     * @var string
     */

    private $apiQuery;

    /**
     * Constructor
     *
     * @param string  $api       URL requests
     * @param int     $apiQuery  URL inquiries
     */

    private function __construct($api, $apiQuery)
    {
        $this->api      = $api;
        $this->apiQuery = $apiQuery;
    }
	
    /**
     * @return Environment
     */
    
	public static function sandbox()
    {
        $api      = 'https://apisandbox.cieloecommerce.cielo.com.br/1';
        $apiQuery = 'https://apiquerysandbox.cieloecommerce.cielo.com.br/1';
        return new Environment($api, $apiQuery);
    }
    
	/**
     * @return Environment
     */
    
	public static function production()
    {
        $api      = 'https://api.cieloecommerce.cielo.com.br/1';
        $apiQuery = 'https://apiquery.cieloecommerce.cielo.com.br/1';
        return new Environment($api, $apiQuery);
    }
    
	/**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    
	public function getApiURL()
    {
        return $this->api;
    }
    
	/**
     * Gets the environment's Api Query URL
     *
     * @return string Api Query URL
     */
    
	public function getApiQueryURL()
    {
        return $this->apiQuery;
    }
}