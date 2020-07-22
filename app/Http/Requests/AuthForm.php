<?php

namespace App\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;

class AuthForm extends FormRequest
{
    use SanitizesInput;

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
		$rules = [
			'username' => 'required|min:4|max:255'
        ];
        if (env('APP_ENV') == 'production') {
            $rules['password'] = 'required|min:4|max:255';
        }
        return $rules;
	}

    public function filters()
    {
        return [
            'username' => 'trim|lowercase'
        ];
    }
}
