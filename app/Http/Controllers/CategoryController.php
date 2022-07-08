<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    use FileUploader;

    public function Status(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|exists:categories,id',
            'on_home'=>['required',Rule::in([0,1])]
        ]);

        $category = Category::findOrFail($request->id);
        $category->update([
            'on_home'=>$request->on_home == 0 ? 1 : 0
        ]);

        toastSuccess('Status dəyişdirildi');
        return redirect()->route('category.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.pages.category.index',[
            'categories'=>Category::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $src = $this->fileSave('files/categories/',$request->foto);

        $category_text = explode('***',$request->text);
        Category::create([
            'name_az'=>$category_text[0],
            'name_en'=>$category_text[1],
            'name_ru'=>$category_text[2],
            'slug_az'=>str_slug($category_text[0]),
            'slug_en'=>str_slug($category_text[1]),
            'slug_ru'=>str_slug($category_text[2]),
            'src'=>$src
        ]);

        toastSuccess('Data əlavə edildi');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('back.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $src   = $this->fileUpdate($category->src, $request->hasFile('foto'), $request->foto, 'files/categories/');

        $category_text = explode('***',$request->text);
        $category->update([
            'name_az'=>$category_text[0],
            'name_en'=>$category_text[1],
            'name_ru'=>$category_text[2],
            'slug_az'=>str_slug($category_text[0]),
            'slug_en'=>str_slug($category_text[1]),
            'slug_ru'=>str_slug($category_text[2]),
            'src'=>$src
        ]);

        toastSuccess('Data redaktə edildi');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->fileDelete('files/categories/'.$category->src);

        $category->delete();
        toastSuccess('Data silindi');
        return back();
    }
}
