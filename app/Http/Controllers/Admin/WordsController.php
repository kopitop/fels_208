<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\Category;
use App\Http\Requests\StoreWord;
use DB;
use Exception;
use App\Http\   Requests\UpdateWord;

class WordsController extends BaseController
{
    public function __construct()
    {   
        parent::__construct();
        $this->viewData['title'] = trans('word.word');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['words'] = Word::with('category')->paginate(config('fels.limit.list_in_admin'));
        
        return view('admin.word.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->viewData['categories'] = Category::all();

        return view('admin.word.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWord $request)
    {   
        DB::beginTransaction();
        try {
            $word = new Word;
            $word->content = $request->content;
            $word->category_id = $request->category_id;
            $word->save();

            foreach ($request->answer as $key => $value) {
                $word->answers()->create([
                    'content' => $value,
                    'is_correct' => isset($request->is_correct[$key]) ? 1 : 0,
                ]);
            }

            DB::commit();

            return redirect()->action('Admin\WordsController@index')->with('status', trans('word.create.success'));

        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            
            return back()->withErrors(trans('word.create.failed'));
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
        $word = Word::findOrFail($id);

        //Assign to view data
        $this->viewData['word'] = $word;
        $this->viewData['answers'] = $word->answers()->get();

        return view('admin.word.detail', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $word = Word::findOrFail($id);

        $this->viewData['categories'] = Category::all();
        $this->viewData['answers'] = $word->answers;
        $this->viewData['word'] = $word;

        return view('admin.word.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWord $request, $id)
    {
        DB::beginTransaction();
        try {
            $word = Word::findOrFail($id);

            if ($request->has('content')) {
                $word->content = $request->content;
            }

            if ($request->has('category_id')) {
                $word->category_id = $request->category_id;
            }

            if (!$word->save()) {
                throw new Exception('Can not save word');
            }

            if( !$word->answers()->delete()) {
                throw new Exception('Can not delete old answers');
            }
     
            foreach ($request->answer as $key => $value) {
                $word->answers()->create([
                    'content' => $value,
                    'is_correct' => isset($request->is_correct[$key]) ? 1 : 0,
                ]);
            }

            DB::commit();

            return redirect()->action('Admin\WordsController@index')->with('status', trans('category.update.success'));
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            
            return back()->withErrors(trans('category.update.failed'));
        }

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
