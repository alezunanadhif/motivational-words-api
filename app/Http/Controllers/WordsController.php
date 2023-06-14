<?php

namespace App\Http\Controllers;

use App\Http\Resources\WordsDetailResource;
use App\Http\Resources\WordsResource;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('store', 'update', 'delete');
    }
    public function index()
    {
        $words = Words::all();

        return WordsResource::collection($words);
    }

    public function show($id)
    {
        $word = Words::with('writer:id,username')->findOrFail($id);

        return new WordsDetailResource($word);
    }

    public function store(Request $request)
    {
        $request->validate([
            'about' => 'required',
            'words' => 'required',
        ]);

        $word = Words::create([
            'about' => $request->input('about'),
            'words' => $request->input('words'),
            'author' => Auth::user()->id,
        ]);

        return new WordsDetailResource($word->loadMissing('writer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'about' => 'required|string',
            'words' => 'required|string'
        ]);

        $word = Words::findOrFail($id);
        $word->update($request->all());

        return new WordsDetailResource($word->loadMissing('writer'));
    }

    public function delete($id)
    {
        $word = Words::findOrFail($id);
        $word->delete();

        return response()->json([
            'message' => 'Success deleted the words'
        ]);
    }
}
