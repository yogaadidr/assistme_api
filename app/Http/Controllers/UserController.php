<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{
    protected $user;
    // constructor receives container instance
    public function __construct() {
        $this->user = new UserRepository();
    }

    public function home(Request $request) {
        $name = 'HALOO';
        $response->getBody()->write("Hello, $name");
        return $response;
    }

    public function login(Request $request) {
        $data = $request->input();
        $users = $this->user->login($data['username'], $data['password']);
        $responseCode = 200;
        if($users == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($users,$responseCode);
    }
}