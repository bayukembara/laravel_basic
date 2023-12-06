<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        ], [
            'brand_name.required' => 'Please input brand name',
            'brand_name.min' => 'Brand name length need more than 3 characters',
            'brand_name.regex' => 'Must contain alphabet and numeric only',
            'brand_image.required' => 'Please input the image brand',
            'brand_image.mimes' => 'Only png and jpg is allowed',
        ]);

        // ? Make request
        $brand_image_req = $request->file('brand_image');
        // // ? rename image
        // $name_gen = hexdec(uniqid());
        // // ? make it lowercase
        // $img_ext = strtolower($brand_image_req->getClientOriginalExtension());
        // // ? mix name and extension
        // $img_name = $name_gen . '.' . $img_ext;
        // // ? initialize path for upload
        // $up_location = 'assets/image/brand/';
        // // ? final product of path and image name with extension
        // $last_img = $up_location . $img_name;
        // // ? move the image to the folder destination
        // $brand_image_req->move($up_location, $img_name);

        $name_gen = hexdec(uniqid()) . '.' . $brand_image_req->getClientOriginalExtension();
        Image::make($brand_image_req)->resize(300, 200)->save('assets/image/brand/' . $name_gen);

        $last_img = 'assets/image/brand/' . $name_gen;
        $data = [
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ];

        // dd($data);

        DB::table('brands')->insert($data);
        return Redirect()->back()->with('success', 'Brand Name has been added successfully');
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
    public function edit(Brand $brand, $id)
    {
        $data = [
            'brands' => DB::table('brands')->where('id', $id)->first(),
            'title' => 'Edit Brand',
        ];

        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand, $id)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|min:3|regex:/^[a-zA-Z0-9 _]*$/',
            'brand_image' => 'mimes:png,jpg',
        ], [
            'brand_name.required' => 'Please input brand name',
            'brand_name.min' => 'Brand name length need more than 3 characters',
            'brand_name.regex' => 'Must contain alphabet and numeric only',
            'brand_image.required' => 'Please input the image brand',
            'brand_image.mimes' => 'Only png and jpg is allowed',
        ]);

        // ? Make request
        $old_image = $request->old_image;
        $brand_image_req = $request->file('brand_image');

        if ($brand_image_req) {
            // ? rename image
            $name_gen = hexdec(uniqid());
            // ? make it lowercase
            $img_ext = strtolower($brand_image_req->getClientOriginalExtension());
            // ? mix name and extension
            $img_name = $name_gen . '.' . $img_ext;
            // ? initialize path for upload
            $up_location = 'assets/image/brand/';
            // ? final product of path and image name with extension
            $last_img = $up_location . $img_name;
            // ? move the image to the folder destination
            $brand_image_req->move($up_location, $img_name);



            unlink($old_image);
            $data = [
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ];

            // dd($data);

            DB::table('brands')->where('id', $id)->update($data);
            return Redirect()->route('all.brand')->with('success', 'Brand Name has been edited successfully');
        } else {
            $data = [
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ];

            // dd($data);

            DB::table('brands')->where('id', $id)->update($data);
            return Redirect()->route('all.brand')->with('success', 'Brand Name has been edited successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, $id)
    {

        // ? find image
        $image = Brand::find($id);
        $brand_image = $image->brand_image;
        unlink($brand_image);

        $delete = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }
}
