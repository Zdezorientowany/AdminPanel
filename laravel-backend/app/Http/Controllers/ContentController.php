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
        $content = Content::create($request->all());

        return response()->json($content, 201);
    }

    public function update(Request $request, Content $content)
    {
        $content->update($request->all());

        return response()->json($content, 200);
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return response()->noContent();
    }
}
