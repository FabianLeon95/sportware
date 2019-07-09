<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicalReportRequest;
use App\Http\Requests\EditMedicalReportRequest;
use App\Models\MedicalReport;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,medic');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('medical.reports.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMedicalReportRequest $request)
    {
        MedicalReport::create([
            'medic_id' => \Auth::user()->id,
            'patient_id' => $request->patient_id,
            'visit_reason'=>$request->visit_reason,
            'diagnostic'=>$request->diagnostic,
            'treatment'=>$request->treatment,
            'observations'=>$request->observations
        ]);

        return redirect()->route('medical.show', $request->patient_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicalReport  $medicalReport
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalReport $report)
    {
        return view('medical.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicalReport  $medicalReport
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalReport $report)
    {
        return view('medical.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MedicalReport $report
     */
    public function update(EditMedicalReportRequest $request, MedicalReport $report)
    {
        $report->update([
            'visit_reason'=>$request->visit_reason,
            'diagnostic'=>$request->diagnostic,
            'treatment'=>$request->treatment,
            'observations'=>$request->observations
        ]);

        $report->save();

        return redirect()->route('medical.show', $report->patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicalReport  $medicalReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalReport $medicalReport)
    {
        //
    }
}
