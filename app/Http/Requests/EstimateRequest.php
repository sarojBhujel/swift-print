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
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'estimate_no' => ['nullable', 'string'],
            'date' => ['nullable', 'date'],
            'paper' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'total_page' => ['nullable', 'integer'],
            'size' => ['nullable', 'string'],
            'is_vat_included' => ['nullable', 'boolean'],

            'job_ids'=>['required', 'array','min:1'],
            'job_ids.*'=>['required', 'integer','exists:jobs,id'],
            'particular'=>['required','array','min:1'],
            'particular.*'=>['required','string'],
            'rate'=>['required','array'],
            'rate.*'=>['required','numeric','min:0'],
            'qty'=>['required','array'],
            'qty.*'=>['required','numeric','min:0'],
            'amount'=>['nullable','array'],
            'amount.*'=>['nullable','numeric','min:0'],
        ];
    }
}
