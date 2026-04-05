<?php

namespace App\Http\Requests\Shortener;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ShortenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'status' => ['boolean', 'default:true'],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => 'The URL field is required.',
            'url.url' => 'The URL must be a valid URL.',
            'url.max' => 'The URL may not be greater than 2048 characters.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.boolean' => 'The status field must be true or false.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422)->send();
    }
}
