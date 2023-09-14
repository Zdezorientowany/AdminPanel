<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;



class ContentController extends Controller
{
    public function show(Content $content)
    {
        return $content;
    }

    public function showAll()
    {
        $contents = Content::all();

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

        // Get the array of tag names from the request
        $tagNames = $request->input('tags', []);

        // Trim whitespace from each tag and remove empty tags
        $tagNames = array_map('trim', $tagNames);
        $tagNames = array_filter($tagNames);

        // Create new tags or retrieve existing ones
        $tags = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }
    
        $content = Content::create($request->except('tags'));

        // Attach the tags to the content
        $content->tags()->sync($tags);
    
        // Attach tags to the content
        $content->tags()->attach($request->input('tags', []));

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
    
        // Update the content fields
        $content->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'publish_date' => $request->input('publish_date'),
        ]);
    
        // Get the array of tag names from the request
        $tagNames = $request->input('tags', []);
    
        // Trim whitespace from each tag and remove empty tags
        $tagNames = array_map('trim', $tagNames);
        $tagNames = array_filter($tagNames);
    
        // Create new tags or retrieve existing ones
        $tags = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }
    
        // Sync (update) tags for the content
        $content->tags()->sync($tags);
    
        return response($content, 200);
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return response()->noContent();
    }
}
