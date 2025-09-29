<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
       $request->validate([
		    'nama'  => 'required|max:10',
		    'email' => ['required','email'],
		    'pertanyaan' => 'required|max:300|min:8',
		]);

    $data['nama']  = $request->nama;
    $data['email'] = $request->email;
    $data['pertanyaan'] = $request->pertanyaan;

    return view('home-question-respon', $data);
   }


}

