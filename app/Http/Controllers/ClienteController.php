<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Dtos\ClienteDto;
use App\Dtos\ClienteWithTreinosDto;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function get($id)
    {
        try {

            $cliente = Cliente::findOrFail($id);
            return response()->json(new ClienteDto($cliente));

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        }
        catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }

    public function getClienteWithTreinosId($id) {
        try {
            $cliente = Cliente::with('treinos')->findOrFail($id);
            return response()->json(new ClienteWithTreinosDto($cliente));
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 404);
        }
    }


    public function create(Request $request)
    {
        try {

            $request->validate([
                'nome' => 'required|max:50',
                'email' => 'email',
                'telefone' => 'required|max:20',
                'objetivo' => 'required|max:100'
            ]);

           Cliente::create($request->all());
        
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

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

            $cliente =Cliente::find($request->input('id'));

            $cliente->nome = $request->input('nome');
            $cliente->email = $request->input('email');
            $cliente->telefone = $request->input('telefone');
            $cliente->objetivo = $request->input('objetivo');
        
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {

           Cliente::destroy($id);
        
        } catch (\Throwable $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
