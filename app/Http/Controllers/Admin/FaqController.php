<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs and section settings.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $faqs = Faq::query()
            ->when($search, function ($query, $search) {
                $query->where('question', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%");
            })
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $totalFaqs = Faq::count();
        $activeFaqs = Faq::where('status', true)->count();
        $inactiveFaqs = Faq::where('status', false)->count();

        return view('admin.faqs.index', compact(
            'faqs',
            'totalFaqs',
            'activeFaqs',
            'inactiveFaqs',
            'search'
        ));
    }

    /**
     * Update FAQ Section Settings (Badge, Title, Subtitle, Section Enabled Status).
     */
    public function updateSection(Request $request)
    {
        $request->validate([
            'faq_badge' => ['nullable', 'string', 'max:255'],
            'faq_title' => ['nullable', 'string', 'max:255'],
            'faq_description' => ['nullable', 'string', 'max:1000'],
        ]);

        Setting::set('faq_status', $request->has('faq_status') ? '1' : '0');
        Setting::set('faq_badge', $request->faq_badge);
        Setting::set('faq_title', $request->faq_title);
        Setting::set('faq_description', $request->faq_description);

        return redirect()->back()->with('success', 'FAQ section settings updated successfully!');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string', 'max:5000'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->has('status') ? true : false;

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string', 'max:5000'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->has('status') ? true : false;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully!');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully!');
    }

    /**
     * Toggle FAQ active status.
     */
    public function toggleStatus(Faq $faq)
    {
        $faq->update([
            'status' => ! $faq->status,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ status updated successfully!');
    }
}
