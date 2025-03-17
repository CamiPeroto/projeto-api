<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Retornar a lista de usuários
     * @return JsonResponse retorna os dodos dos usuários em formato JSON
     */ 
    public function index() : JsonResponse
    {
        //Recuperar os usuários do banco de dados 
       $users = User::paginate(30);

       //Retornar os dados em formato de objeto e status 200, sucesso
        return response()->json([
            'status' => true, //o status é não obrigatório 
            'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse //utilize a model user pra recuperar os dados do usuário e injete em $user
    {
           //Retornar os dados em formato de objeto e status 200, sucesso
           return response()->json([
            'status' => true, //o status é não obrigatório 
            'users' => $user,
        ], 200);
    }

    public function store(UserRequest $request) : JsonResponse
    {
        DB::beginTransaction();

        try{
        //Cadastrar no banco de dados pegando os valores dentro de $request
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        //Operação é concluída com êxito
        DB::commit();

         //Retornar os dados em formato de objeto e status 201, sucesso
         return response()->json([
            'status' => true, //o status é não obrigatório 
            'user' => $user,
            'message' => 'Usuário cadastrado com sucesso!',
        ], 201);
        }catch(Exception $e){
            //Operação não é concluída com êxito
            DB::rollBack();

            //Retornar os dados em formato de objeto e status 400
            return response()->json([
                'status' => false, //o status é não obrigatório 
                'message' => 'Usuário  não cadastrado!',
            ], 400);
            

        }
    }
    public function update(UserRequest $request, User $user) : JsonResponse //User $user - pego o id do usuário que está sendo enviado na URL, utilizo a models User pra recuperar os dados e injeto na variável $user
    {

        DB::beginTransaction();

        try{
            $user->update([
                'name' => $request->name,
                'email' => $request->email ]);
             //Operação é concluída com êxito
             DB::commit();

        //Retornar os dados em formato de objeto e status 201, sucesso
        return response()->json([
            'status' => true, //o status é não obrigatório 
            'user' => $user,
            'message' => 'Usuário editado com sucesso!',
        ], 200);
         }catch(Exception $e){
            
            //Operação não é concluída com êxito
            DB::rollBack();

            //Retornar os dados em formato de objeto e status 400
            return response()->json([
                'status' => false, //o status é não obrigatório 
                'message' => 'Usuário  não editado!',
            ], 400);

         }
    }

    public function updatePassword(UserPasswordRequest $request, User $user): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();
        try {

            $user->update([
                'password' => $request->password,
            ]);
            // Operação é concluída com êxito
            DB::commit();
            // Retornar os dados em formato de objeto e status 200
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Senha editada com sucesso!',
            ], 200);

        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Retornar os dados em formato de objeto e status 400
            return response()->json([
                'status' => false,
                'message' => 'Senha não editada!',
            ], 400);

        }
    }

    public function destroy(User $user) : JsonResponse
    {
        try{
            //Excluir o registro do banco de dados
            $user->delete();

            //Retornar os dados em formato de objeto e status 200, sucesso
            return response()->json([
            'status' => true, //o status é não obrigatório 
            'user' => $user,
            'message' => 'Usuário apagado com sucesso!',
        ], 200);

        }catch(Exception $e){
            //Retornar os dados em formato de objeto e status 400
            return response()->json([
                'status' => false, //o status é não obrigatório 
                'message' => 'Usuário  não apagado!',
            ], 400);
        }
    }

}
