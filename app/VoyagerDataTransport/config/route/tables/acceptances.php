<?php

return [
    'get' => [
		[
			'url' => '/import_acceptances',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ImportAcceptances',
			'actionName' => 'index',
			'alias' => 'voyager.browse_import_acceptances',
		],
		[
			'url' => '/export_acceptances',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ExportAcceptances',
			'actionName' => 'export',
			'alias' => 'voyager.browse_export_acceptances',
		],
	],
    'post' => [
		[
			'url' => '/import_acceptances/upload',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ImportAcceptances',
			'actionName' => 'upload',
			'alias' => 'voyager.import_acceptances.upload',
		],
		[
			'url' => '/export_acceptances/download',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ExportAcceptances',
			'actionName' => 'download',
			'alias' => 'voyager.export_acceptances.download',
		],
	],
];
