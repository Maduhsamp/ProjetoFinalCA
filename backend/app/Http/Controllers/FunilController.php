<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funil;
use Illuminate\Http\Request;

class FunilController extends Controller
{
    public function index()
    {
        $funis = Funil::where('user_id', auth()->user()->id)->get();
        return response()->json($funis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $funil = Funil::create([
            'nome' => $request->nome,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json($funil, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $funil = Funil::where('id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->first();

        if (!$funil) {
            return response()->json(['error' => 'Funil não encontrado.'], 404);
        }

        $funil->nome = $request->nome;
        $funil->save();

        return response()->json($funil);
    }


    public function destroy(){
            $funil = Funil::where('user_id', auth()->user()->id);

            if (!$funil) {
                return response()->json(['error' => 'Funil não encontrado.'], 404);
            }
            else{
                $funil->delete();
                
                return response()->json(['message' => 'Funil deletado com sucesso.']);
            }
    
    
    }
}
