<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        $skills = Skill::all();
        $projects = Project::all();
        $certificates = Certificate::all();
        $contacts = Contact::all();
        return view('index', compact('abouts', 'skills', 'projects', 'certificates', 'contacts'));
    }
}
