<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {

        $users = $this->userService->all();

        return response()->json(['data' => $users]);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return response()->json(['data' => $user]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = $this->userService->create($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $user], 201);
    }

    public function update(UserRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = $this->userService->update($id, $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $user]);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->userService->delete($id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([], 204);
    }
}
