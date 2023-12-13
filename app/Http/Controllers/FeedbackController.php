<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{

public function feedback(){
    return view('feedback');
}


public function createFeedback(Request $request)
{
    try {
        // Validation
        $request->validate([
           
            'comment' => 'required',
            'star_rating' => 'required|numeric|min:1|max:5',
        ]);

        // Create review
       
   
        $review->comments = $request->comment;
        $review->star_rating = $request->star_rating;
        $review->user_id = Auth::id();
     
        $review->save();

        return redirect()->back()->with('success', 'Data has been inserted successful!');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Inserting failed!');
    }
}

    
        }
        
    
    

