<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index() : View
    {}

    public function login() : View
    {
        return \View('auth.login');
    }
}
