// Ajouter un champ pour le rôle lors de l'inscription
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'in:admin,organizer,participant'],
    ]);
}