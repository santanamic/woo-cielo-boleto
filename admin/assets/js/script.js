jQuery( function( $ ) {
	'use strict';

	/**
	 * Checkbox ID.
	 */
	var checkbox_testmode_id = '#woocommerce_woo-cielo-boleto_testmode';

	/**
	 * Object to handle Cielo admin functions.
	 */
	var wc_cielo_boleto_admin = {
		isTestMode: function() {
			return $( checkbox_testmode_id ).is( ':checked' );
		},

		/**
		 * Initialize.
		 */
		init: function() {
			$( document.body ).on( 'change', checkbox_testmode_id, function() {
				var live_merchant_id  = $( '#woocommerce_woo-cielo-boleto_merchant_id' ).parents( 'tr' ).eq( 0 ),
				    live_merchant_key = $( '#woocommerce_woo-cielo-boleto_merchant_key' ).parents( 'tr' ).eq( 0 ),
					test_merchant_id  = $( '#woocommerce_woo-cielo-boleto_sandbox_merchant_id' ).parents( 'tr' ).eq( 0 ),
					test_merchant_key = $( '#woocommerce_woo-cielo-boleto_sandbox_merchant_key' ).parents( 'tr' ).eq( 0 );

				if ( $( this ).is( ':checked' ) ) {
					test_merchant_id.show();
					test_merchant_key.show();
					live_merchant_id.hide();
					live_merchant_key.hide();
				} else {
					test_merchant_id.hide();
					test_merchant_key.hide();
					live_merchant_id.show();
					live_merchant_key.show();
				}
			} );

			$( checkbox_testmode_id ).change();
		}
	};

	wc_cielo_boleto_admin.init();
});
