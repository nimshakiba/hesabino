<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // تنظیم دسترسی لازم (در صورت نیاز به Auth تغییر کن)
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:person,product,service'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
