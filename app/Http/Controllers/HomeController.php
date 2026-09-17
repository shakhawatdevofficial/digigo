<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)->orderBy('name')->get();

        $products = Product::where('status', true)
            ->where(function ($query) {
                $query->whereNull('category_id')
                    ->orWhereHas('category', function ($q) {
                        $q->where('status', true);
                    });
            })
            ->with('category')
            ->latest()
            ->get();

        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->get();

        $faqs = Faq::where('status', true)
            ->orderBy('order', 'asc')
            ->latest('id')
            ->get();

        return view('homepage', compact('categories', 'products', 'testimonials', 'faqs'));
    }

    public function productDetails(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', true)
            ->where(function ($query) {
                $query->whereNull('category_id')
                    ->orWhereHas('category', function ($q) {
                        $q->where('status', true);
                    });
            })
            ->with('category')
            ->firstOrFail();

        $relatedProducts = Product::where('status', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, function ($q) use ($product) {
                $q->where('category_id', $product->category_id);
            })
            ->where(function ($query) {
                $query->whereNull('category_id')
                    ->orWhereHas('category', function ($q) {
                        $q->where('status', true);
                    });
            })
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('product_details', compact('product', 'relatedProducts'));
    }

    public function contact(ContactRequest $request)
    {
        $validatedData = $request->validated();
        Contact::create($validatedData);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.')->withFragment('contact');
    }

    public function unsubscribe(?string $email = null)
    {
        return view('unsubscribe', ['email' => $email]);
    }

    public function terms()
    {
        return redirect()->route('home')->withFragment('faq');
    }

    public function privacy()
    {
        return redirect()->route('home')->withFragment('faq');
    }

    /**
     * Search products with filtering, category selection and sorting.
     */
    public function search(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $categorySlug = $request->query('category');
        $sort = $request->query('sort', 'latest');

        $products = Product::where('status', true)
            ->where(function ($queryBuilder) {
                $queryBuilder->whereNull('category_id')
                    ->orWhereHas('category', function ($q) {
                        $q->where('status', true);
                    });
            })
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('name', 'like', "%{$query}%")
                        ->orWhere('short_description', 'like', "%{$query}%")
                        ->orWhere('badge', 'like', "%{$query}%")
                        ->orWhere('product_description', 'like', "%{$query}%")
                        ->orWhereHas('category', function ($catQuery) use ($query) {
                            $catQuery->where('name', 'like', "%{$query}%");
                        });
                });
            })
            ->when($categorySlug, function ($q) use ($categorySlug) {
                $q->whereHas('category', function ($catQuery) use ($categorySlug) {
                    $catQuery->where('slug', $categorySlug);
                });
            })
            ->when($sort === 'price_low', function ($q) {
                $q->orderBy('price', 'asc');
            })
            ->when($sort === 'price_high', function ($q) {
                $q->orderBy('price', 'desc');
            })
            ->when($sort === 'name_asc', function ($q) {
                $q->orderBy('name', 'asc');
            })
            ->when(! in_array($sort, ['price_low', 'price_high', 'name_asc']), function ($q) {
                $q->latest();
            })
            ->with('category')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', true)
            ->withCount(['products' => function ($q) {
                $q->where('status', true);
            }])
            ->orderBy('name')
            ->get();

        return view('search', compact('products', 'categories', 'query', 'categorySlug', 'sort'));
    }

    /**
     * Return JSON search suggestions for available products.
     */
    public function searchSuggestions(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        if (empty($query)) {
            return response()->json([
                'results' => [],
                'total' => 0,
            ]);
        }

        $products = Product::where('status', true)
            ->where(function ($queryBuilder) {
                $queryBuilder->whereNull('category_id')
                    ->orWhereHas('category', function ($q) {
                        $q->where('status', true);
                    });
            })
            ->where(function ($sub) use ($query) {
                $sub->where('name', 'like', "%{$query}%")
                    ->orWhere('short_description', 'like', "%{$query}%")
                    ->orWhere('badge', 'like', "%{$query}%")
                    ->orWhereHas('category', function ($catQuery) use ($query) {
                        $catQuery->where('name', 'like', "%{$query}%");
                    });
            })
            ->with('category')
            ->take(8)
            ->get();

        $results = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => number_format($product->price, 0),
                'old_price' => $product->old_price ? number_format($product->old_price, 0) : null,
                'badge' => $product->badge,
                'category' => $product->category ? $product->category->name : null,
                'image' => $product->product_image ? asset($product->product_image) : null,
                'url' => route('product.details', $product->slug),
            ];
        });

        return response()->json([
            'results' => $results,
            'total' => $results->count(),
        ]);
    }
}
