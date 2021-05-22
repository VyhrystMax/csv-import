<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt|max:2048',
            'manufacturer' => 'required|string|min:1|max:128',
            'model' => 'required|string|min:1|max:128',
            'price' => 'required|string|min:1|max:128',
            'description' => 'required|string|min:1|max:128',
            'product_url' => 'required|string|min:1|max:128',
            'attrs' => 'array|min:1|max:10',
            'attrs.*' => "string|distinct|min:2|max:128|regex:/[a-zA-Z0-9-',\s]+/i",
            'attrs_vals' => 'array|min:1|max:10',
            'attrs_vals.*' => 'string|distinct|min:1|max:128',
        ];
    }
}
