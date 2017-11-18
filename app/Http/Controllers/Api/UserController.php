<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Registers a user with provided credentials
     *
     * @param RegisterRequest $request
     *
     * @return array
     */
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user             = $request->all();
            $user['password'] = bcrypt($user['password']);
            $user             = User::create($user);
            $user->api_token      = str_random(15);
            $user->save();
            DB::commit();

            return [
                'success' => true,
                'token'   => $user->api_token,
            ];
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Internal Error Occurred',
            ];
        }
    }

    /**
     *
     * @param Request $request
     *
     * @return array
     */
    public function login(Request $request)
    {
        $email    = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $user->api_token = str_random(15);
                $user->save();

                return [
                    'success' => true,
                    'token'   => $user->api_token,
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Username/Password Error',
        ];
    }
}
