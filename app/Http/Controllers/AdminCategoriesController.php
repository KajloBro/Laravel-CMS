<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Http\Requests\CategoriesRequest;

class AdminCategoriesController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        
        return view('admin.categories.index', compact('categories'));
    }

    
    public function store(CategoriesRequest $request)
    {
        Category::create($request->all());
        
        return redirect('/admin/categories');
    }

    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        return view('admin.categories.edit', compact('category'));
    }

    
    public function update(CategoriesRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);
        $category->update($input);

        return redirect('/admin/categories');
    }

    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect('/admin/categories');
    }
}
