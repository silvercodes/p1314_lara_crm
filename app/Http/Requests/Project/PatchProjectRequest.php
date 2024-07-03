<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class PatchProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type'              => 'sometimes|required|string|max:256',
            'description'       => 'sometimes|string|max:256',
            'contacts'          => 'sometimes|string|max:256',
            'avatar'            => 'sometimes|required|file|mimes:jpeg,jpg,png|max:10240',        // 10M
            'ts'                => 'sometimes|required|file|mimes:pdf|max:51200',                 // 50M
        ];
    }
}
