<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function create() {

        return view('admin.category.create');
    }

    public function store() {
        $attributes = request()->validate([
            'name' => ['required', Rule::unique('categories', 'name'), 'max:30'],
            'slug' => ['required', Rule::unique('categories', 'slug'), 'max:30'],
        ]);

        Category::create($attributes);
        return back()->with('success', 'Category Created!.');
    }
}
