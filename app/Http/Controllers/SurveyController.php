<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Vote;
use App\Models\Total_like;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    // create
    public function create()
    {
        return view('survey.create');
    }

    // store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'vote1' => 'required|string|max:255',
            'vote2' => 'required|string|max:255',
        ]);

        $survey = new Survey();
        $survey->title = $validatedData['title'];
        $survey->body = $validatedData['body'];
        // vote1, vote2
        $survey->vote1 = $validatedData['vote1'];
        $survey->vote2 = $validatedData['vote2'];
        $survey->user_id = Auth::id();
        $survey->save();
        
        return redirect()->route('post.index')->with('success', 'お題が作成されました');
    }

    // vote1
    public function vote1($id)
    {
        $vote = Vote::where('survey_id', $id)->where('user_id', Auth::id())->first();
        if (!$vote) {
            $vote = new Vote();
            $vote->survey_id = $id;
            $vote->comment = '';
            $vote->vote_status = 1;
            $vote->user_id = Auth::id();
            $vote->save(); 
        } else {
           
        }

        if(ctype_digit($id)){
            $survey = $this->csvSurvey($id);
        }
        else{
            $survey = null;
        }
        return view('survey.vote', compact('vote', 'survey'));
    }
    
    // vote1
    public function vote2($id)
    {
        $vote = Vote::where('survey_id', $id)->where('user_id', Auth::id())->first();
        if (!$vote) {
            $vote = new Vote();
            $vote->survey_id = $id;
            $vote->comment = '';
            $vote->vote_status = 2;
            $vote->user_id = Auth::id();
            $vote->save(); 
        } else {
           
        }
        $file = public_path('/data.csv');

        if(ctype_digit($id)){
            $survey = $this->csvSurvey($id);
        }
        else{
            $survey = null;
        }

        return view('survey.vote', compact('vote', 'survey'));
    }

    public function csvSurvey($suveyid)
    {

        $file = public_path('/data.csv');

        $data = [];
        if (file_exists($file)) {
            $handle = fopen($file, 'r');
            while (($line = fgetcsv($handle)) !== false)
            {
            $data[] = $line;
            }

        fclose($handle);
        }
        array_shift($data);

        return $data[$suveyid];
    }

}
