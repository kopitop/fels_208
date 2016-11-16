<?php

namespace App\Http\Controllers\Web;

use Exception;
use DB;
use Log;
use Auth;
use App\Models\User;
use App\Models\Relationship;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowsController extends Controller
{
    public function follow($id)
    {
        DB::beginTransaction();
        
        try {
            $user = User::find($id);

            if ($user) {
                $follow = Relationship::create([
                    'following_id' => $id,
                    'follower_id' => auth()->id(),
                ]);
                //follow activity
                $follow = Activity::create([
                    'target_id' => $id,
                    'user_id' => auth()->id(),
                    'type' => config('user.relationship-type.follow'),
                ]);

                DB::commit();

                return redirect()->action('Web\ProfilesController@show', ['id' => $id]);
            }            
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);

            return redirect()->action('Web\ProfilesController@show', ['id' => $id])
                ->withErrors(trans('users.user-follow.follow-error'));
        }
    }

    public function unfollow($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            if ($user) {
                $unfollow = Relationship::where([
                    ['follower_id', '=', Auth::user()->id],
                    ['following_id', '=', $id],
                ])->delete();
                //unfollow activity
                 $follow = Activity::create([
                    'target_id' => $id,
                    'user_id' => auth()->id(),
                    'type' => config('user.relationship-type.unfollow'),
                ]);

                DB::commit();

                return redirect()->action('Web\ProfilesController@show', ['id' => $id]);
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            
            return redirect()->action('Admin\UsersController@show', ['id' => $id])
                ->withErrors(trans('users.user-follow.unfollow-error'));
        }
    }
}
