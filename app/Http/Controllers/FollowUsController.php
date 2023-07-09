<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FollowUs;
use Illuminate\Http\Request;

class FollowUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        return view('follow.index',[
            'follows' => FollowUs::all(),
            'about' => About::latest()->get(),
            'i' => $i
        ]);
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
        // dd($request);
        $validatedData = $request->validate([
            'platform' => 'required|max:255',
            'name' => 'required|max:255',
            'link' => 'required|max:255',
        ]);

        FollowUs::create($validatedData);

        return redirect('/follow-us');
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
        $validatedData = $request->validate([
            'platform' => 'required|max:255',
            'name' => 'required|max:255',
            'link' => 'required|max:255',
        ]);

        FollowUs::where('id', $request->followId)
            ->update($validatedData);

        return redirect('/follow-us');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FollowUs::destroy($id);
        return redirect('/follow-us');
    }
}
