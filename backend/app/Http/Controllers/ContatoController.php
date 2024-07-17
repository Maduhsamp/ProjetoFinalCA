<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::where('funil_id', auth()->user()->id)->get();
        return response()->json([
            'contatos:' => $contatos
        ]);
    }

    public function show($id)
    {
        $contato = Contato::where('funil_id', auth()->user()->id)->find($id);

        if(!$contato) {
            return response()->json(['error' => 'Contato não encontrado.'], 404);
        }

        return response()->json([
            'contato:' => $contato
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'etapa_id' => 'required|integer',
            'phone_number' => 'required|string|max:11',
            'email' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:11',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'value' => 'nullable|numeric',
        ]);

        if ($request->etapa_id === null) {
            $request->etapa_id = 1;
        }

        if ($request->value === null) {
            $request->value = 0.00;
        }

        $contato = Contato::create([
            'name' => $request->name,
            'etapa_id' => $request->etapa_id,
            'funil_id' => $id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'value' => $request->value
        ]);

        return response()->json($contato, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'etapa_id' => 'required|integer',
            'phone_number' => 'required|string|max:11',
            'email' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:11',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'value' => 'nullable|numeric',
        ]);

        $contato = Contato::where('id', $id)->first();

        if (!$contato) {
            return response()->json(['error' => 'Contato não encontrado.'], 404);
        }

        $contato->name = $request->name;
        $contato->etapa_id = $request->etapa_id;
        $contato->phone_number = $request->phone_number;
        $contato->email = $request->email;
        $contato->cpf = $request->cpf;
        $contato->birth_date = $request->birth_date;
        $contato->address = $request->address;
        $contato->value = $request->value;
        $contato->save();

        return response()->json($contato, 200);
    }


    public function destroy($id){
            $contato = Contato::where('id', $id)->first();

            if (!$contato) {
                return response()->json(['error' => 'Contato não encontrado!'], 404);
            }
            else{
                $contato->delete();

                return response()->json(['message' => 'Contato deletado com sucesso!'], 200);
            }
    }
}
