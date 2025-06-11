<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {

        $recentJobs     = Job::with(['employer', 'limitTags'])->latest();
        $featuredJobs   = $recentJobs->get()->where('featured', true);
        $tags           = Tag::all();

        return view('home.index', [
            'featuredJobs'  => $featuredJobs,
            'recentJobs'    => $recentJobs->paginate(),
            'tags'          => $tags
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $jobs = $user->employer->jobs();
        $recentJobs     = $jobs->with(['employer', 'limitTags'])->latest();
        $featuredJobs   = $recentJobs->get()->where('featured', true);
        $tags = $jobs->get()->reduce(function (Collection $tags, Job $job) {
            return $tags->merge($job->tags);
        }, collect());

        return view('home.index', [
            'heading'       => 'Dashboard',
            'featuredJobs'  => $featuredJobs,
            'recentJobs'    => $recentJobs->paginate(),
            'tags'          => $tags
        ]);
    }
}
