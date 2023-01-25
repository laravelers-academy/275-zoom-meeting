<?php

return [

	/**
	 * Determina si el paquete puede usar los valores por defecto o necesariamente requerir los valores
	 * de la definición manual con ser 
	 **/
	'use_default_env' => true,

	'account' => env('ZOOM_ACCOUNT', ''),

	'client' => env('ZOOM_CLIENT', ''),

	'secret' => env('ZOOM_SECRET', ''),

	'use_routes' => true,

];