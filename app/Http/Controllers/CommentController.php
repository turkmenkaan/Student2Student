<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id) {
        $body = $request->input('commentBody');

        // Check if the user is trying to comment on himself
        if ($id == Auth::user()->id) {
            die("You cannot comment on yourself!");
            return redirect()->back();
        }

        DB::table('comments')->insert([
            'user_id' => $id,
            'content' => $body,
            'author' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }
}
