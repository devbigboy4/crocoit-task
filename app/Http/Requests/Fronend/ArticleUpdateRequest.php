<?php

namespace App\Http\Requests\Fronend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleUpdateRequest extends  FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'description'=>['required', 'string'],
            'categories_ids' => ['required', 'array', 'max:10'],
            'categories_ids.*' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ];
    }
}
