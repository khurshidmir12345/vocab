<?php
declare(strict_types=1);

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
        $imageName = $request->file("vocab_photos")?->getClientOriginalName();
        $request->file("vocab_photos")?->storeAs("public", $imageName);

        $vocab = Vocabulary::query()->create([
            "word_uz"       => $request->get('word_uz'),
            "word_en"       => $request->get('word_en'),
            "description"   => $request->get('description'),
            "spelling"      => $request->get('spelling'),
            "audio"         => $request->get('audio'),
            "category"      => $request->get('category'),
            "vocab_photos"  => $imageName,
            "vocab_example" => $request->get('vocab_example'),
            "user_id"       => $request->get('user_id'),
        ]);


        return new VocabularyResource($vocab);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): VocabularyResource
    {
        return new VocabularyResource(Vocabulary::query()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(StoreVocabularyRequest $request, string $id)
    {
        $imageName = $request->file("vocab_photos")?->getClientOriginalName();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()->find($id);
        if (is_null($vocab)) {
            throw new \RuntimeException("Vocabulary not found");
        }
        $image = storage_path("app/public/".$vocab->vocab_photos);
        if (file_exists($image)) {
            unlink($image);
        }

        $vocab->update([
            "word_uz"       => $request->get('word_uz'),
            "word_en"       => $request->get('word_en'),
            "description"   => $request->get('description'),
            "spelling"      => $request->get('spelling'),
            "audio"         => $request->get('audio'),
            "category"      => $request->get('category'),
            "vocab_photos"  => $imageName,
            "vocab_example" => $request->get('vocab_example'),
            "user_id"       => $request->get('user_id'),
        ]);

        $request->file("vocab_photos")?->storeAs("public", $imageName);

        return response()->json($vocab);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $vocab = Vocabulary::query()->find($id);
        $vocab->delete();

        return response()->json('successfully');
    }
}
