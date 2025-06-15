<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    //

    public function index()
    {
        $tags = Tag::with(['jobs'])->paginate(10);
        return view('tags.index', ['tags' => $tags]);
    }

    public function search(Tag $tag)
    {
        $jobs = $tag->jobs()->with(['tags', 'employer'])->latest()->paginate(20);
        return view('jobs.search_results', ['jobs' => $jobs]);
    }
}
