<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{
    // // array imitates our model / database
    // private $blogPosts = [
    //     ['id' => 1, 'title' => 'Title 1', 'text' => 'Some text 1'],
    //     ['id' => 2, 'title' => 'Title 2', 'text' => 'Some text 2']
    // ];

    public function index()
    {
        // return $this->blogPosts;
        return view('blogposts', ['posts' => \App\Models\Blogpost::all()]);
        // $posts = DB::table('blogposts')->orderBy('created_at', 'desc')->get();
        // dump($posts->avg('id')); // average for a given key
        // dump($posts->pluck('created_at')->all()); // get all values for a given key and convert the resulting collection to an array
        // return view('blogposts', ['posts' => $posts]);
    }

    public function show($id)
    {
        // foreach ($this->blogPosts as $blogPost) {
        //     if ($blogPost['id'] == $id) {
        //         return $blogPost;
        //     }
        // }
        $bp = \App\Models\Blogpost::find($id);
        // dump($bp->comments()->get());
        return view('blogpost', ['post' => $bp]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas! Galime pažiūrėti, kas bus jei bus neteisingas
            'title' => 'required|unique:blogposts,title|max:5',
            'text' => 'required',
        ]);

        $pb = new \App\Models\Blogpost();
        $pb->title = $request['title'];
        $pb->text = $request['text'];

        return ($pb->save() == 1)
            ? redirect('/posts')->with('status_success', 'Post created!')
            : redirect('/posts')->with('status_error', 'Post was not created!');
    }

    public function destroy($id)
    {
        \App\Models\Blogpost::destroy($id);
        return redirect('/posts')->with('status_success', 'Post deleted!');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:blogposts,title,' . $id . ',id|max:5',
            'text' => 'required',
        ]);
        $bp = \App\Models\Blogpost::find($id);
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        return ($bp->save() !== 1) ?
            redirect('/posts/' . $id)->with('status_success', 'Post updated!') :
            redirect('/posts/' . $id)->with('status_error', 'Post was not updated!');
    }

    public function storePostComment($id, Request $request)
    {
        $this->validate($request, ['text' => 'required']);
        $bp = \App\Models\Blogpost::find($id);
        $cm = new \App\Models\Comment();
        $cm->text = $request['text'];
        $bp->comments()->save($cm); // priskiriame naują komentarą blogpostui
        return redirect()->back()->with('status_success', 'Comment added!');
    }
}
