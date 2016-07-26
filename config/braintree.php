<?php

return [

	'env' => env('BRAINTREE_ENV', 'sandbox'),
	'sandbox_credentials' => [
			'merchant_id' => env('BRAINTREE_SANDBOX_MERCHANT_ID', 'hcz2tmfpjngv9rjk'), 
			'public_key' => env('BRAINTREE_SANDBOX_PUBLIC_KEY', '5w5dbwftxgt56dxx'), 
			'private_key' => env('BRAINTREE_SANDBOX_PRIVATE_KEY', 'bb8b66c74d8740508bc72d28d116ad07'), 
		],
	'production_credentials' => [
			'merchant_id' => env('BRAINTREE_PRODUCTION_MERCHANT_ID', 'hcz2tmfpjngv9rjk'), 
			'public_key' => env('BRAINTREE_PRODUCTION_PUBLIC_KEY', '5w5dbwftxgt56dxx'), 
			'private_key' => env('BRAINTREE_PRODUCTION_PRIVATE_KEY', 'bb8b66c74d8740508bc72d28d116ad07'), 
		]


	
];