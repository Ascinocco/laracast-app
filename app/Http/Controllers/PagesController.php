<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about()
    {
        $people = [
            'Taylor Otwell',
            'Dayle Rees',
            'Eric Barnes'
        ];
        $name = 'Anthony Scinocco';

        return view('pages.about', compact('people'))->with('name', $name);
        //return view('pages.about')->with('name', $name);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}


