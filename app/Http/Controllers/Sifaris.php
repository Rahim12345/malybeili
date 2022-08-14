<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SelledProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class Sifaris extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Customer::with(['buy_products.product'])
                ->latest()
                ->get();

            return DataTables::of($data)

                ->addColumn('ad_soyad', function ($row) {
                    return $row->ad.' '.$row->soyad;
                })

                ->editColumn('kuryerle_odenis',function ($row){
                    return $row->kuryerle_odenis == 1 ? 'bəli' : 'xeyir';
                })

                ->addColumn('info', function ($row) {
                    $output = '<table style="border: 1px solid black">';
                    $output .= '<tr style="border: 1px solid black">';
                    $output .= '<td style="border: 1px solid black">Say</td>';
                    $output .= '<td style="border: 1px solid black">Şəkil</td>';
                    $output .= '<td style="border: 1px solid black">Ad</td>';
                    $output .= '<td style="border: 1px solid black">Qiymət</td>';
                    $output .= '</tr>';
                    foreach ($row->buy_products as $buy_product)
                    {
                        $image = isset($buy_product->product->images[0]) ? '<img style="width:50px;height:50px" src="'.asset('files/products/'.$buy_product->product->images[0]->src).'" alt="" />' : '';
                        $output .= '<tr style="border: 1px solid black">';
                            $output .= '<td style="border: 1px solid black">'.$buy_product->say.' </td>';
                            $output .= '<td style="border: 1px solid black">'.$image.'</td>';
                            $output .= '<td style="border: 1px solid black">('.$buy_product->product->name_az.')</td>';
                            $output .= '<td style="border: 1px solid black">'.$buy_product->cari_qiymet.'</td>';
                        $output .= '</tr>';
                    }
                    $output .= '<table>';

                    return $output;
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
                <form action="'.route('sifaris.destroy',$row->id).'" method="POST">
                '.@csrf_field().'
                '.@method_field('DELETE').'
                <button class="btn btn-danger" type="submit" onclick="return confirm(\'Silmek istədiyinizdən əminsiniz?\')"><i class="fa fa-times"></i></button>
                </form>
                </div>
                ';
                })

                ->rawColumns(['info','action'])

                ->make(true);
        }
        return view('back.pages.sifaris.index');
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
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->buy_products()->delete();
        $customer->delete();
        toastSuccess('Sifariş silindi');
        return back();
    }
}
