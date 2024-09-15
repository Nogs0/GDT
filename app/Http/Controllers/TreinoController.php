<?php

namespace App\Http\Controllers;

use App\Dtos\PagedResultDto;
use App\Dtos\TreinoDto;
use App\Models\ClienteTreino;
use App\Models\Treino;
use Brick\Math\BigInteger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Throwable;

class TreinoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/treinosGetAll/{pagina}",
     *     summary="Retorna lista de treinos",
     *     tags={"Treinos"},
     *     @OA\Parameter(
     *         name="página",
     *         in="path",
     *         description="Página que deseja",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Lista de treinos")
     * )
     */
    public function getAll(int $pagina)
    {
        try {

            $count = Treino::count();
            if (--$pagina < 0)
                $pagina = 0;

            // Definir o tamanho da página
            $itemsPerPage = 5;
            if ($pagina * $itemsPerPage >= $count)
                $pagina--;

            // Obter os treinos da página atual
            $treinos = Treino::query()
                ->skip($itemsPerPage * $pagina)
                ->take($itemsPerPage)
                ->get();

            $pagedResultDto = new PagedResultDto($count, ++$pagina, $treinos);
            return view('app.treinos.index', compact('pagedResultDto'));
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/treinos/{id}",
     *     summary="Retorna um exercicio pelo id",
     *     tags={"Treinos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do treino que deseja",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Treino")
     * )
     */
    public function get($id)
    {
        try {

            $treino = Treino::with('exercicios')->findOrFail($id);
            return response()->json(new TreinoDto($treino));

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        }
        catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/treinos/",
     *     summary="Cadastra um treino",
     *     tags={"Treinos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"grupamento_muscular", "foco"},
     *                 @OA\Property(property="grupamento_muscular", type="string", example="Supino reto"),
     *                 @OA\Property(property="foco", type="string", example="Hipertrofia")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Treino atualizado")
     * )
     */
    public function create(Request $request)
    {
        try {

            $request->validate([
                'grupamento_muscular' => 'required|max:50',
                'foco' => 'required|max:100'
            ]);

            Treino::create($request->all());
        
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/treinos/",
     *     summary="Atualiza um treino",
     *     tags={"Treinos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"id", "grupamento_muscular", "foco"},
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="grupamento_muscular", type="string", example="Supino reto"),
     *                 @OA\Property(property="foco", type="string", example="Hipertrofia")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Treino atualizado")
     * )
     */
    public function update(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required',
                'grupamento_muscular' => 'required|max:50',
                'foco' => 'required|max:100'
            ]);

            $treino = Treino::find($request->input('id'));

            $treino->grupamento_muscular = $request->input('grupamento_muscular');
            $treino->foco = $request->input('foco');
        
            return response()->json($treino, 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/treinos/{id}",
     *     summary="Exclui um treino",
     *     tags={"Treinos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id do treino que deseja excluir",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="")
     * )
     */
    public function delete($id)
    {
        try {

            Treino::destroy($id);
        
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
