<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class SurveyController extends Controller
{
    public function index()
    {
        $jnsKelamin = DB::select('SELECT DISTINCT IF(a.visitor_sex="L", "Laki-Laki", "Perempuan") as visitor_sex, (SELECT COUNT(survey.visitor_sex) FROM survey WHERE a.visitor_sex = survey.visitor_sex) as total_visitorsex FROM survey a');
        $pendidikan = DB::select('SELECT DISTINCT a.visitor_education, (SELECT COUNT(survey.visitor_education) FROM survey WHERE a.visitor_education = survey.visitor_education) as total_visitoreducation FROM survey a');
        $pekerjaan = DB::select('SELECT DISTINCT a.visitor_job, (SELECT COUNT(survey.visitor_job) FROM survey WHERE a.visitor_job = survey.visitor_job) as total_visitorjob FROM survey a');
        
        return view('pages.survey', compact('jnsKelamin', 'pendidikan', 'pekerjaan'));
    }

    public function create(Request $request) {
        $survey = new Survey();
        $data = $request->only($survey->getFillable());

        $request->validate([
            'visitor_name' => 'required',
            'visitor_sex' => 'required',
            'visitor_age' => 'required',
            'visitor_email' => 'required|email',
            'visitor_education' => 'required',
            'visitor_job' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ],
        [
            'g-recaptcha-response.required' => 'Harap verifikasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Kesalahan captcha! coba lagi nanti atau hubungi admin web.',
        ]);

        $survey->fill($data)->save();

        return redirect()->back()->with('success', 'Pendapat Anda sukses terkirim. Terima Kasih.');
    }
}