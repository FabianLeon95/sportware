<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,medic');
    }

    public function index()
    {
        $users = User::get(['id','name']);

        return view('medical.index', compact('users'));
    }

    public function show(User $user)
    {
        $reports = MedicalReport::where('patient_id', $user->id)->get();
        return view('medical.show', compact('user', 'reports'));
    }

    public function search($param)
    {
        $results = User::where('name', $param);

        if ($results->count()>0){
            if ($results->count() == 1 ){
                return redirect()->route('medical.show', $results->first());
            } else {
                return view('medical.search');
            }
        }

        return abort(404);
    }
}
