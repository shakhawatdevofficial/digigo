<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $categories = Category::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalCategories = Category::count();
        $activeCategories = Category::where('status', true)->count();
        $inactiveCategories = Category::where('status', false)->count();

        return view('admin.categories.index', compact('categories', 'totalCategories', 'activeCategories', 'inactiveCategories', 'search'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'status' => ['nullable'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'status' => ['nullable'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

    public function toggleStatus(Category $category)
    {
        $category->update([
            'status' => ! $category->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category status updated successfully!');
    }
}
