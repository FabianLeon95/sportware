<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOwnUser;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserInfoRequest;
use App\Models\MaritalStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckOwnUser::class);
    }

    public function info(User $user)
    {
        $maritalStatuses = MaritalStatus::all();
        return view('profile.info', compact('user', 'maritalStatuses'));
    }

    public function password(User $user)
    {
        return view('profile.password', compact('user'));

    }

    public function updateInfo(UserInfoRequest $request, User $user)
    {
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "birthdate" => Carbon::parse($request->birthdate)->format('Y-m-d'),
            "nationality" => $request->nationality,
            "marital_status_id" => $request->marital_status,
            "phone_number" => $request->phone_number,
        ]);
        $user->save();
        return redirect()->route('profile.info', $user);
    }

    public function updatePassword(PasswordUpdateRequest $request, User $user)
    {
        $user->setPasswordAttribute($request->password);
        $user->save();
        return redirect()->route('profile.password', $user)->with('status', 'Password changed successfully!');
    }
}
