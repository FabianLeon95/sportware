<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteRegistrationRequest;
use App\Models\MaritalStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompleteRegistrationController extends Controller
{

    /**
     * CompleteRegistrationController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registration($token)
    {
        $user = User::where('registration_token', $token)->firstOrFail();
        $maritalStatuses = MaritalStatus::all();

        return view('complete_registration.registration', compact('user', 'maritalStatuses'));
    }

    public function update(CompleteRegistrationRequest $request, User $user)
    {
        $user->update([
            "name" => $request->first_name." ".$request->last_name,
            "birthdate" => Carbon::parse($request->birthdate)->format('Y-m-d'),
            "nationality" => $request->nationality,
            "marital_status_id" => $request->marital_status,
            "phone_number" => $request->phone_number,
            'registration_token' => null,
            'registration_completed_at' => Carbon::now()
        ]);

        $user->setPasswordAttribute($request->password);

        $user->save();

        Auth::login($user);
        return redirect()->route('home');
    }
}
