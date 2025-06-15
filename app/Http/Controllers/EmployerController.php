<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    //

    public function index()
    {
        $employers = Employer::with(['jobs'])->paginate();
        return view('employers.index', ['employers' => $employers]);
    }

    public function search(Employer $employer)
    {
        $jobs = $employer->jobs()->with(['employer', 'tags'])->latest()->paginate(20);
        return view('jobs.search_results', ['jobs' => $jobs]);
    }
}
