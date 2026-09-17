<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomizationController extends Controller
{
    /**
     * Show Top Nav & Header Customization page.
     */
    public function topnav()
    {
        return view('admin.customization.topnav');
    }

    /**
     * Update Top Nav & Header Customization settings.
     */
    public function updateTopnav(Request $request)
    {
        $request->validate([
            'topbar_email' => 'nullable|string|max:255',
            'topbar_partner_text' => 'nullable|string|max:255',
            'topbar_delivery_text' => 'nullable|string|max:255',
            'topbar_support_text' => 'nullable|string|max:255',
            'navbar_btn_text' => 'nullable|string|max:255',
            'navbar_btn_link' => 'nullable|string|max:255',
        ]);

        Setting::set('topbar_status', $request->has('topbar_status') ? '1' : '0');
        Setting::set('topbar_email', $request->topbar_email);
        Setting::set('topbar_partner_text', $request->topbar_partner_text);
        Setting::set('topbar_delivery_text', $request->topbar_delivery_text);
        Setting::set('topbar_support_text', $request->topbar_support_text);
        Setting::set('navbar_btn_text', $request->navbar_btn_text);
        Setting::set('navbar_btn_link', $request->navbar_btn_link);

        return redirect()->back()->with('success', 'Top Navigation & Header updated successfully!');
    }

    /**
     * Show Banner / Hero Customization page.
     */
    public function banner()
    {
        return view('admin.customization.banner');
    }

    /**
     * Update Banner / Hero Customization settings.
     */
    public function updateBanner(Request $request)
    {
        $request->validate([
            'banner_badge' => 'nullable|string|max:255',
            'banner_title_1' => 'nullable|string|max:255',
            'banner_title_2' => 'nullable|string|max:255',
            'banner_description' => 'nullable|string|max:1000',
            'banner_search_placeholder' => 'nullable|string|max:255',
            'banner_trusted_text' => 'nullable|string|max:255',
        ]);

        Setting::set('banner_status', $request->has('banner_status') ? '1' : '0');
        Setting::set('banner_badge', $request->banner_badge);
        Setting::set('banner_title_1', $request->banner_title_1);
        Setting::set('banner_title_2', $request->banner_title_2);
        Setting::set('banner_description', $request->banner_description);
        Setting::set('banner_search_placeholder', $request->banner_search_placeholder);
        Setting::set('banner_trusted_text', $request->banner_trusted_text);

        return redirect()->back()->with('success', 'Homepage Banner section updated successfully!');
    }

    /**
     * Show CTA Customization page.
     */
    public function cta()
    {
        return view('admin.customization.cta');
    }

    /**
     * Update CTA Customization settings.
     */
    public function updateCta(Request $request)
    {
        $request->validate([
            'cta_badge' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string|max:1000',
            'cta_btn_primary_text' => 'nullable|string|max:255',
            'cta_btn_primary_link' => 'nullable|string|max:255',
            'cta_btn_secondary_text' => 'nullable|string|max:255',
            'cta_btn_secondary_link' => 'nullable|string|max:255',
        ]);

        Setting::set('cta_status', $request->has('cta_status') ? '1' : '0');
        Setting::set('cta_badge', $request->cta_badge);
        Setting::set('cta_title', $request->cta_title);
        Setting::set('cta_description', $request->cta_description);
        Setting::set('cta_btn_primary_text', $request->cta_btn_primary_text);
        Setting::set('cta_btn_primary_link', $request->cta_btn_primary_link);
        Setting::set('cta_btn_secondary_text', $request->cta_btn_secondary_text);
        Setting::set('cta_btn_secondary_link', $request->cta_btn_secondary_link);

        return redirect()->back()->with('success', 'Call to Action (CTA) section updated successfully!');
    }

    /**
     * Show Footer & Logo Customization page.
     */
    public function footer()
    {
        return view('admin.customization.footer');
    }

    /**
     * Update Footer & Logo Customization settings.
     */
    public function updateFooter(Request $request)
    {
        $request->validate([
            'footer_description' => 'nullable|string|max:1000',
            'footer_facebook_url' => 'nullable|string|max:255',
            'footer_twitter_url' => 'nullable|string|max:255',
            'footer_instagram_url' => 'nullable|string|max:255',
            'footer_youtube_url' => 'nullable|string|max:255',
            'footer_whatsapp_url' => 'nullable|string|max:255',
            'footer_payment_title' => 'nullable|string|max:255',
            'footer_payment_text' => 'nullable|string|max:500',
            'footer_copyright_text' => 'nullable|string|max:255',
            'footer_partner_text' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'footer_payment_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        Setting::set('footer_status', $request->has('footer_status') ? '1' : '0');
        Setting::set('footer_description', $request->footer_description);
        Setting::set('footer_facebook_url', $request->footer_facebook_url);
        Setting::set('footer_twitter_url', $request->footer_twitter_url);
        Setting::set('footer_instagram_url', $request->footer_instagram_url);
        Setting::set('footer_youtube_url', $request->footer_youtube_url);
        Setting::set('footer_whatsapp_url', $request->footer_whatsapp_url);
        Setting::set('footer_payment_title', $request->footer_payment_title);
        Setting::set('footer_payment_text', $request->footer_payment_text);
        Setting::set('footer_copyright_text', $request->footer_copyright_text);
        Setting::set('footer_partner_text', $request->footer_partner_text);

        // Upload Logo
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/settings');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $currentLogo = Setting::get('site_logo');
            if ($currentLogo && file_exists(public_path($currentLogo))) {
                @unlink(public_path($currentLogo));
            }

            $file->move($destinationPath, $filename);
            Setting::set('site_logo', '/uploads/settings/'.$filename);
        }

        // Upload Payment Methods Image
        if ($request->hasFile('footer_payment_image')) {
            $file = $request->file('footer_payment_image');
            $filename = 'payment_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/settings');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $currentPaymentImg = Setting::get('footer_payment_image');
            if ($currentPaymentImg && file_exists(public_path($currentPaymentImg))) {
                @unlink(public_path($currentPaymentImg));
            }

            $file->move($destinationPath, $filename);
            Setting::set('footer_payment_image', '/uploads/settings/'.$filename);
        }

        return redirect()->back()->with('success', 'Footer & Logo settings updated successfully!');
    }

    /**
     * Show Contact Us Customization page.
     */
    public function contact()
    {
        return view('admin.customization.contact');
    }

    /**
     * Update Contact Us Customization settings.
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_badge' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'contact_description' => 'nullable|string|max:1000',
            'contact_email_title' => 'nullable|string|max:255',
            'contact_email_subtitle' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
            'contact_whatsapp_title' => 'nullable|string|max:255',
            'contact_whatsapp_subtitle' => 'nullable|string|max:255',
            'contact_whatsapp_number' => 'nullable|string|max:255',
            'contact_whatsapp_url' => 'nullable|string|max:255',
            'contact_location_title' => 'nullable|string|max:255',
            'contact_location_address' => 'nullable|string|max:500',
            'contact_location_btn_text' => 'nullable|string|max:255',
            'contact_location_btn_link' => 'nullable|string|max:255',
        ]);

        Setting::set('contact_status', $request->has('contact_status') ? '1' : '0');
        Setting::set('contact_badge', $request->contact_badge);
        Setting::set('contact_title', $request->contact_title);
        Setting::set('contact_description', $request->contact_description);
        Setting::set('contact_email_title', $request->contact_email_title);
        Setting::set('contact_email_subtitle', $request->contact_email_subtitle);
        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_whatsapp_title', $request->contact_whatsapp_title);
        Setting::set('contact_whatsapp_subtitle', $request->contact_whatsapp_subtitle);
        Setting::set('contact_whatsapp_number', $request->contact_whatsapp_number);
        Setting::set('contact_whatsapp_url', $request->contact_whatsapp_url);
        Setting::set('contact_location_title', $request->contact_location_title);
        Setting::set('contact_location_address', $request->contact_location_address);
        Setting::set('contact_location_btn_text', $request->contact_location_btn_text);
        Setting::set('contact_location_btn_link', $request->contact_location_btn_link);

        return redirect()->back()->with('success', 'Contact Us section settings updated successfully!');
    }

    /**
     * Show Logo, Favicon & SEO Customization page.
     */
    public function seo()
    {
        return view('admin.customization.seo');
    }

    /**
     * Update Logo, Favicon & SEO settings.
     */
    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_author' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'site_favicon' => 'nullable|mimes:jpeg,png,jpg,webp,svg,ico|max:1024',
            'meta_og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        Setting::set('meta_title', $request->meta_title);
        Setting::set('meta_description', $request->meta_description);
        Setting::set('meta_keywords', $request->meta_keywords);
        Setting::set('meta_author', $request->meta_author);

        $destinationPath = public_path('uploads/settings');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Upload Site Logo
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();

            $currentLogo = Setting::get('site_logo');
            if ($currentLogo && file_exists(public_path($currentLogo))) {
                @unlink(public_path($currentLogo));
            }

            $file->move($destinationPath, $filename);
            Setting::set('site_logo', 'uploads/settings/'.$filename);
        }

        // Upload Site Favicon
        if ($request->hasFile('site_favicon')) {
            $file = $request->file('site_favicon');
            $filename = 'favicon_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();

            $currentFavicon = Setting::get('site_favicon');
            if ($currentFavicon && file_exists(public_path($currentFavicon))) {
                @unlink(public_path($currentFavicon));
            }

            $file->move($destinationPath, $filename);
            Setting::set('site_favicon', 'uploads/settings/'.$filename);
        }

        // Upload Open Graph / Social Share Image
        if ($request->hasFile('meta_og_image')) {
            $file = $request->file('meta_og_image');
            $filename = 'og_image_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();

            $currentOg = Setting::get('meta_og_image');
            if ($currentOg && file_exists(public_path($currentOg))) {
                @unlink(public_path($currentOg));
            }

            $file->move($destinationPath, $filename);
            Setting::set('meta_og_image', 'uploads/settings/'.$filename);
        }

        return redirect()->back()->with('success', 'Logo, Favicon & SEO settings updated successfully!');
    }
}
