<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Professor;
use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index() : View
    {
        return \view('home');
    }

    public function register() : View
    {
        return \view('auth.register');
    }

    public function login() : View
    {
        return \view('auth.login');
    }

    public function autorization()
    {
        $email = $this->request->get('email');
        $password = $this->request->get('password');

        $professor = Professor::where('email', $email)->first();

        if ($professor && Hash::check($password, $professor->password)) {
            Auth::login($professor);
            return redirect()->route('dashboard');
        } else {
            Session::flash('error', 'Перепрошуємо, але ми не можемо вас авторизувати. Перевірте правильність набору облікових даних, або зверніться до адміністратора Вашого ВНЗ');
            return redirect()->back();
        }
    }

    public function registration()
    {
        $professor = Professor::create([
            'first_name' => $this->request->get('first_name'),
            'last_name' => $this->request->get('last_name'),
            'parent_name' => $this->request->get('parent_name'),
            'date_of_birth' => '2002-05-07',
            'phone_number' => '+380 99-661-07-66',
            'email' => $this->request->get('email'),
            'password' => Hash::make($this->request->get('password')),
            'permission' => '0',
            'function' => '1',
            'status_code' => 0,
            'university_id' => 1,
            'department_id' => 1,
            'uid' => Str::uuid()
        ]);
        Auth::login($professor);
        return to_route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        $this->request->session()->invalidate();
        $this->request->session()->regenerateToken();
        return redirect('/');
    }

    public function getDepartments($id)
    {
        $institute = Institute::findOrFail($id);
        $departments = $institute->departments()->get();

        return response()->json($departments);
    }

    public function getInstitutes($id)
    {
        $institute = Institute::where('university_id', $id)->get();

        return response()->json($institute);
    }
}
