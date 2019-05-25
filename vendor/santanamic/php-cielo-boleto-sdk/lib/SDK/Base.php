<?php

namespace CieloBoleto_478R4FRF\SDK;

/**
 * Base SDK Abstract Class
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

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

use CieloBoleto_478R4FRF\Environment;

/**
 * Client for HTTP conections
 *
 * @category Class
 */

abstract class Base
{

    /**
     * Client HTTP
     *
     * @var Client
     */

    protected $client;
	
    /**
     * Host URL
     *
     * @var Environment
     */
	 
	protected $environment;

    /**
     * Constructor
     *
     * @param Client $client The api client to use
	 * @param Environment $environment The host instancie
     */

    public function __construct($client, $environment = null)
    {		
		if ($environment == null) {
            $environment = Environment::production();
        }
		
        $this->client = $client;
        $this->environment = $environment;
    }

    /**
     * Set the client
     *
     * @param client $client set the client
     *
     * @return mixed
     */

    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return client get the API client
     */

    public function getClient()
    {
        return $this->client;
    }

}