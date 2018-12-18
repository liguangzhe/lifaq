<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Question;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($answer)
    {
        $comment = new Answer;
        $edit = FALSE;
        return view('commentForm', ['comment' => $comment,'edit' => $edit, 'answer' =>$answer  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $answer)
    {

        $input = $request->validate([
            'body' => 'required|min:5',
        ], [

            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',

        ]);
        $input = request()->all();
        $answer = Answer::find($answer);
        //$question = Question::find($question);
        $comment = new Comment($input);
        $comment->user()->associate(Auth::user());
        //$Comment->question()->associate($question);
        $comment->answer()->associate($answer);
        $comment->save();
        //$comment = Comment::find($Comment);

        return redirect()->route('comments.show',['answer_id' => $answer->id, 'comment_id' =>  $comment->id ])->with('message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($answer,  $comment)
    {
        $comment = Comment::find($comment);

        return view('comment')->with(['comment' => $comment, 'answer' => $answer]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($answer,  $comment)
    {
        $comment = Comment::find($comment);
        $edit = TRUE;
        return view('commentForm', ['comment' => $comment, 'edit' => $edit, 'answer'=>$answer ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $answer, $comment)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [

            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',

        ]);

        $comment = Comment::find($comment);
        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('comments.show',['answer_id' => $answer, 'comment_id' => $comment])->with('message', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $answer, $comment)
    {
        $comment = Comment::find($comment);
        $question = $comment->question;
        $comment->delete();
        //return redirect()->route('answers.show',['question_id'=> $question,'answer_id' => $answer])->with('message', 'Delete');
        return redirect()->route('questions.show',['question_id' => $question])->with('message', 'Delete');

    }

}
