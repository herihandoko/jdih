<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use DB;

class SurveyController extends Controller
{
    public function index() {
        $jnsKelamin = DB::select('SELECT DISTINCT IF(a.visitor_sex="L", "Laki-Laki", "Perempuan") as visitor_sex, (SELECT COUNT(survey.visitor_sex) FROM survey WHERE a.visitor_sex = survey.visitor_sex) as total_visitorsex FROM survey a');

        $pendidikan = DB::select('SELECT DISTINCT a.visitor_education, (SELECT COUNT(survey.visitor_education) FROM survey WHERE a.visitor_education = survey.visitor_education) as total_visitoreducation FROM survey a');

        $pekerjaan = DB::select('SELECT DISTINCT a.visitor_job, (SELECT COUNT(survey.visitor_job) FROM survey WHERE a.visitor_job = survey.visitor_job) as total_visitorjob FROM survey a');

        $listSurvey = Survey::orderBy('created_at', 'desc')->get();

        return view('admin.survey', compact('jnsKelamin', 'pendidikan', 'pekerjaan', 'listSurvey'));
    }

    public function getSurveyData() {
        $identity = $_GET['identity'];
        $surveyID = Crypt::decrypt($identity);
        $surveyList = Survey::where('id', $surveyID)->first();

        return $surveyList;
    }
}