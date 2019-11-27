<?php

namespace Neologicx\Photogallery\Http\Controllers;

use Neologicx\Photogallery\Models\Image;
use Illuminate\Http\Request;
use Neologicx\Photogallery\Http\Requests\Imagev;
use Neologicx\Photogallery\Models\Category;

use App\Http\Controllers\Controller;
class ImageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Image::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat=Category::all();
        return view('gallery::imagecreate')->with('cat',$cat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Imagev $request)
    {
        $images=$request->file('images');
        foreach ($images as $key => $image) {
           $img = $image->store('/public/images');
           Image::create(array_merge($request->except('_csrf'),['image'=>$img]));
        }
        return redirect('/category')->with('msg', 'Image added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image=Image::find($id);
        $cat=Category::all();
        return view('gallery::editimage')->with('image',$image)->with('cat',$cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $image)
    {
        $image = Image::find($image);
        if($request->hasFile('image')){
            $img=$request->file('image')->store('/public/images');
            $image->update(array_merge($request->except('_csrf', '_method'), ['image'=>$img]));
        }
        else{
            $image->update($request->except('_csrf', '_method'));
        }
        return redirect('/category')->with('msg', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($image)
    {
        $image = Image::find($image);
        $image->delete();
        return redirect()->back()->with('msg', 'Image deleted successfully.');
    }
}
