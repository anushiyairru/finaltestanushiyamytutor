<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubejctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mainpage()
    {
        if (Auth::check()) {
            return view('mainpage', ['subitemlists' => Subject::all()]);
        }
        return redirect("login")->withSuccess('You do not have access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubject(Request $request)
    {
        echo json_encode($request->all());
        $newSubjectList = new Subject();
        $newSubjectList->subject_title = $request->sbj_title;
        $newSubjectList->subject_description = $request->sbj_descr;
        $newSubjectList->subject_price = $request->sbj_price;
        $newSubjectList->subject_learningHours = $request->sbj_learnHours;
        $newSubjectList->save();

        return redirect('mainpage')->with('save', 'Success')->withErrors('error', 'Failed');
    }
}
