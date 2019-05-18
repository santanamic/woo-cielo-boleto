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

namespace CieloBoleto_478R4FRF;

/**
 * Authentication type
 *
 * @category Class
 */

class Auth
{

	/**
	 * Configuration
	 *
	 * @var Configuration
	 */

	protected $accessToken = [];
	
    /**
     * Sets instance Auth
     *
     * @return Auth
     */
	
	public static function TokenAuth()
    {
		return new Auth();
    }
	
    /**
     * Sets the access token for OAuth
     *
     * @param string $accessToken Token for OAuth
     *
     * @return Configuration
     */
	
	public function setAccessToken($prefix = null, $token = null)
    {
		if( $prefix != null || $token != null ) {
	    	$this->accessToken[$prefix] = $token;		
		}
		return $this;
    }
	
    /**
     * Gets the access token for OAuth
     *
     * @return string Access token for OAuth
     */

    public function getAccessToken($key = null)
    {
		if(isset($key)){
			return $this->accessToken[$key];
		}
      return $this->accessToken;
    }
}