<?php

namespace App\Http\Requests\API\Transaction;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTransactionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'total_qty' => 'required',
            'total_amount' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'session_id' => 'required',
            'payment_id' => 'required',
            'shop_id' => 'required',
            'items' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => 'Shop ID cannot be empty.',
            'session_id.required' => 'Session ID cannot be empty.',
            'payment_id.required' => 'Payment ID cannot be empty.',
            'total_qty.required' => 'Qty cannot be empty.',
            'amount.required' => 'Amount cannot be empty.',
            'name.required' => 'Name cannot be empty.',
            'phone.required' => 'Phone cannot be empty.',
            'address.required' => 'Address cannot be empty.',
            'items.required' => 'Product Items cannot be empty.',
        ];
    }

    /**
     * Returns validations errors.
     *
     * @param Validator $validator
     * @throws  HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException(response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ]), 422);
        }
        parent::failedValidation($validator);
    }
}
