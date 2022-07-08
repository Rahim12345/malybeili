<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Traits\FileUploader;

class ReviewController extends Controller
{
    use FileUploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.pages.review.index',[
            'reviews'=>Review::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $src = $this->fileSave('files/reviews/',$request->foto);
        $name   = explode('***',$request->name);
        $review = explode('***',$request->review);
        Review::create([
            'src'=>$src,
            'name_az'=>$name[0],
            'name_en'=>$name[1],
            'name_ru'=>$name[2],
            'review_az'=>$review[0],
            'review_en'=>$review[1],
            'review_ru' =>$review[2],
        ]);

        toastSuccess('Data əlavə edildi');
        return redirect()->route('review.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('back.pages.review.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $row    = $review;
        $src    = $this->fileUpdate($review->src, $request->hasFile('foto'), $request->foto, 'files/reviews/');
        $name   = explode('***',$request->name);
        $review = explode('***',$request->review);
        $row->update([
            'src'=>$src,
            'name_az'=>$name[0],
            'name_en'=>$name[1],
            'name_ru'=>$name[2],
            'review_az'=>$review[0],
            'review_en'=>$review[1],
            'review_ru' =>$review[2],
        ]);

        toastSuccess('Data redaktə edildi');
        return redirect()->route('review.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $this->fileDelete('files/reviews/'.$review->src);

        $review->delete();
        toastSuccess('Data silindi');
        return back();
    }
}
