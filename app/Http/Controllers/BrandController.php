<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'title'  => 'All Brand',
            'brands' => Brand::latest()->paginate(5),
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
            'brand_name'  => 'required|unique:brands|min:4|regex:/^[a-zA-Z0-9 _]*$/',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'brand_name.required'  => 'Please input brand name',
            'brand_name.min'       => 'Brands name length minimum 4 characters.',
            'brand_name.regex'     => 'Must contain alphabet and numeric only',
            'brand_image.required' => 'Please input brand image',
            'brand_image.mimes'    => 'File allowed only jpg, jpeg, and png',
        ]);

        $brand_image = $request->file('brand_image');
        // & make generate name so the file name is unique
        $name_generate = hexdec(uniqid());
        // & take extension from brand image
        $img_ext     = strtolower($brand_image->getClientOriginalExtension());
        $img_name    = $name_generate . '.' . $img_ext;
        $upload_path = 'assets/img/brand/';
        $last_img    = $upload_path . $img_name;
        $brand_image->move($upload_path, $img_name);

        Brand::insert([
            'brand_name'  => $request->brand_name,
            'brand_image' => $last_img,
            'created_at'  => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand has been added successfully');
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
        //
    }
}
