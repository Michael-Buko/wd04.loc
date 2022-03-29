<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function myPage()
    {
        return view('myPage', ['content' => '<h1>Буко</h1>
                                                    <h1>Михаил</h1>
                                                    <h1>Станиславович</h1>']);
    }
}
