<?php

namespace App\Http\Controllers\front;

use App\Events\ContactMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SebetRequest;
use App\Http\Requests\SignRequest;
use App\Models\About;
use App\Models\Category;
use App\Models\Contact;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends Controller
{
    public function index()
    {
        return view('front.pages.home',[
            'banners'=>HomeBanner::all(),
            'content_categories'=>Category::where('on_home',1)->get(),
        ]);
    }

    public function about()
    {
        return view('front.pages.about',[
            'about'=>About::firstOrFail(),
            'reviews'=>Review::latest()->get()
        ]);
    }

    public function contact()
    {
        return view('front.pages.contact');
    }

    public function contactPost(ContactRequest $request)
    {
        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'ip'=>$request->ip()
        ]);

        event(new ContactMessage($contact));

        return \response()->json([
            'message' => __('static.contact_success'),
        ],Response::HTTP_OK);
    }

    public function products($category_slug)
    {
        $category = Category::where('slug_az',$category_slug)
            ->orWhere('slug_en',$category_slug)
            ->orWhere('slug_ru',$category_slug)
            ->firstOrFail();

        return view('front.pages.products',[
            'products'=>Product::with('images')->where('category_id',$category->id)->get(),
            'categories'=>Category::with('products')->get()
        ]);
    }

    public function productsDetails($category_slug,$product_slug)
    {
        $category = Category::where('slug_az',$category_slug)
            ->orWhere('slug_en',$category_slug)
            ->orWhere('slug_ru',$category_slug)
            ->firstOrFail();

        $product    = Product::with('images','category')->where('category_id',$category->id)->where('slug_az',$product_slug)
            ->orWhere('slug_en',$product_slug)
            ->orWhere('slug_ru',$product_slug)
            ->firstOrFail();

        $other_products = Product::with('images','category')
            ->where('category_id',$category->id)
            ->where('id','!=',$product->id)
            ->get();

        return view('front.pages.product-details', compact('category','product','other_products'));
    }

    public function productDetailsModal()
    {
        $product = Product::with('category','images')->findOrFail(\request()->id);

        $output['id']               = $product->id;
        $output['ad']               = $product->{'name_'.app()->getLocale()};
        $output['qiymet']           = $product->price;
        $output['kateqoriya']       = $product->category->{'name_'.app()->getLocale()};
        $output['kateqoriya_link']  = route('front.products',['category_slug'=>$product->category->{'slug_'.app()->getLocale()}]);
        $output['sekiller']         = array_map(function ($row){
            return $row['src'];
        },$product->images->toArray());
        return \response()->json($output,200);
    }

    public function sebet(SebetRequest $request)
    {
        $sebet                  = unserialize(Cookie::get('sebet'));
        $sebet[$request->id]    = $request->count;

        return response()->json([
            'products'=>$sebet,
            'count'=>count($sebet),
            'message'=>__('static.mehsul_sebete_elave_edildi')
        ], 200)->withCookie(Cookie::forever('sebet', serialize($sebet)));
    }

    public function call_sebet()
    {
        $sebet      = unserialize(Cookie::get('sebet'));
        $products   = Product::with('category','images')->whereIn('id',array_keys($sebet))->get();
        $output     = '';
        $output2    = '';
        $total      = 0;
        if ($products->count() > 0)
        {
            if (\request()->has('action') && \request()->action == 2)
            {
                foreach ($products as $product)
                {
                    $total += $sebet[$product->id] * $product->price;
                    $output .= '
                    <tr>
                        <td class="thumbnail"><a href="'.route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]).'"><img src="'.($product->images->count() > 0 ? asset('files/products/'.$product->images[0]->src) : '').'" alt="'.$product->{'name_'.app()->getLocale()}.'"></a></td>
                        <td class="name"> <a href="'.route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]).'">'.$product->{'name_'.app()->getLocale()}.'</a></td>
                        <td class="price"><span>£'.$product->price.'</span></td>
                        <td class="quantity">
                            <div class="product-quantity">
                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                <input type="number" class="input-qty" value="'.$sebet[$product->id].'" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*?)\..*/g, \'$1\');"   onkeypress="return isNumberKey(event);" onkeydown="this.value.trim() == \'\' ? (this.value = 1) : (this.value = this.value) " onchange="sebet_main('.$product->id.',this.value.trim());">
                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                            </div>
                        </td>
                        <td class="subtotal"><span>$'.($sebet[$product->id] * $product->price).'</span></td>
                        <td class="remove"><a href="javascript:void(0)" class="remove product-removal" data-id="'.$product->id.'">×</a></td>
                    </tr>
                    ';

                    $output2 .= '
                        <tr>
                            <td class="name">'.$product->{'name_'.app()->getLocale()}.'&nbsp; <strong class="quantity">×&nbsp;'.$sebet[$product->id].'</strong></td>
                            <td class="total"><span>'.($sebet[$product->id] * $product->price).' &#8380;</span></td>
                        </tr>
                    ';
                }
            }
            else
            {
                foreach ($products as $product)
                {
                    $total += $sebet[$product->id] * $product->price;
                    $output .= '
            <li>
                <a href="'.route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]).'" class="image"><img src="'.($product->images->count() > 0 ? asset('files/products/'.$product->images[0]->src) : '').'" alt="'.$product->{'name_'.app()->getLocale()}.'"></a>
                <div class="content">
                    <a href="'.route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]).'" class="title">'.$product->{'name_'.app()->getLocale()}.'</a>
                    <span class="quantity-price">'.$sebet[$product->id].' x <span class="amount">$'.$product->price.'</span></span>
                    <div class="product-quantity">
                        <input type="number" value="'.$sebet[$product->id].'" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*?)\..*/g, \'$1\');"   onkeypress="return isNumberKey(event);" onkeydown="this.value.trim() == \'\' ? (this.value = 1) : (this.value = this.value) " onchange="sebet_main('.$product->id.',this.value.trim())"/>
                    </div>
                    <a href="javascript:void(0)" class="remove product-removal" data-id="'.$product->id.'">×</a>
                </div>
            </li>
            ';
                }
            }
        }

        return \response()->json([
            'output'=>$output,
            'output2'=>$output2,
            'total'=>$total
        ],200);
    }

    public function productRemoval(Request $request)
    {
        $this->validate($request,[
           'id'=>'required|exists:products,id'
        ]);
        $sebet      = unserialize(Cookie::get('sebet'));
        unset($sebet[$request->id]);

        return \response([
            'message'=>'Deleted',
            'totalCount'=>count($sebet)
        ],200)->withCookie(Cookie::forever('sebet', serialize($sebet)));
    }

    public function shoppingCart()
    {
        return view('front.pages.shopping-cart');
    }

    public function login()
    {
        return view('front.pages.login');
    }

    public function loginPost(SignRequest $request)
    {
        if (request()->action == 'registration')
        {
            $user = User::create([
                'email'=>$request->registerEmail,
                'password'=>bcrypt($request->registerPassword)
            ]);

            auth()->loginUsingId($user->id, true);
            return \response()->json([
                'message'=>__('login.welcome'),
                'url'=>route('front.home')
            ], 200);
        }
        else
        {
            if (auth()->attempt(['email'=>$request->loginEmail,'password'=>$request->loginPassword]))
            {
                return \response()->json([
                    'message'=>__('login.welcome'),
                    'url'=>auth()->user()->role_id ? route('back.dashboard') : route('front.home')
                ], 200);
            }
            else
            {
                return \response()->json(__('login.email_ve_ya_sifre'), 403);
            }
        }
    }

    public function logout ( Request $request )
    {
        auth()->logout();

        return redirect()->route( 'login' );
    }
}
