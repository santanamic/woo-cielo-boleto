<?php

/**
 * CreateBoleto Class
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

namespace CieloBoleto_478R4FRF\SDK;

/**
 * Generation the Boleto
 *
 * @category Class
 */

class CreateBoleto extends Base
{

    /**
     * Run operation 
     *
     * @param array $body payment info
     * @param boolean $jsonResponse default is true for success json output type
     * @throws Exception on non-2xx response
     * @return Client HTTP status code, HTTP response headers (array of strings)
     */
    
    public function run($body, $jsonResponse = true)
    {
		/**
		 * Define host for client API
		 */
		 
		$this->client->getConfig()
			 ->setHost( $this->environment->getApiURL() );

		/**
		 * Set default options for request
		 */
		 
        $resourcePath = "/sales";
        $httpBody = $body;
        $queryParams = [];
        $headerParams = ['Content-Type'=>'application/json'];
        $formParams = [];

        try {
            list($response, $statusCode, $httpHeader) = $this->client->call(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                $jsonResponse,
                '/sales'
            );
			return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
