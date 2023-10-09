<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioCategory;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio_category = PortfolioCategory::all();
        return view('dashboard.index-portfolio-category', compact('portfolio_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.create-portfolio-category");
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
            'name' => 'required|string|max:255',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:portfolio_categories'
        ]);
        $portfolio_category = new PortfolioCategory([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        $portfolio_category->save();
        return redirect()->route('portfolio_category.create')->with('notice', ['message' => 'Category Created Successfully!', 'type' => 'success']);
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
        $portfolio_category = PortfolioCategory::where('id', $id)->first();
        return view('dashboard.edit-portfolio-category', compact('portfolio_category'));
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
            'name' => 'required|string|max:255',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:portfolio_categories'
        ]);
        $portfolio_category = PortfolioCategory::find($id);
        $portfolio_category->name = $request->name;
        $portfolio_category->slug = $request->slug;
        $portfolio_category->save();
        return redirect()->route('portfolio_category.index')->with('notice', ['message' => 'Category updated Successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PortfolioCategory::destroy($id);
        $notice['message'] = "Category Deleted Successfully!";
        $notice['type'] = "warning";
        return redirect()->route('portfolio_category.index')->with('notice', $notice);
    }
}
