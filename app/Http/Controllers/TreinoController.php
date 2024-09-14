<?php

namespace App\Http\Controllers;

use App\Dtos\TreinoDto;
use App\Models\ClienteTreino;
use App\Models\Treino;
use Brick\Math\BigInteger;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Throwable;

class TreinoController extends Controller
{
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
        
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {

            Treino::destroy($id);
        
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
