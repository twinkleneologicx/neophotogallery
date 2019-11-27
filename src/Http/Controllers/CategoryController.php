<?php

namespace Neologicx\Photogallery\Http\Controllers;

use Neologicx\Photogallery\Models\Category;
use Illuminate\Http\Request;
use Neologicx\Photogallery\Http\Requests\Categoryv;
use Neologicx\Photogallery\Models\Image;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
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
        $data=Category::orderBy('date', 'DESC')->paginate(10);
        return view('gallery::category')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery::createcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Categoryv $request)
    {
        // dd($request);
        $datetime = $request->date;
        $date = date(' Y-m-d H:i', strtotime($datetime));
        $image=$request->file('cover_image')->store('/public/catimages');
        Category::create(array_merge($request->except('_csrf'), ['cover_image'=>$image, 'date'=>$date]));
        return redirect('/category')->with('msg','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category= Category::find($category);
        return view('gallery::createcategory')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $category=Category::find($category);
        $datetime = $request->date;
        $date = date(' Y-m-d H:i', strtotime($datetime));
        if($request->hasFile('cover_image')){
            $image=$request->file('cover_image')->store('/public/catimages');
            $category->update(array_merge($request->except('_csrf', '_method'), ['cover_image'=>$image, 'date'=>$date]));
        }
        else{
            $category->update(array_merge($request->except('_csrf', '_method'), ['date'=>$date]));
        }
        return redirect('/category')->with('msg', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $category=Category::find($category);
        $category->delete();
        return redirect()->back()->with('msg', 'Category deleted successfully.');
    }

    public function showallimages($id){
        $data=Category::where('id', $id)->with('descimages')->first();
       return view('gallery::allimages')->with('data', $data);
    }

    
}
