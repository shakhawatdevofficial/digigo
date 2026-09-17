<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials and section settings.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $testimonials = Testimonial::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalTestimonials = Testimonial::count();
        $activeTestimonials = Testimonial::where('status', true)->count();
        $inactiveTestimonials = Testimonial::where('status', false)->count();

        return view('admin.testimonials.index', compact(
            'testimonials',
            'totalTestimonials',
            'activeTestimonials',
            'inactiveTestimonials',
            'search'
        ));
    }

    /**
     * Update Testimonials Section Settings (Badge, Title, Subtitle, Section Enabled Status).
     */
    public function updateSection(Request $request)
    {
        $request->validate([
            'testimonials_badge' => ['nullable', 'string', 'max:255'],
            'testimonials_title' => ['nullable', 'string', 'max:255'],
            'testimonials_description' => ['nullable', 'string', 'max:1000'],
        ]);

        Setting::set('testimonials_status', $request->has('testimonials_status') ? '1' : '0');
        Setting::set('testimonials_badge', $request->testimonials_badge);
        Setting::set('testimonials_title', $request->testimonials_title);
        Setting::set('testimonials_description', $request->testimonials_description);

        return redirect()->back()->with('success', 'Testimonial section settings updated successfully!');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:2000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'status' => ['nullable'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'testimonial_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/testimonials');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $validated['avatar'] = '/uploads/testimonials/'.$filename;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:2000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'status' => ['nullable'],
        ]);

        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'testimonial_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/testimonials');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($testimonial->avatar && file_exists(public_path($testimonial->avatar))) {
                @unlink(public_path($testimonial->avatar));
            }

            $file->move($destinationPath, $filename);
            $validated['avatar'] = '/uploads/testimonials/'.$filename;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar && file_exists(public_path($testimonial->avatar))) {
            @unlink(public_path($testimonial->avatar));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    /**
     * Toggle testimonial active status.
     */
    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->update([
            'status' => ! $testimonial->status,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial status updated successfully!');
    }
}
