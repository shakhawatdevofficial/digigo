<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
}
