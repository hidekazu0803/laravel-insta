<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



class ProfileController extends Controller
{
    //
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        if (Auth::user()->id !== $user->id) :
            return redirect()->route('profile.show', $id);
        endif;

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'       => 'required|min:1|max:50',
            'email'      => 'required|email|max:50|' . Rule::unique('users')->ignore(Auth::user()->id),
            'avatar'     => 'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $user               = $this->user->findOrFail(Auth::user()->id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;

        if ($request->avatar) {
            if ($user->avatar) {
                $this->deleteAvatar($user->avatar);
            }

            $user->avatar = $this->saveAvatar($request);
        }

        $user->save();
        return redirect()->route('profile.show', auth::user()->id);
    }

    private function saveAvatar($request)
    {
        $avatar_name = time() . "." . $request->avatar->extension();
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    private function deleteAvatar($avatar_name)
    {
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if (Storage::disk('local')->exists($avatar_path)) {
            Storage::disk('local')->delete($avatar_path);
        }
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followers')->with('user', $user);
    }
}
