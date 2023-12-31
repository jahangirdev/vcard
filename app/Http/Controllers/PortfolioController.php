<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use App\Models\Portfolios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolios::all();
        return view('dashboard.index-portfolio', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PortfolioCategory::all();
        return view("dashboard.create-portfolio", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:portfolios',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width:1000,max_height=1000',
            'category' => 'required|integer',
            'description' => 'string',
            'user_id' => 'required',
            'link' => 'string'
        ]);
        $thumbnail = $request->file("thumbnail");
        $path = "public/image/";
        $name = strtolower($request->slug.uniqid("", true).".".$thumbnail->getClientOriginalExtension());
        if($thumbnail->move($path, $name)){
            $portfolio = new Portfolios([
                'title' => $request->title,
                'slug' => $request->slug,
                'category' => $request->category,
                'description' => $request->description,
                'thumbnail' => $path.$name,
                'user_id' => $request->user_id,
                'link' => $request->link
            ]);
            $portfolio->save();
            return redirect()->route('portfolio.index')->with('notice', ['message' => 'Portfolio created Successfully!', 'type' => 'success']);
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
        $portfolio = Portfolios::find($id);
        $categories = PortfolioCategory::all();
        return view('dashboard.edit-portfolio', compact('portfolio', 'categories'));
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
        $request->validate([
            'title' => 'required|string|max:255|',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:portfolios,slug,'.$id,
            'thumbnail' => $request->file('thumbnail') !== null ? 'image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width:1000,max_height=1000':"",
            'category' => 'required|integer',
            'description' => 'string',
            'link' => 'string'
        ]);
        if($request->file('thumbnail') != null){
            $thumbnail = $request->file("thumbnail");
            $path = "public/image/";
            $name = strtolower($request->slug.uniqid("", true).".".$thumbnail->getClientOriginalExtension());
            if($thumbnail->move($path, $name)) {
                $portfolio = Portfolios::find($id);
                $prevFile = $portfolio->thumbnail;
                $portfolio->title = $request->title;
                $portfolio->slug = $request->slug;
                $portfolio->category = $request->category;
                $portfolio->description = $request->description;
                $portfolio->thumbnail = $path . $name;
                $portfolio->link = $request->link;
                $portfolio->save();

                //delete the previous file
                $fileToDelete = public_path('../'.$prevFile);
                if (File::exists($fileToDelete)){
                    File::delete($fileToDelete);
                }
                return redirect()->route('portfolio.index')->with('notice', ['message' => 'Portfolio updated Successfully!', 'type' => 'success']);
            }
        }
        else{
            $portfolio = Portfolios::find($id);
            $portfolio->title = $request->title;
            $portfolio->slug = $request->slug;
            $portfolio->category = $request->category;
            $portfolio->description = $request->description;
            $portfolio->link = $request->link;
            $portfolio->save();
            return redirect()->route('portfolio.index')->with('notice', ['message' => 'Portfolio updated Successfully!', 'type' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Portfolios::destroy($id);
        return redirect()->route('portfolio.index')->with('notice', ['type' => 'warning', 'message' => 'Portfolio deleted successfully!']);
    }
}
