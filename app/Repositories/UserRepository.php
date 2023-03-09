<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository {
    public function create(array $data){
        return User::create($data);
    }

    public function update(User $user, array $data){
        $user->update($data);
    }

    public function delete(User $user){
        $user->delete();
    }
    
    public function all(): array
    {
        return User::all()->toArray();
    }
    public function findById($id){
        return User::find($id);
    }
}
