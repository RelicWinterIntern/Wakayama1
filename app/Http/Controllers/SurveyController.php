<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
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


}