<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Brand',
            'brand' => Brand::latest()->paginate(5),
        ];
        return view('admin.brand.index', $data);
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
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:3|regex:/^[a-zA-Z0-9 _]*$/',
            'brand_image' => 'required|mimes:png,jpg',
        ],[
            'brand_name.required'=> 'Please input brand name',
            'brand_name.min' => 'Brand name length need more than 3 characters',
            'brand_name.regex' =>'Must contain alphabet and numeric only',
            'brand_image.required'=> 'Please input the image brand',
            'brand_image.mimes' => 'Only png and jpg is allowed',
        ]);

        // ? Make request
        $brand_image_req = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image_req->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'assets/image/brand/';
        $last_img = $up_location . $img_name;
        $brand_image_req->move($up_location, $img_name);

        $data = [
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ];

        // dd($data);

        DB::table('brands')->insert($data);
        return Redirect()->back()->with('success','Brand Name has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}