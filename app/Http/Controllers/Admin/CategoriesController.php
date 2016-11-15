<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use Exception;
use DB;
use Log;
use Storage;

class CategoriesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewData['title'] = trans('category.category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->viewData['categories'] = Category::paginate(config('category.limit.list_in_admin'));
        
        return view('admin.category.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {   
        DB::beginTransaction();
        try {
            //Retrieve photo URL
            $photoUrl = $request->file('photo')->store(config('fels.upload-path'));

            //Assign Model
            $category = new Category;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->photo = $photoUrl;
            $category->save();

            //Commit to DB
            DB::commit();

            return redirect('admin/category')->with('status', trans('category.create.success'));
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            
            return back()->withErrors(trans('category.create.failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //If inexistent redirect 404
        $this->viewData['category'] = Category::findOrFail($id);

        return view('admin.category.detail', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->viewData['category'] = Category::findOrFail($id);

        return view('admin.category.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {   
        $category = Category::findOrFail($id);

        if ($request->has('name')) {
            $category->name = $request->name;
        }

        if ($request->has('description')) {
            $category->description = $request->description;
        }

        //Update photo if admin upload photo
        if ($request->hasFile('photo')) {
            //Retrieve new photo URL
            $photoUrl = $request->file('photo')->store(config('fels.upload-path'));

            //Delete old photo
            Storage::delete($category->photo);

            //Save new photo URL
            $category->photo = $photoUrl;
        }

        if ($category->save()) {
            return back()->withSuccess(trans('category.update.success'));
        }

        return back()->withErrors(trans('category.update.failed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //If inexist redirect 404
        $category = Category::findOrFail($id);

        //Delete an unempty category
        if (count($category->words()->get())) {
            return back()->withErrors(trans('category.delete.unempty-category'));
        }

        $category->delete();

        return redirect()->action('Admin\CategoriesController@index')->withSuccess(trans('category.delete.success'));
    }
}
