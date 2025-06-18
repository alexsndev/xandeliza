<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    /**
     * Envia o formulário de contato
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Aqui você pode adicionar a lógica para enviar o email
        // Por exemplo:
        // Mail::to('seu-email@exemplo.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
} 