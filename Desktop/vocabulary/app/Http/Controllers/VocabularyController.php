<?php

namespace App\Http\Controllers;

use App\Http\Resources\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new Vocabulary(\App\Models\Vocabulary::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vocabulary = new \App\Models\Vocabulary();
        $vocabulary->word = $request->input('word');
        $vocabulary->description = $request->input('description');
        $vocabulary->spelling = $request->input('spelling');
        $vocabulary->audio = $request->input('audio');
        $vocabulary->category = $request->input('category');
        $vocabulary->vocab_photos = $request->input('vocab_photos');
        $vocabulary->vocab_example = $request->input('vocab_example');
        $vocabulary->user_id =
        $vocabulary->save();

        return response()->json($vocabulary);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return \App\Models\Vocabulary::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vocab = \App\Models\Vocabulary::find($id);
        $vocab->update([
            "word"=>$request->input('word'),
            "description"=>$request->input('description'),
            "spelling"=>$request->input('spelling'),
            "audio"=>$request->input('audio'),
            "category"=>$request->input('category'),
            "vocab_photos"=>$request->input('vocab_photos'),
            "vocab_example"=>$request->input('vocab_example'),
            "user_id"=>$vocab->users->id
        ]);
        return response()->json('successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vocab = \App\Models\Vocabulary::find($id);
        $vocab->delete();
        return response()->json('successful');
    }
}
