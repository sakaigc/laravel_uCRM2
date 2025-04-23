<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => ['required'], // 顧客は必須
            'items' => ['required', 'array', 'min:1'], // 少なくとも1つの商品が必要
            'items.*.id' => ['required', 'integer', 'exists:items,id'], // 各itemにidが必要
            'items.*.quantity' => ['required', 'integer', 'min:1'], // 数量は1以上
        ];

    }
}
