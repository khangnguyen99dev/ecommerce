<?php

namespace App\Http\Controllers;

use App\Models\ImageLibrary;
use Illuminate\Http\Request;

class ImageLibraryController extends Controller
{
    protected $imageLibrary;
    public function __construct(ImageLibrary $imageLibrary)
    {      
        $this->imageLibrary = $imageLibrary;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageLibrary  $imageLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(ImageLibrary $imageLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageLibrary  $imageLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageLibrary $imageLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageLibrary  $imageLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageLibrary $imageLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageLibrary  $imageLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageLibrary $imageLibrary)
    {
        //
    }

    public function getImageByProduct($id)
    {
        $imageLibrary = $this->imageLibrary->getImageByProduct($id);
        return Response()->json(['wapper'=>$imageLibrary]);
    }
}
