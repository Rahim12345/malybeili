<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $about = About::first();
        return view('back.pages.about.create-about', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAboutRequest $request)
    {
        $about = About::first();

        if ($request->action == 'update')
        {
            $new_name   = $about->src;
            if ($request->hasFile('foto'))
            {
                if (File::exists(public_path('files/about/'.$about->src)))
                {
                    File::delete(public_path('files/about/'.$about->src));
                }

                $file = $request->foto;
                $new_name   = $file->hashName();
                $file->move(public_path('files/about'), $new_name);
            }

            $about_text = explode('***',$request->text);
            $about->update([
                'src'=>$new_name,
                'about_az'=>$about_text[0],
                'about_en'=>$about_text[1],
                'about_ru'=>$about_text[2]
            ]);
        }
        else
        {
            $file = $request->foto;
            $new_name   = $file->hashName();
            $file->move(public_path('files/about'), $new_name);

            $about_text = explode('***',$request->text);
            About::create([
                'src'=>$new_name,
                'about_az'=>$about_text[0],
                'about_en'=>$about_text[1],
                'about_ru'=>$about_text[2]
            ]);
        }



        toastSuccess('Data əlavə edildi');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAboutRequest  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
