<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateRequest extends FormRequest
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
        return [
            'client_id'=>['required', 'integer', 'exists:customers,id'],
            'item_name'=>['required', 'string'],
            'estimate_no'=>['required', 'string'],
            'page_color'=>['required', 'string','in:b&w,color'],
            'pages'=>['required', 'integer'],
            'size'=>['required', 'sting'],
            'is_vat_encluded'=>['required','boolean'],

            'job_ids'=>['required', 'array','min:1'],
            'job_ids.*'=>['required', 'integer','exists:jobs,id'],

            'particular_json'=>['required', 'array','min:1'],
            'particular_josn.*.particulars' => ['required', 'string'],
            'particular_josn.*.rate'         => ['required', 'numeric', 'min:0'],
            'particular_josn.*.quantity'     => ['required', 'numeric', 'min:0'],
            'particular_josn.*.amount'       => ['required', 'numeric', 'min:0'],
        ];
    }
}
