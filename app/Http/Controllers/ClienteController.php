<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Dtos\ClienteWithTreinosDto;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clientes",
     *     summary="Retorna lista de clientes",
     *     tags={"Clientes"},
     *     @OA\Response(response="200", description="Lista de clientes")
     * )
     */
    public function getAll()
    {
        try {
            return Cliente::all()->toJson();
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/clientes/{id}",
     *     summary="Retorna um cliente pelo id",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do cliente que deseja",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Cliente")
     * )
     */
    public function get($id)
    {
        try {

            return Cliente::findOrFail($id);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/clienteTreinos/{id}",
     *     summary="Retorna o cliente e seus treinos",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do cliente que deseja",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Cliente e seus treinos")
     * )
     */
    public function getClienteWithTreinosId($id)
    {
        try {
            $cliente = Cliente::with('treinos')->findOrFail($id);
            return response()->json(new ClienteWithTreinosDto($cliente));
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/clientes/",
     *     summary="Cadastra um cliente",
     *     tags={"Clientes"},
     *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"nome", "email", "telefone", "objetivo"},
 *                 @OA\Property(property="nome", type="string", example="John Doe"),
 *                 @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *                 @OA\Property(property="telefone", type="string", example="35 99822 4443"),
 *                 @OA\Property(property="objetivo", type="string", example="Emagrecer")
 *             )
 *         )
 *     ),
     *     @OA\Response(response="200", description="Cliente criado")
     * )
     */
    public function create(Request $request)
    {
        try {

            $request->validate([
                'nome' => 'required|max:50',
                'email' => 'email',
                'telefone' => 'required|max:20',
                'objetivo' => 'required|max:100'
            ]);

            return Cliente::create($request->all());

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/clientes/",
     *     summary="Atualiza um cliente",
     *     tags={"Clientes"},
     *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"id", "nome", "email", "telefone", "objetivo"},
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nome", type="string", example="John Doe"),
 *                 @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *                 @OA\Property(property="telefone", type="string", example="35 99822 4443"),
 *                 @OA\Property(property="objetivo", type="string", example="Emagrecer")
 *             )
 *         )
 *     ),
     *     @OA\Response(response="200", description="Cliente atualizado")
     * )
     */
    public function update(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required',
                'nome' => 'required|max:50',
                'email' => 'email',
                'telefone' => 'required|max:20',
                'objetivo' => 'required|max:100'
            ]);

            $cliente = Cliente::find($request->input('id'));

            $cliente->nome = $request->input('nome');
            $cliente->email = $request->input('email');
            $cliente->telefone = $request->input('telefone');
            $cliente->objetivo = $request->input('objetivo');

            $cliente->save();

            return response()->json($cliente, 200);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/clientes/{id}",
     *     summary="Exclui um cliente",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do cliente que deseja excluir",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="")
     * )
     */
    public function delete($id)
    {
        try {

            Cliente::destroy($id);

        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
