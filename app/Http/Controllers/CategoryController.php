<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCat()
    {
// ? ORM
        $data = [
            'categories' => Category::latest()->paginate(5),
            'title' => 'Categories',
            // ? Trash Categories
            'trashCat' => Category::onlyTrashed()->latest()->paginate(3),
        ];

        // $categories = Category::latest()->paginate();
        // $title = "Categories";
// ? Query Builder
        // $categories = DB::table('categories')->latest()->paginate(5);

        // ? Join Query
        // $data = [
        //     'categories' => DB::table('categories')
        //                     ->join('users', 'categories.user_id', 'users.id')
        //                     ->select('categories.*', 'users.name')
        //                     ->latest()
        //                     ->paginate(5),
        //     'title' => 'Categories',
        // ];



        return view('admin.category.index', $data);
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
            'category_name' => 'required|unique:categories|min:3|regex:/^[a-zA-Z0-9 _]*$/',
        ],
            [
                'category_name.required' => 'Please input category name',
                'category_name.min'      => 'Category name length less than :min characters.',
                'category_name.regex'    => 'Must contain alphabet and numeric only',
            ]
        );

        // ! ORM Model
        // Category::insert([
        //     // * 'database_table_column_name' => name in the field input and etc.
        //     'user_id'       => Auth::user()->id,
        //     'category_name' => $request->category_name,
        //     'created_at'    => Carbon::now(),
        // ]);
        // ? OR

        // $category                = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id       = Auth::user()->id;
        // $category->save();

        // ! Query Builder
        $data = array(
            [
                'category_name' => $request->category_name,
                'user_id'       => Auth::user()->id,
                'created_at'    => Carbon::now(),
            ],
        );
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category has been added successfully');
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
        $data = [
            // & ORM
            // 'categories' => Category::find($id),
            // & Query
            'categories' => DB::table('categories')->where('id',$id)->first(),
            'title' => 'Edit Category',
        ];
        return view('admin.category.edit',$data);
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
        // & ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);

        // & Query

        $data = [
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ];
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDelete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Deleted Successfully');
    }

    public function restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restored Successfully');
    }

    public function destroyPermanent($id){
        $permDelete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category Deleted Permanently');
    }
}
