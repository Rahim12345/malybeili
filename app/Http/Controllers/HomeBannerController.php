<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use App\Rules\BannerTextRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.pages.home.index-banner',[
            'banners'=>HomeBanner::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.home.create-banner',[
            'banners'=>HomeBanner::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'banner'=>'required|mimes:jpg,jpeg,webp,png|max:2048',
            'text'=>['required','max:255',new BannerTextRule()]
        ],[],[
            'banner'=>'Banner',
            'text'=>'Text'
        ]);

        $file       = $request->banner;
        $new_name   = $file->hashName();
        $file->move(public_path('files/home/'),$new_name);

        HomeBanner::create([
           'src'=>$new_name,
            'text'=>$request->text
        ]);

        toastSuccess('Data əlavə edildi');

        return redirect()->route('home-banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function show(HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeBanner $homeBanner)
    {
        return view('back.pages.home.edit-banner',[
            'banner'=>$homeBanner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeBanner $homeBanner)
    {
        $this->validate($request,[
            'banner'=>'nullable|mimes:jpg,jpeg,webp,png|max:2048',
            'text'=>['required','max:255',new BannerTextRule()]
        ],[],[
            'banner'=>'Banner',
            'text'=>'Text'
        ]);

        $new_name = $homeBanner->src;
        if ($request->hasFile('banner'))
        {
            if (File::exists('files/home/'.$new_name))
            {
                File::delete('files/home/'.$new_name);
            }

            $file       = $request->banner;
            $new_name   = $file->hashName();
            $file->move(public_path('files/home/'),$new_name);
        }
        $homeBanner->update([
            'src'=>$new_name,
            'text'=>$request->text
        ]);

        toastSuccess('Data redaktə edildi');

        return redirect()->route('home-banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeBanner  $homeBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeBanner $homeBanner)
    {
        if (File::exists('files/home/'.$homeBanner->src))
        {
            File::delete('files/home/'.$homeBanner->src);
        }
        $homeBanner->delete();
        toastSuccess('Data silindi');
        return back();
    }
}
