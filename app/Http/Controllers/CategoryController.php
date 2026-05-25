<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tickets')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:2|max:100|unique:categories',
            'color' => 'required',
        ]);

        Category::create($request->only('name', 'color'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategorija sukurta!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|min:2|max:100|unique:categories,name,' . $category->id,
            'color' => 'required',
        ]);

        $category->update($request->only('name', 'color'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategorija atnaujinta!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Kategorija ištrinta.');
    }
}