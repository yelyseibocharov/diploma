<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use App\Models\Professor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function generateToken()
    {
        return Str::random(60);
    }

    private function databaseTokenInsert($data)
    {
        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $data['token'],
            'init_user' => $data['init_user'],
            'operation' => $data['operation']
        ]);
    }

    private function generateDatabaseData($email, $token, $initUser, $operation)
    {
        return [
        'email' => $email,
        'token' => $token,
        'init_user' => $initUser,
        'operation' => $operation
        ];
    }

    public function registration()
    {
        $token = $this->generateToken();

        $databaseData = $this->generateDatabaseData($this->request->get('email'), $token, $this->request->get('init_user'), 'register');

        try {
            $this->databaseTokenInsert($databaseData);

            $professor = Professor::create([
                'first_name' => $this->request->get('first_name'),
                'last_name' => $this->request->get('last_name'),
                'parent_name' => $this->request->get('parent_name'),
                'date_of_birth' => $this->request->get('date_of_birth'),
                'phone_number' => $this->request->get('phone_number'),
                'email' => $this->request->get('email'),
                'password' => $token,
                'permission' => $this->request->get('permission'),
                'function' => $this->request->get('function'),
                'status_code' => 0,
                'university_id' => $this->request->get('university_id'),
                'department_id' =>  $this->request->get('department_id'),
                'uid' => Str::uuid()
            ]);

            Passport::create([
                'professor_id' => $professor->id,
                'student_id' => 0,
                'personnel_id' => 0,
                'type' => 'passport',
                'series' => $this->request->get('passport_series'),
                'number' => $this->request->get('passport_number'),
                'created' => $this->request->get('passport_created'),
                'created_from' => $this->request->get('passport_created_from'),
                'valid_until' => $this->request->get('passport_created_until'),
                'init_user' => $this->request->get('init_user')
            ]);

            Passport::create([
                'professor_id' => $professor->id,
                'student_id' => 0,
                'personnel_id' => 0,
                'type' => 'tax_card',
                'series' => 'NULL',
                'number' => $this->request->get('tax_card'),
                'created' => 'NULL',
                'created_from' => Carbon::today(),
                'valid_until' => Carbon::today(),
                'init_user' => $this->request->get('init_user')
            ]);
        } catch (\Exception $e) {
            return $response ?? [
                'status'  => 'error',
                'message' => __('Зверніться до служби підтримки'),
            ];
        }

        return to_route('dashboard');
    }
}
