<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function saveArticle(Request $request)
    {
        dd($request->all());
    }
}
