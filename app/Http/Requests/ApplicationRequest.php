<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'theme' => 'required|string',
            'message' => 'required|string',
            'file' => 'required|file'
        ];
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedValidation(Validator $validator): \Illuminate\Http\RedirectResponse
    {
        $error = $validator->errors()->first();
        return redirect()->back()->with([
            'error' => $error
        ]);
    }
}
