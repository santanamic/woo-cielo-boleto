<?php

/**
 * Configuration Class
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
 * Configuration for HTTP conections
 *
 * @category Class
 */

class Configuration
{
    /**
     * Authentication type
     * 
     * @var mixed
     */

    protected $authentication;

    /**
     * Primary host URL
     * 
     * @var string
     */
    
    protected $host;

    /**
     * Default headers
     * 
     * @var string
     */
	
    protected $headers = [];

    /**
     * User agent of the HTTP request
     * 
     * @var string
     */

    protected $userAgent = 'CLIENT/1.0.0/php';

    /**
     * Debug client (default set to false)
     *
     * @var bool
     */

    protected $debug = false;

    /**
     * Debug file location (log to STDOUT by default)
     *
     * @var string
     */

    protected $debugFile = 'php://output';

    /**
     * Debug file location (log to STDOUT by default)
     *
     * @var string
     */

    protected $tempFolderPath;
    
    /**
     * Indicates if SSL verification should be enabled or disabled.
     *
     * This is useful if the host uses a self-signed SSL certificate.
     *
     * @var boolean True if the certificate should be validated, false otherwise.
     */
    
    protected $sslVerification = false;

    /**
     * Timeout (second) of the HTTP request, by default set to 0, no timeout
     *
     * @var string
     */

    protected $curlTimeout = 0;
    
    /**
     * Timeout (second) of the HTTP connection, by default set to 0, no timeout
     *
     * @var string
     */

	protected $curlConnectTimeout = 0;
    
    /**
     * Curl proxy host
     *
     * @var string
     */

    protected $proxyHost;
    
    /**
     * Curl proxy port
     *
     * @var integer
     */

	protected $proxyPort;

    /**
     * Curl proxy type, e.g. CURLPROXY_HTTP or CURLPROXY_SOCKS5
     *
     * @see https://secure.php.net/manual/en/function.curl-setopt.php
     * @var integer
     */

    protected $proxyType;

    /**
     * Curl proxy username
     *
     * @var string
     */

    protected $proxyUser;

    /**
     * Curl proxy password
     *
     * @var string
     */

    protected $proxyPassword;

    /**
     * Constructor of the class
     * 
     */

    public function __construct()
    {
        $this->tempFolderPath = sys_get_temp_dir();
    }

    /**
     * Adds a default header
     *
     * @param string $headerName  header name (e.g. Token)
     * @param string $headerValue header value (e.g. 1z8wp3)
     *
     * @return Configuration
     */

    public function addHeader($headerName, $headerValue)
    {
        if (!is_string($headerName)) {
            throw new \InvalidArgumentException('Header name must be a string.');
        }

        $this->headers[$headerName] =  $headerValue;
        return $this;
    }

    /**
     * Gets the default header
     *
     * @return array An array of default header(s)
     */

    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Deletes a default header
     *
     * @param string $headerName the header to delete
     *
     * @return Configuration
     */

    public function deleteHeader($headerName)
    {
        unset($this->headers[$headerName]);
    }

