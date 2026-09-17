<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::where('status', true)->orderBy('name')->get();
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', true)->count();
        $inactiveProducts = Product::where('status', false)->count();

        return view('admin.products.index', compact('products', 'categories', 'totalProducts', 'activeProducts', 'inactiveProducts', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable'],
            'badge' => ['nullable', 'string', 'max:50'],
            'product_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'product_description' => ['nullable', 'string'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = 'prod_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/products');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $validated['product_image'] = '/uploads/products/'.$filename;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', true)->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable'],
            'badge' => ['nullable', 'string', 'max:50'],
            'product_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'product_description' => ['nullable', 'string'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = 'prod_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/products');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Remove previous image if exists
            if ($product->product_image && file_exists(public_path($product->product_image))) {
                @unlink(public_path($product->product_image));
            }

            $file->move($destinationPath, $filename);
            $validated['product_image'] = '/uploads/products/'.$filename;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->product_image && file_exists(public_path($product->product_image))) {
            @unlink(public_path($product->product_image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function toggleStatus(Product $product)
    {
        $product->update([
            'status' => ! $product->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product status updated successfully!');
    }
}
