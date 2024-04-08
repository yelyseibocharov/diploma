<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\University;
use Illuminate\Http\Request;
use App\Models\Professor;
use Illuminate\Contracts\View\View;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index() : View
    {
        return \view('dashboard.dashboard');
    }

    public function getTable()
    {
        return \view('dashboard.dashboard_table');
    }

    public function getProfessors()
    {
        $professor = Auth::user();

        if ($professor && $professor->university_id && $professor->permission === '1') {
            $professors = Professor::where('university_id', $professor->university_id)->get();
            $professors = Professor::with('department')->get();
            return \view('dashboard.dashboard_table', ['data' => $professors]);
        } else {
            return redirect()->back()->with('error', 'Профессор не найден или у него не указан университет');
        }
    }

    public function showProfile($uid)
    {
        // Получаем залогиненного профессора
        $loggedInProfessor = Auth::user();

        // Извлекаем профессора по уникальному идентификатору
        $professor = Professor::where('uid', $uid)->with('department')->first();

        if ($professor) {
            // Проверяем, относится ли найденный профессор к тому же университету, что и залогиненный профессор
            if ($professor->university_id === $loggedInProfessor->university_id) {
                // Проверяем разрешения профессора
                if ($loggedInProfessor->permission === '1' OR $loggedInProfessor->uid === $professor->uid) {
                    $universityId = $professor->university_id; // Получаем идентификатор университета профессора
                    $universityName = University::find($universityId)->full_title;
                    $institutes = Institute::where('university_id', $universityId)->with('departments')->get(); // Получаем все институты и их департаменты, относящиеся к университету
                    return \view('profile.profile', [
                        'data' => $professor,
                        'institutes' => $institutes,
                        'university_name' => $universityName,
                        'documents' => $professor->documents,
                        'permission' => $loggedInProfessor->permission === '1'
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Здається, у Вас немає прав доступу для перегляду цього профілю. Зверніться до адміністратора Вашого ВНЗ');
                }
            } else {
                return redirect()->back()->with('error', 'Здається, у Вас немає прав доступу для перегляду цього профілю. Якщо ви вважаєте, що виникла помилка, зверніться до адміністратора ПЗ');
            }
        } else {
            return redirect()->back()->with('error', 'Користувача не знайдено. Перевірте правильність надору облікових даних');
        }

        /*$professor = Professor::where('uid', $uid)->with('department')->first();

        if ($professor) {
            return \view('profile.profile', ['data' => $professor]);
        }*/
    }

    public function getProfessorCreateView()
    {
        $professor = Auth::user();

        /*if ($professor->university_id) {
            $universityId = $professor->university_id;
            $university = University::with('institute')->find($universityId);
            $institutes = $university->institute;
        } else {
            return null;
        }*/

        $universityId = $professor->university_id; // Получаем идентификатор университета профессора
        $data = Institute::where('university_id', $universityId)->with('departments')->get(); // Получаем все институты и их департаменты, относящиеся к университету
        return \view('profile.profile_create', ['institutes' => $data]);
    }

    public function getDepartments($id)
    {
        $institute = Institute::findOrFail($id);
        $departments = $institute->departments()->get();

        return response()->json($departments);
    }


}
