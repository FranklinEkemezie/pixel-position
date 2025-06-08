<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {

        $recentJobs     = Job::with(['employer', 'limitTags'])->latest();
        $featuredJobs   = $recentJobs->get()->where('featured', true);
        $tags           = Tag::all();

        return view('index', [
            'featuredJobs'  => $featuredJobs,
            'recentJobs'    => $recentJobs->paginate(),
            'tags'          => $tags
        ]);
    }
}
