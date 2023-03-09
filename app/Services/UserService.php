<?php 
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService {

    protected $userRespository;

    public function __construct(UserRepository $userRespository){
        $this->userRepository = $userRespository;
    }

    public function all(){
        return $this->userRepository->all();
    }

    public function create(array $data){
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this->userRepository->create($user->toArray());
    }

    public function update($id, array $data) 
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            return $this->userRepository->update($user, $data);
        }

        throw new \Exception('User not found.');
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            return $this->userRepository->delete($user);
        }
        throw new \Exception('User not found.');
    }

    public function findById($id){
        return $this->userRepository->findById($id);
    }
}