<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //

    public function index()
    {
        return (new HomeController())->index();
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $jobAttrs = $request->validate([
            'title'		=> ['required'],
            'salary' 	=> ['required'],
            'url' 		=> ['required'],
            'location'  => ['required'],
            'schedule'  => ['required'],
        ]);

        $jobAttrs['featured'] = $request->has('featured');

        /**
         * @var Job $job
         */
		$job = auth()->user()->employer->jobs()->create($jobAttrs);

        $tags = explode(',', $request->input('tags', ''));
        foreach ($tags as $tag) {
            $job->tag(trim($tag));
        }

		return redirect('/dashboard');
    }
}
