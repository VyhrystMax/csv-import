<?php

namespace App\Http\Controllers;

use App\Helpers\CsvMapper;
use App\Http\Requests\ImportRequest;
use App\Models\Products;
use App\Models\ProductsAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    public function import(ImportRequest $request)
    {
        try {
            $map = Products::getFieldsMap();
            $file_map = [];
            $attributes = [];

            foreach ($map as $key => $label) {
                $file_map[$key] = $request->get($key);
            }

            $custom_labels = $request->get('attrs');
            $custom_file_fields = $request->get('attrs_vals');

            if ($custom_labels && $custom_file_fields && count($custom_labels) === count($custom_file_fields)) {
                foreach ($custom_labels as $key => $value) {
                    $attributes[$value] = $custom_file_fields[$key];
                }
            }

            $file_data = CsvMapper::csvToArray($request->file('file')->path(), $file_map, $attributes);

            $result = $this->saveData($file_data);

            return redirect()
                ->route('import_result')
                ->with('status', $result ? 'Import successful' : 'Import Fail');
        } catch (\Exception $e) {
            return redirect()
                ->route('import_result')
                ->with('error', $e->getMessage());
        }
    }

    public function importResult(Request $request)
    {
        return view('import_result', [
            'status' => Session::get('status'),
            'error' => Session::get('error'),
        ]);
    }

    private function saveData($data)
    {
        if (empty($data)) return false;

        $products = [];
        $attributes = [];

        foreach ($data as $product) {
            if ($product['custom'] && is_array($product['custom']))
                $attributes = array_merge($attributes, $product['custom']);

            unset($product['custom']);
            $products[] = $product;
        }

        if (empty($attributes)) return Products::insert($products);

        $prods = Products::insert($products);
        $attrs = ProductsAttributes::insert($attributes);

        return $prods && $attrs;
    }
}
