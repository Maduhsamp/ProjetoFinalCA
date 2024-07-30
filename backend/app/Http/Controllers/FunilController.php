<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funil;
use Illuminate\Http\Request;

class FunilController extends Controller
{
    public function index()
    {
        $funis = Funil::where('user_id', auth()->user()->id)->paginate(20);

        return response()->json([
            'funis' => $funis->items(),
            'current_page' => $funis->currentPage(),
            'next_page' => $funis->nextPageUrl(),
            'previous_page' => $funis->previousPageUrl(),
            'last_page' => $funis->lastPage(),
            'per_page' => $funis->perPage(),
            'total' => $funis->total()
        ]);
    }

    public function show($id)
    {
        $funil = Funil::where('user_id', auth()->user()->id)->find($id);

        if(!$funil) {
            return response()->json(['error' => 'Funil não encontrado.'], 404);
        }

        return response()->json([
            'funil' => $funil
        ]);
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


    public function destroy($id){
            $funil = Funil::where('user_id', auth()->user()->id)->where('id', $id)->first();

            if (!$funil) {
                return response()->json(['error' => 'Funil não encontrado.'], 404);
            }
            else{
                $funil->delete();

                return response()->json(['message' => 'Funil deletado com sucesso.']);
            }


    }
}
