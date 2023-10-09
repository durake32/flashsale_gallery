<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Image;

class SiteSettingController extends Controller
{
    public function index()
    {
        $site_setting = SiteSetting::find(1);

        return view('Dashboard.Admin.SiteSettings.index', compact('site_setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
  
    public function getDeliverySetting(){
        $siteSettings = SiteSetting::all();

        $site_setting = $siteSettings[0]->toArray();
      
       return view('Dashboard.Admin.SiteSettings.delivery', compact('site_setting'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'nullable|string',
            'email' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'address' => 'nullable|string',
            'post_code' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'youtube' => 'nullable|string',
            'meta_title' => 'sometimes|string',
            'meta_keywords' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
            'site_url' => 'nullable|string',
            'about' => 'nullable|string',
            'login_banner' =>  'nullable',
            'popup' =>  'nullable',
            'aplicable' =>  'nullable',
            'charge' =>  'nullable',
            'google_maps' => 'nullable|string',

        ]);

        $setting = SiteSetting::findOrFail($id);
        $setting->title = $request->input('title');
        $setting->email = $request->input('email');
        $setting->mobile_no = $request->input('mobile_no');
        $setting->address = $request->input('address');
        $setting->post_code = $request->input('post_code');
        $setting->facebook = $request->input('facebook');
        $setting->instagram = $request->input('instagram');
        $setting->twitter = $request->input('twitter');
        $setting->linkedin = $request->input('linkedin');
        $setting->whatsapp = $request->input('whatsapp');
        $setting->youtube = $request->input('youtube');
        $setting->meta_title = $request->input('meta_title');
        $setting->meta_keywords = $request->input('meta_keywords');
        $setting->meta_description = $request->input('meta_description');
        $setting->site_url = $request->input('site_url');
        $setting->aplicable = $request->input('aplicable');
        $setting->charge = $request->input('charge');
        $setting->minimum_amount = $request->input('minimum_amount');
        $setting->about = $request->input('about');
        $setting->google_maps = $request->input('google_maps');

        $setting->enable_flash_sale = $request->input('enable_flash_sale');
        $setting->sale_from = $request->input('sale_from');
        $setting->sale_to = $request->input('sale_to');
    
        if ($request->hasFile('logo')) {
            $setting['logo'] = uniqid() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move('Asset/Uploads/Logo', $setting['logo']);
        }
        
        if ($request->hasFile('login_banner')) {
            $setting['login_banner'] = uniqid() . '.' . $request->login_banner->getClientOriginalExtension();
            $request->login_banner->move('Asset/Uploads/Logo', $setting['login_banner']);
        }
            if ($request->hasFile('popup')) {
            $setting['popup'] = uniqid() . '.' . $request->popup->getClientOriginalExtension();
            $request->popup->move('Asset/Uploads/Logo', $setting['popup']);
        }
        $setting->save();


        return redirect(route('site-settings.index'))->with('success','Site Setting updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}