<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\
use App\Models\Week;
use App\Models\Subject; 
use App\Models\Lecture;

class SubjectController extends Controller
{
    public function index()
    {
        $weeks = Week::with('subjects')->get();
        return view('lectures.index', ['weeks' => $weeks]);
    }
    
    public function subject_detail($subject_id)
    {   
        $subject = Subject::with('lectures')->findOrFail($subject_id);
        return view('lectures.subject_detail',compact('subject'));
    }
    
    public function subject_register(){
        $weeks = Week::all();
        return view('lectures.subject_register',compact('weeks'));
    }
    
    /*public function subject_store(Request $request){
        $input = $request['subject'];
        $subject = Subject::create($input);
        $week->subjects()->attach($subject->id);
        
        return redirect()->route('lectures.index');
    } */
    public function subject_store(Request $request){
        $input = $request['subject'];
        $week_id = $request['week_id'];
    
        $subject = Subject::create($input);
    
        $week = Week::find($week_id);
        $week->subjects()->attach($subject->id);
        
        return redirect()->route('lectures.index');
    }

}
    