    /**
     * Sets the authentication
     *
     * @param mixed $authentication the authentication class
     *
     * @return Configuration
     */

    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
        return $this->getAuthentication();
    }

    /**
     * Gets the authentication
     *
     * @return Configuration
     */

    public function getAuthentication()
    {
        return $this->authentication;
    }
	
    /**
     * Sets the host
     *
     * @param string $host Host
     *
     * @return Configuration
     */

    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Gets the host
     *
     * @return string Host
     */

    public function getHost()
    {
        return $this->host;
    }

    /**
     * Sets the user agent of the api client
     *
     * @param string $userAgent the user agent of the api client
     *
     * @return Configuration
     */

    public function setUserAgent($userAgent)
    {
        if (!is_string($userAgent)) {
            throw new \InvalidArgumentException('User-agent must be a string.');
        }

        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Gets the user agent of the api client
     *
     * @return string user agent
     */

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Sets debug flag
     *
     * @param bool $debug Debug flag
     *
     * @return Configuration
     */

    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * Gets the debug flag
     *
     * @return bool
     */

    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Sets the debug file
     *
     * @param string $debugFile Debug file
     *
     * @return Configuration
     */

    public function setDebugFile($debugFile)
    {
        $this->debugFile = $debugFile;
        return $this;
    }

    /**
     * Gets the debug file
     *
     * @return string
     */

    public function getDebugFile()
    {
        return $this->debugFile;
    }

    /**
     * Sets the temp folder path
     *
     * @param string $tempFolderPath Temp folder path
     *
     * @return Configuration
     */

    public function setTempFolderPath($tempFolderPath)
    {
        $this->tempFolderPath = $tempFolderPath;
        return $this;
    }

    /**
     * Sets the HTTP timeout value
     *
     * @param integer $seconds Number of seconds before timing out [set to 0 for no timeout]
     *
     * @return Configuration
     */

    public function setCurlTimeout($seconds)
    {
        $this->curlTimeout = $seconds;
        return $this;
    }

    /**
     * Gets the HTTP timeout value
     *
     * @return string HTTP timeout value
     */

    public function getCurlTimeout()
    {
        return $this->curlTimeout;
    }

    /**
     * Gets the temp folder path
     *
     * @return string Temp folder path
     */

    public function getTempFolderPath()
    {
        return $this->tempFolderPath;
    }
    
    /**
     * Sets if SSL verification should be enabled or disabled
     *
     * @param boolean $sslVerification True if the certificate should be validated, false otherwise
     *
     * @return Configuration
     */

    public function setSSLVerification($sslVerification)
    {
        $this->sslVerification = $sslVerification;
        return $this;
    }

    /**
     * Gets if SSL verification should be enabled or disabled
     *
     * @return boolean True if the certificate should be validated, false otherwise
     */
    
    public function getSSLVerification()
    {
        return $this->sslVerification;
    }


    /**
     * Sets the HTTP connect timeout value
     *
     * @param integer $seconds Number of seconds before connection times out [set to 0 for no timeout]
     *
     * @return Configuration
     */

    public function setCurlConnectTimeout($seconds)
    {
        $this->curlConnectTimeout = $seconds;
        return $this;
    }

    /**
     * Gets the HTTP connect timeout value
     *
     * @return string HTTP connect timeout value
     */

    public function getCurlConnectTimeout()
    {
        return $this->curlConnectTimeout;
    }

    /**
     * Sets the HTTP Proxy Host
     *
     * @param string $proxyHost HTTP Proxy URL
     *
     * @return ApiClient
     */

    public function setCurlProxyHost($proxyHost)
    {
        $this->proxyHost = $proxyHost;
        return $this;
    }

    /**
     * Gets the HTTP Proxy Host
     *
     * @return string
     */

    public function getCurlProxyHost()
    {
        return $this->proxyHost;
    }
	
    /**
     * Sets the HTTP Proxy Port
     *
     * @param integer $proxyPort HTTP Proxy Port
     *
     * @return ApiClient
     */

    public function setCurlProxyPort($proxyPort)
    {
        $this->proxyPort = $proxyPort;
        return $this;
    }

    /**
     * Gets the HTTP Proxy Port
     *
     * @return integer
     */

    public function getCurlProxyPort()
    {
        return $this->proxyPort;
    }
    
    /**
     * Sets the HTTP Proxy Type
     *
     * @param integer $proxyType HTTP Proxy Type
     *
     * @return ApiClient
     */

    public function setCurlProxyType($proxyType)
    {
        $this->proxyType = $proxyType;
        return $this;
    }

    /**
     * Gets the HTTP Proxy Type
     *
     * @return integer
     */
    public function getCurlProxyType()
    {
        return $this->proxyType;
    }

    /**
     * Sets the HTTP Proxy User
     *
     * @param string $proxyUser HTTP Proxy User
     *
     * @return ApiClient
     */

    public function setCurlProxyUser($proxyUser)
    {
        $this->proxyUser = $proxyUser;
        return $this;
    }

    /**
     * Gets the HTTP Proxy User
     *
     * @return string
     */

    public function getCurlProxyUser()
    {
        return $this->proxyUser;
    }
    
    /**
     * Sets the HTTP Proxy Password
     *
     * @param string $proxyPassword HTTP Proxy Password
     *
     * @return ApiClient
     */

    public function setCurlProxyPassword($proxyPassword)
    {
        $this->proxyPassword = $proxyPassword;
        return $this;
    }

    /**
     * Gets the HTTP Proxy Password
     *
     * @return string
     */

    public function getCurlProxyPassword()
    {
        return $this->proxyPassword;
    }

    /**
     * Gets the essential information for debugging
     *
     * @return string The report for debugging
     */

    public function toDebugReport()
    {
        $report  = 'Client Debug Report:' . PHP_EOL;
        $report .= '    OS: ' . php_uname() . PHP_EOL;
        $report .= '    PHP Version: ' . PHP_VERSION . PHP_EOL;
        $report .= '    Temp Folder Path: ' . $this->getTempFolderPath() . PHP_EOL;

        return $report;
    }
}
