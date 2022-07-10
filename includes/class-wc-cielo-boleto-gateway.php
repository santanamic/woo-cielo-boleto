<?php

namespace CieloBoleto_478R4FRF;

/**
 *
 * WC_Gateway Class
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
 * WC_Gateway Class
 *
 * @category Class
 * @version  1.0.0
 * @package  woo-cielo-boleto
 *
*/

class WC_Gateway extends \WC_Payment_Gateway
{ 
  
     /**
	 *
     * Initialize gateway
     *
     * @access public
     * @return void
     *
     */   
     
     public function __construct() {
     
          /**
          *
          * Basic gateway settings
          *
          */  

          $this->id = 'woo-cielo-boleto';
          $this->icon = WOOCOMMERCE_CIELO_BOLETO_DIR_URL . 'public/assets/img/icon.svg';
          $this->has_fields = false;
          $this->method_title = __('Cielo Boleto', 'woo-cielo-boleto');
          $this->method_description =  __( 'Para utilizar este meio de pagamento você precisa das credenciais de acesso fornceias pela Cielo. <br> <a href="#">Entre em contato com o suporte Cielo para conseguirás!</a>', 'woo-cielo-boleto' );
          
          $this->init_form_fields();

          /**
          *
          * Get admin gateway optios
          *
          */ 
             
          $this->init_settings();

          $this->title = $this->get_option( 'title' );
          $this->description = $this->get_option( 'description' );
          $this->enabled = $this->get_option( 'enabled' );
          $this->merchant_id = $this->get_option( 'merchant_id' );
          $this->merchant_key = $this->get_option( 'merchant_key' );
		  $this->debug = $this->get_option('debug'); 

		  /**
          *
          * Set logs
          *
          */ 
		  
		  $this->log = new WC_Log( $this );
		  
          /**
          *
          * Run gateway API
          *
          */ 
		  
		  $this->api = new WC_API( $this );

          /**
          *
          * Run gateway hooks
          *
          */ 

          add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		  add_action( 'woocommerce_api_' . $this->id, array( $this, 'webhook' ) );
		  add_action('woocommerce_thankyou_' . $this->id, array( $this, 'order_summary_preview' ) );
		  add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );

      }

     /**
	 *
     * Set gateway forms
     *
     * @access public
     * @return array Admin plugun options
     *
     */  

     public function init_form_fields(){
          
		/**
		 *
		 * Specify the fields to view on the woocommerce configuration page
		 *
		 */ 
          
          $this->form_fields = array(
              'enabled' => array(
                  'title'       => __( 'Ativar/Desativar', 'woo-cielo-boleto' ),
                  'label'       => __( 'Marque para ativar essa forma de pagamento', 'woo-cielo-boleto' ),
                  'type'        => 'checkbox',
                  'description' => '',
                  'default'     => 'no'
              ),
              'title' => array(
                  'title'       => __( 'Checkout Title', 'woo-cielo-boleto' ),
                  'type'        => 'text',
                  'description' => __( 'Isso controla o título que o usuário vê durante o checkout.', 'woo-cielo-boleto' ),
                  'default'     => 'Cielo Boleto',
                  'desc_tip'    => true,
              ),
              'description' => array(
                  'title'       => __( 'Checkout Descrição.', 'woo-cielo-boleto' ),
                  'type'        => 'textarea',
                  'description' => __( 'Isso controla a descrição que o usuário vê durante o checkout.', 'woo-cielo-boleto' ),
                  'desc_tip'    => true,
                  'default'     => __( 'Pagamento com boleto bancário. Imprima o boleto e pague-o em qualquer agência da rede bancária, casas lotéricas ou banco postal.', 'woo-cielo-boleto' ), 
			  ),
              'instructions' => array(
                  'title'       => __( 'Boleto Instruções.', 'woo-cielo-boleto' ),
                  'type'        => 'textarea',
                  'description' => __( 'Instruções que serão adicionados no texto do Boleto.', 'woo-cielo-boleto' ),
				  'default'     => __( 'Aceitar somente até a data de vencimento.' ), 
				  'desc_tip'    => true,
			  ),
			  'expiration' => array(
				'title'       => __( 'Boleto Vencimento', 'woo-cielo-boleto' ),
				'type'        => 'number',
				'description' => __( 'Data de expiração do Boleto em dias.', 'woo-cielo-boleto' ),
				'default'     => '5',
				'desc_tip'    => true,
			  ),
			  'provider' => array(
				'title'       => __( 'Boleto Provider ', 'woo-cielo-boleto' ),
				'type'        => 'select',
				'description' => __( 'Atualmente a API Cielo aceita apenas boletos Bradesco e Banco do Brasil registrados e não registrados, sendo o provider o diferenciador entre eles. ', 'woo-cielo-boleto' ),
				'options'     => array(
					'SIMULADO'       => __( 'SIMULADO', 'woo-cielo-boleto' ),
					'Bradesco'       => __( 'Bradesco', 'woo-cielo-boleto' ),
					'Bradesco2' 	 => __( 'Bradesco2', 'woo-cielo-boleto' ),
					'BancoDoBrasil'  => __( 'BancoDoBrasil', 'woo-cielo-boleto' ),
					'BancoDoBrasil2' => __( 'BancoDoBrasil2', 'woo-cielo-boleto' ),
				),
			  ),
			  'advanced'              => array(
				'title'       => __( 'Advanced options', 'woocommerce' ),
				'type'        => 'title',
				'description' => '',
				),
			  'notification' => array(
				'title'       => __( 'Notificações de pagamentos', 'woo-cielo-boleto' ),
				'type'        => 'title',
				'description' =>  __( 'Para sincronização de status entre o Woocommerce e Cielo é necessário configurar uma URL de notificação junto a Cielo. Opcionalmente é possivel cadastrar informações para validar o header da notificação para isso personalize os campos <code>key</code> e <code>value</code>. Após basta entrar em contato com o suporte Cielo e informar os itens abaixo aplicáveis.', 'woo-cielo-boleto' ) . '<br /><br /><strong>' . __( 'Notificação URL:', 'woo-cielo-boleto' ) . '</strong> <code>' . esc_url( WC()->api_request_url( $this->id ) ) . '</code>' 
				),
              'header_cielo_key' => array(
                  'title'       => 'Key da URL de notificação',
                  'type'        => 'text'
              ),
              'header_cielo_value' => array(
                  'title'       => 'Value da URL de notificação',
                  'type'        => 'text'
              ),
			  'credentials' => array(
				'title'       => __( 'Configurações da Integração', 'woo-cielo-boleto' ),
				'type'        => 'title',
				'description' =>  __( 'Entre com as suas credenciais de API para processar pagamentos pela Cielo. Entre em contato com o suporte Cielo para obter as credenciais de acesso.', 'woo-cielo-boleto' )
				),
			    'testmode'              => array(
				  'title'       => __( 'Sandbox', 'woo-cielo-boleto' ),
				  'type'        => 'checkbox',
				  'label'       => __( 'Ativar o ambiente de testes da Cielo API', 'woo-cielo-boleto' ),
				  'default'     => 'no',
				),
              'merchant_id' => array(
                  'title'       => 'Merchant ID',
                  'type'        => 'text'
              ),
              'merchant_key' => array(
                  'title'       => 'Merchant Key',
                  'type'        => 'text'
              ),
              'sandbox_merchant_id' => array(
                  'title'       => 'Sandbox Merchant ID',
                  'type'        => 'text'
              ),
              'sandbox_merchant_key' => array(
                  'title'       => 'Sandbox Merchant Key',
                  'type'        => 'text'
              ),
			  'debug'                => array(
				  'title'       => __('Habilitar Log', 'woo-cielo-boleto'),
				  'type'        => 'checkbox',
				  'label'       => __('Habilitar Log', 'woo-cielo-boleto'),
				  'default'     => 'no',
				  'description' => sprintf(__('Registra os eventos do plugin através do arquivo <code>%s</code>. Observação: isto pode gravar informações pessoais. Nós recomendamos usar isso para apenas para fins de depuração e que delete esses registros após finalizar.', 'woo-cielo-boleto'), \WC_Log_Handler_File::get_log_file_path( $this->id )),
			  ),
          );
      }

     /**
	 *
     * Processes the user data after sending the payment request in checkout
     *
     * @access public
     * @param  int Current order number
     * @return array|boolean
     *
     */ 

    public function process_payment( $order_id ) {
		
		/**
		*
		* Set log promise for init payment process
		*
		*/

		$this->log
			->add( sprintf(__('Log do processo de pagamento para o ID do pedido: %s', 'woo-cielo-boleto'), $order_id) );
  
		/**
		 *
		 * Get all order data
		 *
		 */ 
          
        $order = wc_get_order( $order_id );
		
		/**
		 *
		 * Get meta URL in order option
		 *
		 */ 

        $url = $order->get_meta('CieloBoleto_URL');

		/**
		 *
		 * Check if an order payment URL exists
		 *
		 */
		
		if ( filter_var($url, FILTER_VALIDATE_URL) ) {
			
			/**
			*
			* Set log promise for retrieved payment process
			*
			*/

			$this->log
				->add( sprintf(__('URL de pagamento recuperado: %s', 'woo-cielo-boleto'), $url) );
		   
		   /**
			*
			* Return sucess and redirect for URL payment
			*
			*/ 
	  
			return [ 'result' => 'success', 'redirect' =>  $order->get_checkout_order_received_url() ];
		}
		
		/**
		 *
		 * Creates an order payment URL
		 *
		 */
		 
		else {
			
			/**
			 *
			 * Set new order in API instance
			 *
			 */ 
			 
			$this->api->set_order( $order );
			 
			/**
			 *
			 * Process payment in API. 
			 *
			 */ 
			
			$payment = $this->api->payment_request();

			/**
			 *
			 * Check API response
			 *
			 */
			
			if( $payment['status'] === 'sucess' ) {
		
				/**
				 *
				 * Get an external payment link
				 *
				 */ 
				 
				$url = $payment['body']['Payment']['Url'];
				
				/**
				 *
				 * Get gateway payment ID
				 *
				 */ 
				 
				$paymentId = $payment['body']['Payment']['PaymentId'];

			    /**
				 *
				 * Set log promise for sucess API response
				 *
				 */

				$this->log->add( var_export($payment, true) );

				/**
				 *
				 * Validate response and return confirmation
				 *
				 */ 

				if( filter_var($url, FILTER_VALIDATE_URL) ) {

					   /**
						*
						* Add payment URL in order
						*
						*/ 
						
						$order->add_meta_data('CieloBoleto_URL', $url, true);
						
					   /**
						*
						* Add payment ID in order
						*
						*/ 
						
						$order->add_meta_data('CieloBoleto_PaymentId', $paymentId, true);
						
					   /**
						*
						* Empty user cart
						*
						*/ 
						
						WC()->cart->empty_cart();
						
					   /**
						*
						* Set new order status
						*
						*/
						
						$order->update_status( 'on-hold' );
					  
					   /**
						*
						* Add note in order
						*
						*/ 
					  
						$order->add_order_note(__( 'O comprador iniciou a transação, mas até agora a Cielo não recebeu nenhuma informação de pagamento.', 'woo-cielo-boleto' ));
						
					   /**
						*
						* Save changes in order
						*
						*/ 
						
						$order->save();
						
					   /**
						*
						* Return sucess and redirect for URL payment
						*
						*/ 
					  
						return [ 'result' => 'success', 'redirect' =>  $order->get_checkout_order_received_url() ];	
				}
				  
				/**
				 *
				 * API generic error
				 *
				 */ 
				  
				else {
					  
					   /**
						*
						* Message error in checkout page
						*
						*/ 
					   
						wc_add_notice(  __( 'Erro em obter a URL de pagamento. Tente novamente!', 'woo-cielo-boleto' ), 'error' );
						
					   /**
						*
						* Set log promise for invalid URL payment
						*
						*/

						$this->log
							->add( sprintf(__('Erro de validação do URL do gateway: %s', 'woo-cielo-boleto'), $url) );

					   /**
						*
						* Close payment process
						*
						*/ 

						return ['result' => 'fail'];
				}
			 }
			 
			/**
			 *
			 * If the API response is an error, set the error and log
			 *
			 */ 
			 
			else {

			   /**
				*
				* Set frontend generic error
				*
				*/ 
				
				wc_add_notice(  __( 'Parece que a Cielo está fora do ar. Escolha outra forma de pagamento ou tente novamente!', 'woo-cielo-boleto' ), 'error' );
				
			   /**
				*
				* Set log promise for fail API response
				*
				*/

				$this->log->add( var_export($payment, true) );

			   /**
				*
				* Close payment process
				*
				*/ 

				return ['result' => 'fail'];			
			}
		}
    }

    /**
	 *
     * Notification request. Callback API for status changes
	 * Does not return the new status
     *
     * @access public
     * @return void
     *
     */ 

	public function webhook() {

	   /**
		*
		* Clean PHP buffer
		*
		*/ 

		@ob_clean();
		
	   /**
		*
		* Get header validation config
		*
		*/

		$getHeaderKey =  WC_Helper::plugin_settings( 'header_cielo_key' );
	
		$getHeaderValue =  WC_Helper::plugin_settings( 'header_cielo_value' );
		
		$headerKey = strtoupper('HTTP_' . $getHeaderKey);
		
	   /**
		*
		* Make sure it is not empty
		*
		*/
	
		if( $getHeaderKey != '' &&  $getHeaderValue != '' ) {

		   /**
			*
			* Assign request header 
			*
			*/
			
			$requestheaderValue = isset( $_SERVER[$headerKey] ) ? $_SERVER[$headerKey] : FALSE;
			
		   /**
			*
			* Compare request value with configuration
			*
			*/
			
			if( $requestheaderValue === $getHeaderValue ) {
				
			   /**
				*
				* Set true for run script
				*
				*/
			
				$req = true;
			} 
			else{
				
			   /**
				*
				* Set false for stop script
				*
				*/
				
				$req = false;
			}
		} 
		else {
	   
		   /**
			*
			* Set true for run script
			*
			*/

			$req = true;
		}
		

		
		/**
		*
		* Check if isset header token in request
		*
		*/ 

		if( $req ) {
			   
			   /**
				*
				* Get request body
				*
				*/
				
				$payment = file_get_contents("php://input");
				
			   /**
				*
				* Convert to array PHP
				*
				*/
				
				$payment = json_decode( $payment, true );
			   
			   /**
				*
				* Set log promise for URL notification received 
				*
				*/

				$this->log
					->add( sprintf(__('Cielo Boleto recebeu uma notificação de URL: %s', 'woo-cielo-boleto'), var_export($payment, true)) );

			   /**
				*
				* Check if not exist erros
				*
				*/
				
				if( json_last_error() == JSON_ERROR_NONE ) {

				   /**
					*
					* Get all order data with base meta value
					*
					*/

					$order = wc_get_orders( array( 'CieloBoleto_PaymentId' => $payment['PaymentId'] ) )[0];
					
				   /**
					*
					* Get order ID
					*
					*/

					$order_id = $order->get_order_number();

					/**
					*
					* Gets the order status from the gateway API
					*
					*/
					
					$order_status = $this->status_order( $order_id );
				   
				   /**
					*
					* Combine status in array payment
					*
					*/
					
					$payment['status'] =  $order_status;
					
				   /**
					*
					* Combine ID in array payment
					*
					*/
					
					$payment['MerchantOrderId'] =  $order_id;

				   /**
					*
					* Add note in order
					*
					*/ 
				  
					$order->add_order_note(__( 'Cielo Boleto: Uma atualização de status foi recebida. O status da ordem na Cielo está como: ', 'woo-cielo-boleto' ) . $payment['status'] );
			  
				   /**
					*
					* Set authorizationId in order option
					*
					*/
					
					$order->add_meta_data( 'CieloBoleto_LastChangeType', $payment['ChangeType'], true );
					
				   /**
					*
					* Save changes in order
					*
					*/ 

					$order->save();
					
				   /**
					*
					* Update order in woocommerce
					*
					*/
					
					$this->update_order( $payment );					
				}
				
			   /**
				*
				* Set if exist erros
				*
				*/
				
				else {

				   /**
					*
					* Set log promise for URL notification body json error 
					*
					*/

					$this->log
						->add( sprintf(__('Cielo Boleto recebeu uma notificação de URL, mas o corpo da mensagem é invalido : %s', 'woo-cielo-boleto'), var_export($payment, true)) );
				}
		}
		exit;
	}

    /**
	 *
     * Get order status
     *
     * @access public
     * @return void
     *
     */ 

    public function status_order( $order_id ) {
		
        /**
		 *
		 * Set log promise for get status order
		 *
		 */

		$this->log
			->add( sprintf(__('Obtendo o status da ordem: %s', 'woo-cielo-boleto'), $order_id) );

        /**
		 *
		 * Get all order data
		 *
		 */

        $order = wc_get_order( $order_id );

		/**
		 *
		 * Set new order in API instance
		 *
		 */ 
	 
		$this->api->set_order( $order );
		
		/**
		 *
		 * Get order status
		 *
		 */ 

		$response = $this->api->payment_status();
		
			/**
			 *
			 * Check API response
			 *
			 */ 
			 
		if( $response['status'] === 'sucess' ) {
			
		    /**
			 *
			 * Set log promise for sucess API response
			 *
			 */

			$this->log->add( var_export($response, true) );
		
			/**
			 *
			 * Return succes and status array
			 *
			 */ 
		 
			return $response['body']['Payment']['Status'];
		 }

		/**
		 *
		 * Return and add log
		 *
		 */ 
		 
		 else {

			/**
			 *
			 * Set log promise for fail API response
			 *
			 */

			$this->log->add( var_export($response, true) );
			
			/**
			 *
			 * Return fail and error
			 *
			 */
			 
			return $response;
		}
	}

    /**
	 *
     * Update order status in Woocommerce
     *
     * @access public
     * @return void
     *
     */ 

    public function update_order( $payment ) {
		
		/**
		 *
		 * Get all order data
		 *
		 */ 
          
        $order = wc_get_order( $payment['MerchantOrderId'] );
		
		/**
		 *
		 * Actions for each status change
		 *
		 */ 
		 
		switch( $payment['status'] ) {
			
			/**
			 *
			 * Update order status for payment cancelled/voided
			 *
			 */
			 
			case '10':
			case '13':
				$order->update_status( 'cancelled', __('Cielo Boleto: Pagamento cancelado.', 'woo-cielo-boleto' ));
				break;
				
			/**
			 *
			 * Check last status, if it is the same created reduce stock
			 * Update order status for processing
			 *
			 */
			 
			case '2':
				if($order->get_status() == 'on-hold') wc_reduce_stock_levels( $payment['MerchantOrderId'] );
				$order->update_status('processing', __( 'Cielo Boleto: Pagamento aprovado.', 'woo-cielo-boleto' ));
				break;
				
			/**
			 *
			 * Empty for default
			 *
			 */

			 default:
				break;
		}
		
        /**
		 *
		 * Set log promise for update order
		 *
		 */

		$this->log
			->add( sprintf(__('Alteração de status da ordem: %s', 'woo-cielo-boleto'), var_export($payment, true)) );
	}

    /**
	 *
     * Add a boleto view in order summary
     *
     * @access public
     * @return boolean
     *
     */
	 
	public function order_summary_preview( $order_id ) {
		
		/**
		 *
		 * Get all order data
		 *
		 */ 

		$order = wc_get_order( $order_id );
		
		/**
		 *
		 * Build boleto iframe in thankyou order page
		 *
		 */ 

		$html = '<p>' . __( 'Por favor, pague o boleto para que sua compra seja aprovada.', 'woo-cielo-boleto' ) .'</p>';
		$html .= '<p><iframe src="' . $order->get_meta('CieloBoleto_URL') . '" style="width:100%; height:1000px;border: solid 1px #eee;"></iframe></p>';
		
		/**
		 *
		 * Print content
		 *
		 */ 
		 
		echo '<p>' . $html . '</p>';		
	}
	
	/**
	 *
	 * Add content to the WC emails.
	 *
	 * @access public
	 * @param WC_Order $order Order object.
	 * @param bool     $sent_to_admin  Sent to admin.
	 * @param bool     $plain_text Email format: plain text or HTML.
	 *
	 */
	 
	public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
		if ( ! $sent_to_admin && 'woo-cielo-boleto' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
			echo wp_kses_post( wpautop( wptexturize( sprintf ( __( '<strong>OBS: Para reimprimir o boleto <a href="%s">clique aqui</a></strong>', 'woo-cielo-boleto'), $order->get_meta('CieloBoleto_URL') ) ) ) . PHP_EOL );
		}
	}
	
    /**
	 *
     * Check the requirements for run the gateway in checkout
     *
     * @access public
     * @return boolean
     *
     */ 

    public function is_available() {
		
        /**
		 *
		 * Verify that the gateway configuration is valid
		 *
		 */
		
        return WC_Validation::is_valid_gateway();
    }	
}
