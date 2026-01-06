<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'designation' => ['required', 'string', 'max:255'],
            'auteur'      => ['required', 'string', 'max:255'],
            'editeur'     => ['required', 'string', 'max:255'],
            'prix'        => ['required', 'numeric', 'min:0'],
            'type'        => ['required','string',],
            'langue'      => ['required','string',],
            'categorie'   => ['required','string','max:255'],
            'description' => ['required', 'string', 'min:10'],
            'cover'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
