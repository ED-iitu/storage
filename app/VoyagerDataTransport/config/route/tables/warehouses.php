<?php

return [
    'get' => [
		[
			'url' => '/import_warehouses',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ImportWarehouses',
			'actionName' => 'index',
			'alias' => 'voyager.browse_import_warehouses',
		],
		[
			'url' => '/export_warehouses',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ExportWarehouses',
			'actionName' => 'export',
			'alias' => 'voyager.browse_export_warehouses',
		],
	],
    'post' => [
		[
			'url' => '/import_warehouses/upload',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ImportWarehouses',
			'actionName' => 'upload',
			'alias' => 'voyager.import_warehouses.upload',
		],
		[
			'url' => '/export_warehouses/download',
			'controllerName' => 'App\VoyagerDataTransport\Http\Controllers\ExportWarehouses',
			'actionName' => 'download',
			'alias' => 'voyager.export_warehouses.download',
		],
	],
];
