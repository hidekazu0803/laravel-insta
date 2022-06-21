<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store (Request $request, $post_id)
    {
        $request->validate(
            [
            'comment_body' . $post_id => 'required|max:150'
            ],
            [
                // Update default error on Laravel
                'comment_body' . $post_id . '.required' => 'Cannot submit an empty comment.',
                'comment_body' . $post_id . '.max'      => 'The comment must not be greater than 150 characters.'
            ]
    );

        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $post_id;
        $this->comment->body    = $request->input('comment_body' . $post_id);
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->comment->findOrFail($id)->delete();
        return redirect()->back();

    }

}
