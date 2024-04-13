<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institute;
use App\Models\University;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use Illuminate\Container\Container;

class UniversityController extends Controller
{
    private Request $request;

    private $container;

    private $controller;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->container = Container::getInstance();

        $this->controller = $this->container->make(MainController::class);
    }

    public function showGlobalsettings($id)
    {
        return University::where('id', $id)->first();
    }

    public function showUniversity($id): View
    {
        $globalSettings = $this->showGlobalsettings($id);

        return \view('university.university_main_edit', [
            'globalSetting' => $globalSettings
        ]);
    }

    public function showSpeciality($id)
    {
        $globalSettings = $this->showGlobalsettings($id);

        return \view('university.university_speciality_edit', [
            'globalSetting' => $globalSettings
        ]);
    }

    public function getInstitute($id)
    {
        return Institute::where('id', $id)->first();

    }

    public function showInstitutes($id): View
    {
        $globalSettings = $this->showGlobalsettings($id);
        $jsonData = $this->controller->getInstitutes($id);

        $data = json_decode($jsonData->getContent());

        return view('university.university_institutes_edit', [
            'globalSetting' => $globalSettings,
            'data' => $data
        ]);
    }

    public function showDepartments($id): View
    {
        $globalSettings = $this->showGlobalsettings($id);
        $data = $this->getUniversityDepartments($id);

        $jsonData = $this->controller->getInstitutes($id);

        $institutes = json_decode($jsonData->getContent());

        return \view('university.university_departments_edit', [
            'globalSetting' => $globalSettings,
            'data' => $data,
            'institutes' => $institutes
        ]);
    }

    public function editUniversity($id)
    {
        $data = $this->request->all();
        unset($data['_token']);
        University::where('id', $id)->update($data);
        redirect();
    }

    public function editInstitute($id)
    {
        $data = $this->request->all();
        unset($data['_token']);
        unset($data['institute_id']);

        if (!empty($data['edit_full_title'])) {
            $data['full_title'] = $data['edit_full_title'];
            unset($data['edit_full_title']);
        }
        if (!empty($data['edit_title'])) {
            $data['title'] = $data['edit_title'];
            unset($data['edit_title']);
        }
        Institute::where('id', $id)->update($data);
        return to_route('university_institutes_edit', ['id' => $data['university_id']]);
    }

    public function addInstitutes($id)
    {
        $data = $this->request->all();
        unset($data['_token']);
        Institute::create([
            'full_title' => $data['full_title'],
            'title' => $data['title'],
            'university_id' => $data['university_id']
        ]);
        return to_route('university_institutes_edit', ['id' => $id]);
    }

    public function getUniversityDepartments($universityId)
    {
        return Institute::where('university_id', $universityId)->with('departments')->get();
    }

    public function addDepartments($id)
    {
        $data = $this->request->all();
        unset($data['_token']);
        Department::create([
            'title' => $data['title'],
            'institute_id' => $data['institute_id'],
        ]);
        return to_route('university_departments_edit', ['id' => $id]);
    }

    public function getDepartment($id)
    {
        $department = Department::where('id', $id)->first();
        return response()->json($department);
    }

    public function editDepartment($id)
    {
        $data = $this->request->all();

        if (!empty($data['edit_title'])) {
            $data['title'] = $data['edit_title'];
            unset($data['edit_title']);
        }
        if (!empty($data['university_id'])) {
            $university = $data['university_id'];
            unset($data['university_id']);
        }

        unset($data['_token']);
        Department::where('id', $id)->update($data);

        return to_route('university_departments_edit', ['id' => $university]);
    }
}
