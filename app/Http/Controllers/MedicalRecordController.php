<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,medic');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $columns = array_diff(\Schema::getColumnListing('medical_records'),
            ["id", "user_id", "weight", "height", "bruises", "fractures", "muscle_injuries", "tobacco", "alcohol", "other", "created_at", "updated_at"]);

        return view('medical.record.create', compact('user', 'columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request['diabetes'] = $request['diabetes'] ? json_encode($request['diabetes']) : null;
        $request['hypertension'] = $request['hypertension'] ? json_encode($request['hypertension']) : null;
        $request['dyslipidemias'] = $request['dyslipidemias'] ? json_encode($request['dyslipidemias']) : null;
        $request['cancer'] = $request['cancer'] ? json_encode($request['cancer']) : null;
        $request['cardiovascular'] = $request['cardiovascular'] ? json_encode($request['cardiovascular']) : null;
        $request['neurological'] = $request['neurological'] ? json_encode($request['neurological']) : null;

        $record = collect($request->all())
            ->merge(["user_id" => $user->id])
            ->toArray();

        MedicalRecord::create($record);

        return redirect()->route('medical.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MedicalRecord $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MedicalRecord $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        MedicalRecord::where('user_id', $user->id)->firstOrFail();

        return view('medical.record.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalRecord $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $medicalRecord = MedicalRecord::where('user_id', $user)->firstOrFail();

        $request['diabetes'] = $request['diabetes'] ? json_encode($request['diabetes']) : null;
        $request['hypertension'] = $request['hypertension'] ? json_encode($request['hypertension']) : null;
        $request['dyslipidemias'] = $request['dyslipidemias'] ? json_encode($request['dyslipidemias']) : null;
        $request['cancer'] = $request['cancer'] ? json_encode($request['cancer']) : null;
        $request['cardiovascular'] = $request['cardiovascular'] ? json_encode($request['cardiovascular']) : null;
        $request['neurological'] = $request['neurological'] ? json_encode($request['neurological']) : null;

        $medicalRecord->update($request->all());
        $medicalRecord->save();

        return redirect()->route('medical.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MedicalRecord $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        //
    }
}
