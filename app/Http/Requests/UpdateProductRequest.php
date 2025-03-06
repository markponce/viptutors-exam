<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if login
        if (!Auth::check()) {
            return false;
        }

        // Check if admin
        if (Auth::user()->isAdmin()) {
            return true;
        }

        // Check if product belongs to the current logged-in user
        $product = $this->route('product');
        if ($product->user->id === Auth::user()->id) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('products')->ignore(Auth::user()->id, 'user_id'),
            ],
            'body' => 'required|string|min:2|max:250',
        ];
    }
}
