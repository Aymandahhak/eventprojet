<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserModifyController extends Controller
{
    // Modifier un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user')); // Ta vue pour modifier l'utilisateur
    }

    // Mettre à jour les informations de l'utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation des données si nécessaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // Ajouter d'autres règles selon tes besoins
        ]);

        $user->update($validatedData);
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès');
    }

    // Bannir un utilisateur (modifier le statut "is_banned" ou similaire)
    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = true;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Utilisateur banni avec succès');
    }

    // Détacher le bannissement
    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = false;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Utilisateur débanni avec succès');
    }
}
