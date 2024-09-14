<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Throwable;

class ExercicioController extends Controller
{
    public function get($id)
    {
        try {

            return Exercicio::findOrFail($id);

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
                'nome' => 'required',
                'is_aparelho' => 'required'
            ]);

            Exercicio::create($request->all());
        
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
                'nome' => 'required',
                'is_aparelho' => 'required'
            ]);

            $exercicio = Exercicio::find($request->input('id'));

            $exercicio->nome = $request->input('nome');
            $exercicio->is_aparelho = $request->input('is_aparelho');
        
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {

            Exercicio::destroy($id);
        
        } catch (Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
