<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVocabularyRequest;
use App\Http\Resources\VocabularyResource;
use App\Models\Vocabulary;
use Illuminate\Support\Facades\Storage;


class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VocabularyResource::collection(Vocabulary::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVocabularyRequest $request)
    {
        $request->validated();
        $imagename = $request->file("vocab_photos")->getClientOriginalName();
        $request->file("vocab_photos")->storeAs("public",$imagename);

        $vocab = Vocabulary::create([
            "word_uz"=>$request->word_uz,
            "word_en"=>$request->word_en,
            "description"=>$request->description,
            "spelling"=>$request->spelling,
            "audio"=>$request->audio,
            "category"=>$request->category,
            "vocab_photos"=>$imagename,
            "vocab_example"=>$request->vocab_example,
            "user_id"=>$request->user_id,
        ]);




        return new VocabularyResource($vocab);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new VocabularyResource(Vocabulary::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVocabularyRequest $request, string $id)
    {
         $request->validated();
         $imagename = $request->file("vocab_photos")->getClientOriginalName();
         $vocab = Vocabulary::find($id);
         $image = storage_path("app/public/".$vocab->vocab_photos);
         if (file_exists($image)){
             unlink($image);
         }
          $vocab->update([
             "word_uz"=>$request->word_uz,
             "word_en"=>$request->word_en,
             "description"=>$request->description,
             "spelling"=>$request->spelling,
             "audio"=>$request->audio,
             "category"=>$request->category,
             "vocab_photos"=>$imagename,
             "vocab_example"=>$request->vocab_example,
             "user_id"=>$request->user_id,
          ]);

        $request->file("vocab_photos")->storeAs("public",$imagename);

         return response()->json($vocab);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vocab = Vocabulary::find($id);
        $vocab->delete();

        return response()->json('successfully');
    }
}
