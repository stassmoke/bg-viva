<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SPAController
{
    /**
     * @return View
     */
    public function index(): View
    {
        return \view('spa');
    }
}
