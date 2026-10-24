<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization dilakukan oleh middleware can:manage-roles.
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string', Rule::in(['customer', 'staff'])],
        ];
    }
}
