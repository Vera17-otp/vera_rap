<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
       
    $data['nama']  = $request->nama;
    $data['email'] = $request->email;
    $data['pertanyaan'] = $request->pertanyaan;

    return view('home-question-respon', $data);
   }


}

