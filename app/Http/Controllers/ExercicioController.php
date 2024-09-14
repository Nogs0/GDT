<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Throwable;

class ExercicioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/exercicios",
     *     summary="Retorna lista de exercícios",
     *     tags={"Exercícios"},
     *     @OA\Response(response="200", description="Lista de exercícios")
     * )
     */
    public function getAll()
    {
        try {
            return Exercicio::all()->toJson();
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/exercicios/{id}",
     *     summary="Retorna um exercicio pelo id",
     *     tags={"Exercícios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do exercício que deseja",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Exercício")
     * )
     */
    public function get($id)
    {
        try {

            return Exercicio::findOrFail($id);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/exercicios/",
     *     summary="Cadastra um exercício",
     *     tags={"Exercícios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"nome", "is_aparelho"},
     *                 @OA\Property(property="nome", type="string", example="Supino reto"),
     *                 @OA\Property(property="is_aparelho", type="boolean", example="true")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Exercício criado")
     * )
     */
    public function create(Request $request)
    {
        try {

            $request->validate([
                'nome' => 'required',
                'is_aparelho' => 'required'
            ]);

            return Exercicio::create($request->all());
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/exercicios/",
     *     summary="Atualiza um exercício",
     *     tags={"Exercícios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"id", "nome", "is_aparelho"},
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nome", type="string", example="Supino reto"),
     *                 @OA\Property(property="is_aparelho", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Exercício atualizado")
     * )
     */
    public function update(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required',
                'nome' => 'required',
                'is_aparelho' => 'required'
            ]);

            $exercicio = Exercicio::find($request->input('id'));

            $exercicio->nome = $request->input('nome');
            $exercicio->is_aparelho = $request->input('is_aparelho');
            $exercicio->save();

            return response()->json($exercicio, 200);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/exercicios/{id}",
     *     summary="Exclui um exercício",
     *     tags={"Exercícios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do exercício que deseja excluir",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="")
     * )
     */
    public function delete($id)
    {
        try {

            Exercicio::destroy($id);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
