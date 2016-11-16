<?php

namespace App\Http\Controllers\Web;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CheckPassword;

class ProfilesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewData['title'] = trans('users.user-profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->viewData['user'] = User::find($id);
        $this->viewData['check_followed'] = User::find(Auth::user()->id)
            ->followers()->where('following_id', $id)->first();

        return view('web.users.profile', ['title' => trans('users.show-profile')], $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->isCurrent()) {
            $this->viewData['user'] = $user;

            return view('web.users.update', ['title' => trans('users.update-profile')], $this->viewData);
        }

        return redirect()->action('Web\ProfilesController@show', ['id' => $id])->withErrors(trans('users.permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $path = config('user.avatar.upload_path') . $user->id . '/';

        if (isset($input['image'])) {
            $user->avatar = uploadImage($input['image'], $path, true) ?: $user->avatar;
        }

        if ($user->save()) {
            return redirect()->back()->with('status', trans('fels.status.profile-updated'));
        }

        return redirect()->back()->withErrors(trans('users.update-error'));
    }

    public function editPassword()
    {
        return view('web.users.edit-password');
    }

    public function updatePassword(CheckPassword $request)
    {
        if (Hash::check($request->input('old_password'), Auth::user()->password)) {
            $user = Auth::user();
            $user->password = $request->new_password;
            $user->save();

            return redirect('change-password')->with('status', trans('fels.status.password-updated'));
        }

        return redirect('change-password')->withErrors(trans('users.wrong-old-password'));
     }
}
