<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'words_id' => 'required|exists:words,id',
            'comments_content' => 'required',
        ]);

        $user = Auth::user()->id;

        $comment = Comments::create([
            'user_id' => $user,
            'words_id' => $request->words_id,
            'comments_content' => $request->comments_content,
        ]);

        return new CommentsResource($comment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comments_content' => 'required|string'
        ]);

        $comment = Comments::findOrFail($id);
        $comment->update($request->all());

        return new CommentsResource($comment);
    }

    public function delete($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return response()->json([
            'message' => 'berhasil menghapus komentar'
        ]);
    }
}
