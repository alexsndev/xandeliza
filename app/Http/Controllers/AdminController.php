<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostra a lista de todos os usuários.
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        $users = User::all();
        
        return view('admin.users', compact('users'));
    }
    
    /**
     * Atualiza o papel (role) de um usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:admin,gerente,usuario',
        ]);
        
        $user->role = $request->role;
        $user->save();
        
        return redirect()->route('admin.users')->with('success', 'Papel do usuário atualizado com sucesso!');
    }
}
