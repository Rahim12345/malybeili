<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductImage;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use FileUploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Product::with(['images', 'category'])->latest()
                ->get();

            return DataTables::of($data)

                ->addColumn('image', function ($row) {
                    return isset($row->images[0]) ? '<img style="width:50px;height:50px" src="'.asset('files/products/'.$row->images[0]->src).'" alt="" />' : '';
                })

                ->addColumn('status',function ($row){
                    return $row->hidden == 1 ? '<span style="cursor: pointer" class="badge bg-danger" data-id="'.$row->id.'">gizlidir</span>' : '<span style="cursor: pointer" class="badge bg-success" data-id="'.$row->id.'">görünür</span>';
                })

                ->editColumn('category',function ($row){
                    return $row->category->name_az;
                })

                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })

                ->addColumn('action',function ($row){
                    return '
                <div class="btn-list flex-nowrap">
                <a href="#" class="btn btn-bitbucket imageModal" data-bs-toggle="modal" data-bs-target="#modal-team" data-id="'.$row->id.'">
                    Ş
                  </a>
                <form action="'.route('product.destroy',$row->id).'" method="POST">
                '.@csrf_field().'
                '.@method_field('DELETE').'
                <button class="btn btn-danger" type="submit" onclick="return confirm(\'Silmek istədiyinizdən əminsiniz?\')"><i class="fa fa-times"></i></button>
                </form>
                    <a class="btn btn-primary"
                    href="'.route('product.edit',[$row->id]).'"><i class="fa fa-edit"></i></a>
                </div>
                ';
                })

                ->rawColumns(['image','action','status'])

                ->make(true);
        }
        return view('back.pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.products.create',[
            'categories'=>Category::orderBy('name_az','asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        Product::create([
            'category_id'=>$request->category_id,
            'name_az'=>$request->name_az,
            'name_en'=>$request->name_en,
            'name_ru'=>$request->name_ru,
            'slug_az'=>str_slug($request->name_az),
            'slug_en'=>str_slug($request->name_en),
            'slug_ru'=>str_slug($request->name_en),
            'about_az'=>$request->about_az,
            'about_en'=>$request->about_en,
            'about_ru'=>$request->about_ru,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'stock'=>$request->stock,
            'color_az'=>explode('***',$request->colors)[0],
            'color_en'=>explode('***',$request->colors)[1],
            'color_ru'=>explode('***',$request->colors)[2],
            'size_az'=>explode('***',$request->sizes)[0],
            'size_en'=>explode('***',$request->sizes)[1],
            'size_ru'=>explode('***',$request->sizes)[2],
        ]);

        toastSuccess('Data daxil edildi');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name_az','asc')->get();
        return view('back.pages.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            'category_id'=>$request->category_id,
            'name_az'=>$request->name_az,
            'name_en'=>$request->name_en,
            'name_ru'=>$request->name_ru,
            'slug_az'=>str_slug($request->name_az),
            'slug_en'=>str_slug($request->name_en),
            'slug_ru'=>str_slug($request->name_en),
            'about_az'=>$request->about_az,
            'about_en'=>$request->about_en,
            'about_ru'=>$request->about_ru,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'color_az'=>explode('***',$request->colors)[0],
            'color_en'=>explode('***',$request->colors)[1],
            'color_ru'=>explode('***',$request->colors)[2],
            'size_az'=>explode('***',$request->sizes)[0],
            'size_en'=>explode('***',$request->sizes)[1],
            'size_ru'=>explode('***',$request->sizes)[2],
            'stock'=>$request->stock
        ]);

        toastSuccess('Data redaktə edildi');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = $product->images;
        foreach($images as $image)
        {
            $this->fileDelete('files/products/'.$image->src);
        }

        $product->delete();
        toastSuccess('Data silindi');
        return redirect()->route('product.index');
    }

    public function Switcher(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update([
            'hidden'=>($product->hidden == 0 ? 1 : 0)
        ]);
    }

    public function photoSave(Request $request)
    {
        $this->validate($request,[
           'image'=>'required|array',
           'image.*'=>'required|image|max:2048',
            'product_id'=>'required|exists:products,id'
        ],[],[
            'product_id'=>'Məhsul',
            'image'=>'Foto',
            'image.*'=>'Foto',
        ]);

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $file)
            {
                $src = $this->fileSave('files/products/',$file);
                ProductImage::create([
                    'product_id'=>$request->product_id,
                    'src'=>$src
                ]);
            }
        }
    }

    public function oldPhotos()
    {
        $images = ProductImage::where('product_id',\request()->product_id)->get();

        return response()->json([
           'images'=>$images
        ]);
    }

    public function photoDelete()
    {
        $image = ProductImage::findOrFail(\request()->image_id);
        $this->fileDelete('files/products/'.$image->src);
        $image->delete();

        toastSuccess('Şəkil silindi');
        return back();
    }
}
