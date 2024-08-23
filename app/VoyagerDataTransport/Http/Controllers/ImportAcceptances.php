<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use VoyagerDataTransport\Traits\VoyagerImportData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ImportAcceptances extends Controller
{
    use VoyagerImportData;

    const SKIP_HEADER = 10;

    const TITLE_COL = 1;
	const CODE_COL = 2;
	const QUANTITY_COL = 3;
	const REMAINING_QUANTITY_COL = 4;
	const INVOICE_PRICE_COL = 5;
	const MARKUP_COL = 6;
	const SELLING_PRICE_COL = 7;
	const DISCOUNT_COL = 8;
	const PRICE_WITH_DISCOUNT_COL = 9;
	const TOTAL_COL = 10;


    /**
     * Import page
     *
     * @return View
     */
    public function index(): View
    {
        $this->authorize('browse_import_acceptances');
        return view('vendor.voyager.acceptances.import-data', []);
    }

    /**
     * Set redirect url
     *
     * @return void
     */
    protected function setRedirectUrl(): void
    {
        $this->_redirectUrl = '/admin/acceptances';
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
                    DB::table('acceptances')
                        ->insert([
                            'title' => $data[self::TITLE_COL],
							'code' => $data[self::CODE_COL],
							'quantity' => $data[self::QUANTITY_COL],
							'remaining_quantity' => $data[self::REMAINING_QUANTITY_COL],
							'invoice_price' => $data[self::INVOICE_PRICE_COL],
							'markup' => $data[self::MARKUP_COL],
							'selling_price' => $data[self::SELLING_PRICE_COL],
							'discount' => $data[self::DISCOUNT_COL],
							'price_with_discount' => $data[self::PRICE_WITH_DISCOUNT_COL],
							'total' => $data[self::TOTAL_COL],
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
