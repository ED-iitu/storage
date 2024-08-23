<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use App\Http\Controllers\Controller;
use VoyagerDataTransport\Traits\VoyagerExportData;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExportAcceptances extends Controller
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
        $this->authorize('browse_export_acceptances');
        return view('vendor.voyager.acceptances.export-data', []);
    }

    /**
     * Set spread sheet
     *
     * @return void
     */
    protected function setSpreadSheet(): void
    {

        $title_col = 1;
		$code_col = 2;
		$quantity_col = 3;
		$remaining_quantity_col = 4;
		$invoice_price_col = 5;
		$markup_col = 6;
		$selling_price_col = 7;
		$discount_col = 8;
		$price_with_discount_col = 9;
		$total_col = 10;
		$created_at_col = 11;
		$updated_at_col = 12;


        $colTitleMaps = [
            $title_col => 'title',
			$code_col => 'code',
			$quantity_col => 'quantity',
			$remaining_quantity_col => 'remaining_quantity',
			$invoice_price_col => 'invoice_price',
			$markup_col => 'markup',
			$selling_price_col => 'selling_price',
			$discount_col => 'discount',
			$price_with_discount_col => 'price_with_discount',
			$total_col => 'total',
			$created_at_col => 'created_at',
			$updated_at_col => 'updated_at',

        ];

        $colFieldMaps = [
            $title_col => function ( $list ) {
                $value = $list->title;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$code_col => function ( $list ) {
                $value = $list->code;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$quantity_col => function ( $list ) {
                $value = $list->quantity;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$remaining_quantity_col => function ( $list ) {
                $value = $list->remaining_quantity;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$invoice_price_col => function ( $list ) {
                $value = $list->invoice_price;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$markup_col => function ( $list ) {
                $value = $list->markup;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$selling_price_col => function ( $list ) {
                $value = $list->selling_price;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$discount_col => function ( $list ) {
                $value = $list->discount;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$price_with_discount_col => function ( $list ) {
                $value = $list->price_with_discount;
                if ( is_numeric( $value ) ) return $value;
                return !empty( $value ) ? $value : '';
            },
			$total_col => function ( $list ) {
                $value = $list->total;
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

        DB::table('acceptances')
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
