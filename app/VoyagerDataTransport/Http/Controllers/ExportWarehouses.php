<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use App\Http\Controllers\Controller;
use VoyagerDataTransport\Traits\VoyagerExportData;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExportWarehouses extends Controller
{
    use VoyagerExportData;

    const XLSX_TYPE = 10;
    const CSV_TYPE = 20;
    const PDF_TYPE = 30;

    /**
     * Export page
     *
     * @return View
     */
    public function export(): View
    {
        $this->authorize('browse_export_warehouses');
        return view('vendor.voyager.warehouses.export-data', []);
    }

    /**
     * Set spread sheet
     *
     * @return void
     */
    protected function setSpreadSheet(): void
    {

        $title_col = 1;
		$category_name_col = 2;
		$subcategory_col = 3;
		$code_col = 4;
		$add_code_col = 5;
		$quantity_col = 6;
		$measure_col = 7;
		$purchase_price_col = 8;
		$sell_price_col = 9;
		$purchase_amount_col = 10;
		$sell_amount_col = 11;
		$created_at_col = 12;
		$updated_at_col = 13;


        $colTitleMaps = [
            $title_col => 'title',
			$category_name_col => 'category_name',
			$subcategory_col => 'subcategory',
			$code_col => 'code',
			$add_code_col => 'add_code',
			$quantity_col => 'quantity',
			$measure_col => 'measure',
			$purchase_price_col => 'purchase_price',
			$sell_price_col => 'sell_price',
			$purchase_amount_col => 'purchase_amount',
			$sell_amount_col => 'sell_amount',
			$created_at_col => 'created_at',
			$updated_at_col => 'updated_at',

        ];

        $colFieldMaps = [
            $title_col => function ( $list ) {
                $value = $list->title;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$category_name_col => function ( $list ) {
                $value = $list->category_name;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$subcategory_col => function ( $list ) {
                $value = $list->subcategory;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$code_col => function ( $list ) {
                $value = $list->code;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$add_code_col => function ( $list ) {
                $value = $list->add_code;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$quantity_col => function ( $list ) {
                $value = $list->quantity;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$measure_col => function ( $list ) {
                $value = $list->measure;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$purchase_price_col => function ( $list ) {
                $value = $list->purchase_price;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$sell_price_col => function ( $list ) {
                $value = $list->sell_price;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$purchase_amount_col => function ( $list ) {
                $value = $list->purchase_amount;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$sell_amount_col => function ( $list ) {
                $value = $list->sell_amount;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$created_at_col => function ( $list ) {
                $value = $list->created_at;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$updated_at_col => function ( $list ) {
                $value = $list->updated_at;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },

        ];

        $row = 1;

        // Set header
        foreach ($colTitleMaps as $col => $title) {
            $this->sheet->setCellValueByColumnAndRow($col, $row, $title);
        }

        DB::table('warehouses')
            ->select($colTitleMaps)
            ->orderBy('id', 'asc')
            ->chunk(10, function($lists) use ( &$row, $colFieldMaps ) {
                foreach ($lists as $list) {
                    $row += 1;
                    foreach ($colFieldMaps as $col => $objFunc) {
                        $this->sheet->setCellValueByColumnAndRow($col, $row, $objFunc($list));
                    }
                }
            });
    }

}
