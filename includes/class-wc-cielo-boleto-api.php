<?php

namespace CieloBoleto_478R4FRF; 

/**
 *
 * WC_API Class
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
 * WC_API Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_API 
{

    /**
    *
    * The gateway
    *
    * @var WC_Gateway 
    *
    */ 	
	
	private $gateway;
	
    /**
    *
    * The data order
    *
    * @var \WC_Order 
    *
    */ 

    protected $order;
	
    /**
    *
    * The environment value
    *
    * @var Environment|null
    *
    */ 
	
	protected $environment;

    /**
     *
     * Relation between API and Order data
     * 
     * @access public
     * @param  WC_Gateway $gateway
     *
     */ 
	
    public function __construct( WC_Gateway $gateway ) {

        /**
         *
         * Set order in data
         *
         */ 
        
        $this->gateway = $gateway;
		
		/**
         *
         * Set environment value
         *
         */
		 
		$this->environment = $this->get_gateway_settings('testmode') === 'yes' ? Environment::sandbox() : null;
    }   
	
	/**
     *
     * Current order
     * 
     * @access public
     * @param \WC_Order
     * @return void
     *
     */ 
	
    public function set_order( \WC_Order $order ) {

        /**
         *
         * All data order
         *
         */ 
		 
		 $this->order = $order;
    }
	
    /**
     *
     * For acess token and more gateway options
     * 
     * @access public
     * @return $settings
     *
     */ 
	
    public function get_gateway_settings( $option ) {

        /**
         *
         * Return all admin options if option param not exist
         *
         */          

		 return $option ? $this->gateway->settings[$option] : $this->gateway->settings;
    }
	
	/**
     *
     * Body request
     * 
     * @access public
     * @return array
     *
     */ 
	
    public function get_order_options() {
		$merchant_order_id             =  $this->order->get_order_number();
		$customer_name                 =  $this->order->get_billing_first_name() . ' ' . $this->order->get_billing_last_name();
		$customer_identity             =  ( $this->order->get_meta('_billing_persontype') == '2' ) ? $this->order->get_meta('_billing_cnpj') : $this->order->get_meta('_billing_cpf');
		$customer_address_street       =  ( !empty( $this->order->get_billing_address_1() ) ) ? $this->order->get_billing_address_1() : 'NULL';
		$customer_address_number       =  ( !empty( $this->order->get_meta('_billing_number') ) ) ? $this->order->get_meta('_billing_number') : 'NULL';
		$customer_address_complement   =  ( !empty( $this->order->get_billing_address_2() ) ) ? $this->order->get_billing_address_2() : 'NULL';
		$customer_address_postcode 	   =  ( !empty( $this->order->get_billing_postcode() ) ) ? $this->order->get_billing_postcode() : 'NULL';
		$customer_address_neighborhood =  ( !empty( $this->order->get_meta('_billing_neighborhood') ) ) ? $this->order->get_meta('_billing_neighborhood') : 'NULL';
		$customer_address_city         =  ( !empty( $this->order->get_billing_city() ) ) ? $this->order->get_billing_city() : 'NULL';
		$customer_address_state        =  ( !empty( $this->order->get_billing_state() ) ) ? $this->order->get_billing_state() : 'NULL';
		$payment_amount                =  ( str_replace( array('.',','), '', $this->order->get_total() * 100 ) );
		$payment_provider              =  $this->get_gateway_settings('provider');
		$payment_boleto_number         =  $this->order->get_order_number();
		$payment_demonstrative         =  __('COMPRA ONLINE', 'woo-cielo-boleto');
		$payment_assignor              =  get_bloginfo('name');
		$payment_expiration_date       =  date('Y-m-d', strtotime('+' . $this->get_gateway_settings('expiration') . ' days'));
		$payment_instructions          =  $this->get_gateway_settings('instructions');

        /**
         *
         * Options for API request
         *
         */ 

		return [
		  'MerchantorderId' => $merchant_order_id,
		  'Customer' 		=> [
			'Name' 		  		=> $customer_name,
			'Identity'    		=> $customer_identity,
			'Address'      		=> [
				'Street'     => $customer_address_street,
				'Number'     => $customer_address_number,
				'Complement' => $customer_address_complement,
				'ZipCode'    => $customer_address_postcode,
				'District'   => $customer_address_neighborhood,
				'City'       => $customer_address_city,
				'State'      => $customer_address_state,
				'Country'    => 'BRA',
			],
		  ],
		  'Payment' 		=> [
		  	'Type' 			 	=> 'Boleto',
			'Amount' 	   	 	=> $payment_amount,
			'Provider'  	 	=> $payment_provider,
			'BoletoNumber'   	=> $payment_boleto_number,
			'Demonstrative'  	=> $payment_demonstrative,
			'Assignor'		 	=> $payment_assignor,
			'ExpirationDate' 	=> $payment_expiration_date,
			'Instructions'   	=> $payment_instructions,
		  ],
		];
    }
	
    /**
     *
     * Credential Instance
     * 
     * @access public
     * @return Configuration
     *
     */ 
	
    public function api_credential() {
		
        /**
         *
		 * Get credential options 
         *
         */ 
		
		$merchant_id = $this->environment === null ? 'merchant_id' : 'sandbox_merchant_id' ;
		$merchant_key = $this->environment === null ? 'merchant_key' : 'sandbox_merchant_key' ;
        
		/**
         *
         * Set token option in auth instance
         *
         */
		 
		$config = new Configuration();
		$auth = $config->setAuthentication( Auth::TokenAuth() );
		$auth->setAccessToken( 'MerchantId', $this->get_gateway_settings( $merchant_id ) );
		$auth->setAccessToken( 'MerchantKey', $this->get_gateway_settings( $merchant_key ) );
		return $config;
    }
	
    /**
     *
     * Credential Instance
     * 
     * @access public
     * @return Configuration
     *
     */ 
	
    public function api_client() {
		
        /**
         *
         * Set HttpClient
         *
         */ 

        return new Client( $this->api_credential() );
    }
	
    /**
     *
     * Get payment URL
     * 
     * @access public
     * @return Array
     *
     */ 
	
    public function payment_request() {
		
        /**
         *
         * Set api Instance for payment Request
         *
         */ 

		$apiInstance = new SDK\CreateBoleto( $this->api_client(), $this->environment );

        /**
         *
         * Set Request body orders params
         *
         */ 

		$body = $this->get_order_options();

        /**
         *
         * Init the Request
         *
         */ 
		 
		try {

			/**
			 *
			 * Run communication with the API
			 *
			 */
			 
			$result = $apiInstance->run($body, false);
			
			/**
			 *
			 * On success the response returns
			 *
			 */ 
		 
			return  [ 'status' => 'sucess', 'body' => $result ];
		} 
	
		/**
		 *
		 * Error handling
		 *
		 */ 
			 
		catch ( Exception $e ) {

			/**
			 *
			 * Get and return error mesage for log file
			 *
			 */ 
		 
			return  [ 'status' => 'fail', 'body' => 'Exception when calling: ' . $e->getMessage() . var_export( $e->getResponseBody(), true ) ];
		}
	}
	
    /**
     *
     * Credential Instance
     * 
     * @access public
     * @return Configuration
     *
     */ 
	
    public function payment_status() {
		
       /**
         *
         * Set api Instance for payment status
         *
         */ 

		$apiInstance = new SDK\StatusBoleto( $this->api_client(), $this->environment );

        /**
         *
         * Get order ID
         *
         */ 
		 
		$paymentId = $this->order->get_meta('CieloBoleto_PaymentId');
	
        /**
         *
         * Init the Request
         *
         */ 
		 
		try {

			/**
			 *
			 * Run communication with the API
			 *
			 */
			 
			$result = $apiInstance->run( $paymentId, false );
			
			/**
			 *
			 * On success the response returns
			 *
			 */ 
		 
			return  [ 'status' => 'sucess', 'body' => $result ];
		}
		
		/**
		 *
		 * Error handling
		 *
		 */ 
			 
		catch ( \Exception $e ) {

			/**
			 *
			 * Get and return error mesage for log file
			 *
			 */ 

			return  [ 'status' => 'fail', 'body' => 'Exception when calling StatusApi->getStatus: ' . $e->getMessage() ];
		}
	}
	
    /**
     *
     * Cancel Request
     * 
     * @access public
     * @return void
     *
     */ 
	
    public function payment_cancel( $order_id ) {
		
       /**
         *
         * Set api Instance for payment cancel
         *
         */ 

		$apiInstance = new \PicPay\SDK\CancelamentoApi( 
								$this->api_client(), 
								$this->api_credential());

	   /**
         *
         * Body request
         *
         */
		 
		$body = new \PicPay\modelPackage\CancelRequest();

	
        /**
         *
         * Init the Request
         *
         */ 
		 
		try {

			/**
			 *
			 * Run communication with the API
			 *
			 */
			 
			$result = $apiInstance->postCancellations( $body, $order_id );
			
			/**
			 *
			 * On success the response returns
			 *
			 */ 
		 
			return  [ 'status' => 'sucess', 'body' => $result ];
		}
		
		/**
		 *
		 * Error handling
		 *
		 */ 
			 
		catch ( \Exception $e ) {

			/**
			 *
			 * Get and return error mesage for log file
			 *
			 */ 

			return  [ 'status' => 'fail', 'body' => 'Exception when calling StatusApi->getStatus: ' . $e->getMessage() ];
		}
	}
}

?>