<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;

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
}
