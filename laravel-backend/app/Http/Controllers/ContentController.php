<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;




class ContentController extends Controller
{
    public function showAll()
    {
        $contents = Content::with('tags')->get();

        return response($contents,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publish_date' => 'required|date',
            'tags' => 'array',
        ]);
    
        $tagNames = $request->input('tags', []);
    

        $tagNames = array_map('trim', $tagNames);
        $tagNames = array_filter($tagNames);
    
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
    
        $content = Content::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'publish_date' => $request->input('publish_date'),
        ]);
    
        $content->tags()->attach($tagIds);

        $content->load('tags');

        return response($content, 201);
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publish_date' => 'required|date',
            'tags' => 'array',
        ]);

        $content->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'publish_date' => $request->input('publish_date'),
        ]);

        $tagNames = $request->input('tags', []);

        $tagNames = array_map('trim', $tagNames);
        $tagNames = array_filter($tagNames);


        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $content->tags()->sync($tagIds);
        
        $content->load('tags');

        return response($content, 200);
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return response()->noContent();
    }
}
