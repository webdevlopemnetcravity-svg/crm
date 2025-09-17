<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImmigrationRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return (new StoreImmigrationRequest)->rules();
    }
}
