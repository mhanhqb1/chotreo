<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new Category();
        if ($request->search) {
            $data = $data->where('name', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        // if (request()->wantsJson()) {
        //     return ProductResource::collection($data);
        // }
        return view('categories.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $item = Category::create([
            'name' => $request->name,
            'slug' => createSlug($request->name)
        ]);

        if (!$item) {
            return redirect()->back()->with('error', __('Sorry, there a problem while creating item.'));
        }
        return redirect()->route('categories.index')->with('success', __('Success, your item has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with('item', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = createSlug($request->name);

        if (!$category->save()) {
            return redirect()->back()->with('error', __('Sorry, there\'re a problem while updating this item.'));
        }
        return redirect()->route('categories.index')->with('success', __('Success, Your item has been updated.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
