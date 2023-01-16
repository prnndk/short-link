<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:links',
            'link'=>'required|url',
            'shortlink'=>'required|unique:links|alpha_dash',
        ];
    }
}
