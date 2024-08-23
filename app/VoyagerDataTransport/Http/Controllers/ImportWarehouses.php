<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use VoyagerDataTransport\Traits\VoyagerImportData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ImportWarehouses extends Controller
{
    use VoyagerImportData;

    const SKIP_HEADER = 10;

    const TITLE_COL = 0;
	const CATEGORY_NAME_COL = 1;
	const SUBCATEGORY_COL = 2;
	const CODE_COL = 3;
	const ADD_CODE_COL = 4;
	const QUANTITY_COL = 5;
	const MEASURE_COL = 6;
	const PURCHASE_PRICE_COL = 7;
	const SELL_PRICE_COL = 8;
	const PURCHASE_AMOUNT_COL = 9;
	const SELL_AMOUNT_COL = 10;
	const CREATED_AT_COL = 11;
	const UPDATED_AT_COL = 12;


    /**
     * Import page
     *
     * @return View
     */
    public function index(): View
    {
        $this->authorize('browse_import_warehouses');
        return view('vendor.voyager.warehouses.import-data', []);
    }

    /**
     * Set redirect url
     *
     * @return void
     */
    protected function setRedirectUrl(): void
    {
        $this->_redirectUrl = '/admin/warehouses';
    }

    /**
     * Import data action
     *
     * @param array $data
     * @return array
     */
    protected function importData(array $data): array
    {
        try {
            DB::transaction(
                function () use ($data) {
                    DB::table('warehouses')
                        ->insert([
                            'title' => $data[self::TITLE_COL],
							'category_name' => $data[self::CATEGORY_NAME_COL],
							'subcategory' => $data[self::SUBCATEGORY_COL],
							'code' => $data[self::CODE_COL],
							'add_code' => $data[self::ADD_CODE_COL],
							'quantity' => $data[self::QUANTITY_COL],
							'measure' => $data[self::MEASURE_COL],
							'purchase_price' => $data[self::PURCHASE_PRICE_COL],
							'sell_price' => $data[self::SELL_PRICE_COL],
							'purchase_amount' => $data[self::PURCHASE_AMOUNT_COL],
							'sell_amount' => $data[self::SELL_AMOUNT_COL],
                        ]);
                }
            );
            return ['status' => true, 'message' => 'data insert success'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => "{$e->getMessage()}"];
        }
    }

}
