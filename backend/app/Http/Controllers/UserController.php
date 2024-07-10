<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function sendVerificationEmail(Request $request, $id)
    {
        $user = User::findOrFail($request->$id);

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email de verificação enviado com sucesso.',
        ]);
    }

    public function verifyEmail($id, $token)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            if ($user->markEmailAsVerified($token)) {
                return response()->json([
                    'message' => 'Email verificado com sucesso.',
                ]);
            }
        }

        return response()->error('O token de verificação é inválido.');
    }
}