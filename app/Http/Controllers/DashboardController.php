<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'count' => [
                'forms' => Form::count(),
                'form_submissions' => FormSubmission::count(),
            ]
        ];
        return view('dashboard', $data);
    }
}
