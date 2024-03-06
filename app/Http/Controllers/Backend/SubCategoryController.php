<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('category_id')) {
            $sub_categories = SubCategory::latest()->where('category_id', request('category_id'))->paginate(20);
            $category_name = Category::find(request('category_id'))->name;
        } else {
            $sub_categories = SubCategory::latest()->paginate(20);
            $category_name = NULL;
        }


        return view('backend.sub-categories.index', compact('sub_categories','category_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('backend.sub-categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        $data = $request->validated();

        $data['image'] = storage_upload($data['image'], 'sub-categories');

        SubCategory::create($data);

        return redirect()->route('sub-categories.index')->with('success', 'Successfully credated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }    

    public function getCategory(Request $request)
    {
        $category = Category::find($request->category_id);
        $type = $category->type->value;

        return response()->json($type);
    }

    public function getSubCategory(Request $request)
    {
        $sub_categories = SubCategory::where('category_id', $request->category_id)->get();

        return response()->json($sub_categories);
    }
}
