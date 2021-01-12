<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'name' => 'required|min:3',
            'locale' => [
                'required',
                Rule::in(array_keys(User::LOCALES))
            ]
        ];
    }
}
