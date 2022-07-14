<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBlogPostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Models\Blogpost::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $rules = [
            'title' => 'required|unique:blogposts,title', // DĖMESIO nesuveikus: blog_posts
            'text' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            // mass assignment
            $bp = \App\Models\Blogpost::create($data);
            // $bp = new \App\Models\Blogpost($data);


            // $bp->title = $data['title'];
            // $bp->text = $data['text'];
            return ($bp->save() !== 1)
                ? response()->json(['success' => 'success'], 201)
                : response()->json(['error' => 'saving to database was not successful'], 500);
        } else {
            return $validator->errors()->all();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (\App\Models\Blogpost::destroy($id) == 1) ?
            response()->json(['success' => 'success'], 200) :
            response()->json(['error' => 'deleting from database was not successful'], 500);
    }
}
