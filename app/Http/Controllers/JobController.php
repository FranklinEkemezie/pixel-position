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

    protected static function normaliseTagName(string $tagName): string
    {
        return strtolower(trim($tagName));
    }

    public function index()
    {
        return (new HomeController())->index();
    }

    public function search(Request $request)
    {
        $jobs   = [];
        if ($query = $request->get('q')) {
            $jobs = Job::query()->with(['employer', 'tags'])->where('title', 'LIKE', "%$query%")->paginate();
        }

        return view('jobs.search_results', ['jobs' => $jobs, 'query' => $query]);
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

        $parseTag =

        /**
         * @var Job $job
         */
		$job = auth()->user()->employer->jobs()->create($jobAttrs);
        $tags = explode(',', $request->input('tags', ''));
        foreach ($tags as $tag) {
            $tag = self::normaliseTagName($tag);
            if ($tag) $job->tag($tag);
        }

		return redirect("/jobs/$job->id");
    }

    public function edit(Request $request, Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        $jobAttrs = $request->validate([
            'title'     => ['required'],
            'salary'    => ['required'],
            'url'       => ['required'],
            'location'  => ['required'],
            'schedule'  => ['required'],
        ]);
        $jobAttrs['featured'] = $request->has('featured');

        $job->update($jobAttrs);

        $job->tags()->detach($job->tags->pluck('id'));
        $tags = explode(',', $request->input('tags', ''));
        foreach ($tags as $tag) {
            $tag = self::normaliseTagName($tag);
            if ($tag) $job->tag($tag);
        }

        return redirect("/jobs/$job->id");
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/dashboard');
    }
}
