<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use function PHPUnit\Framework\throwException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Manipular falha de validação e retorna uma resposta JSON com os erros de validação
     * 
     * $validator o objeto de validação que contém os erros de validação
     */
        protected function failedValidation(Validator $validator)
        {
           throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
           ], 422)); //422 significa "unprocessable entity" (entidade não processável), usado quando o servidor entende a requisição, mas não pode processar devido a erros de validação no lado do servidor 
        }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Recuperar ID do usuário enviado na URL
        $userId = $this->route('user');
        return [
           'name' => 'required',
           'email' => 'required|unique:users,email,' . ($userId ? $userId->id : null),
           'password' => 'required_if:password,!=,null|min:6',
        ];
    }

    public function messages():array
    {
        return[
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessário enviar um e-mail válido!',
            'email.unique' => 'O email já está cadastrado!',
            'password.required_if' => 'Campo senha é obrigatório!',
            'password.min' => 'Senha com no mínimo :min caracteres!',


        ];
    }
}
