<?php

namespace App\Http\Requests;


class CustomerRequest extends CustomerRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'department' => 'nullable|string',
            'contact_email' => 'nullable|string',
            'contact_mobile' => 'nullable|string',
        ];
        // $rules = [
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after:start_date',
        // ];
        // if ($this->isMethod('patch') || $this->isMethod('put')) {
        //     $rules = array_merge($rules, [

        //         'name' => 'required|string|unique:fiscal_years,name,' . $this->id
        //     ]);
        // } else {
        //     $rules = array_merge($rules, [

        //         'name' => 'required|string|unique:fiscal_years,name'
        //     ]);
        // }
        // return $rules;

    }
}
