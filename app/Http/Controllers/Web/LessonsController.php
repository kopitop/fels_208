<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LessonWord;
use App\Models\Lesson;
use App\Models\User;
use DB;
use Auth;
use Log;

class LessonsController extends Controller
{
    public function __construct()
    {   
        parent::__construct();
        $this->viewData['title'] = trans('web/lesson.lesson');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        DB::beginTransaction();
        try{
            $lesson = new Lesson;
            $lesson->category_id = session('category_id');
            $lesson->user_id = Auth::user()->id;

            $lesson->save();

            foreach ($request->input('results') as $result) {
                $lesson->lessonWords()->create([
                    'word_id' => $result['word'],
                    'answer_id' => $result['answer'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);

            return back()->with('status', trans('lesson.create.failed'));
        }

        return redirect()->action('Web\LessonsController@show', ['id' => $lesson->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        if(!User::findOrFail($lesson->user_id)->isCurrent()){
            return redirect()->action('HomeController@index')->with('status', trans('web/lesson.forbidden'));
        }

        $this->viewData['results'] = $lesson->lessonWords;
        $this->viewData['examiner'] = $lesson->user;
        $this->viewData['score'] = $lesson->lessonWords()->whereHas('answer', function ($query) {
            $query->where('is_correct', '1');
        })->get();

        return view('web.lesson.detail', $this->viewData);
    }

    public function doLesson($category_id)
    {
        $category = Category::findOrFail($category_id);
        $randomWords = $category->words()
            ->inRandomOrder()
            ->limit(2)
            ->get();

        $i = 0;
        foreach ($randomWords as $word) {
            $this->viewData['questions'][$i]['word'] = $word;

            foreach ($word->answers as $answer) {
                $this->viewData['questions'][$i]['answers'][] = $answer;
            }
            $i++;
        }

        session(['category_id' => $category_id]);

        return view('web.lesson.do', $this->viewData);
    }
}
