<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DefaultEstimateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
                'particular_name'=>'required|string|max:250',
                'unit'=>'nullable|string|max:250',
                'rate'=>'nullable|integer',
                'quantity'=>'nullable|integer'
        ];

        if($this->method()!='POST' && $this->method()!='post'){

            $rules += [
                'product_id'=>'required|integer'
            ];
        }
        return $rules;
    }
}
