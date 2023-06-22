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
        return view('pages.survey');
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
            'visitor_job' => 'required'
        ]);

        $survey->fill($data)->save();

        return redirect()->back()->with('success', 'Pendapat Anda sukses terkirim. Terima Kasih.');
    }
}