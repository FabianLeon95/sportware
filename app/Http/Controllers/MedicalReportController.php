<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicalReportRequest;
use App\Http\Requests\EditMedicalReportRequest;
use App\Models\MedicalReport;
use App\Models\ReportAttachment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

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
     * @param CreateMedicalReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateMedicalReportRequest $request)
    {
        $report = MedicalReport::create([
            'medic_id' => \Auth::user()->id,
            'patient_id' => $request->patient_id,
            'visit_reason'=>$request->visit_reason,
            'diagnostic'=>$request->diagnostic,
            'treatment'=>$request->treatment,
            'observations'=>$request->observations
        ]);

        $files = $request->file('files');

        if ($files){
            try{
                foreach ($files as $file){
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                                        .'_'.uniqid()
                                        .'.'.$file->extension();
                    \Storage::disk('public')->put($fileName, \File::get($file));

                    ReportAttachment::create([
                        'file_name' => $fileName,
                        'medical_report_id' => $report->id
                    ]);
                }
            } catch (FileNotFoundException $e) {
                return redirect()->back()->withInput($request->input());
            }

        }

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
        $attachments = collect();
        foreach ($report->attachments as $attachment){
            $file = [
                'name' => $attachment->file_name,
                'extension' => File::extension('storage/'.$attachment->file_name),
                'path' => 'storage/'.$attachment->file_name
            ];
            $attachments->push($file);
        }
        return view('medical.reports.show', compact('report', 'attachments'));
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

        $files = $request->file('files');

        if ($files){
            try{
                foreach ($files as $file){
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        .'_'.uniqid()
                        .'.'.$file->extension();
                    \Storage::disk('public')->put($fileName, \File::get($file));

                    ReportAttachment::create([
                        'file_name' => $fileName,
                        'medical_report_id' => $report->id
                    ]);
                }
            } catch (FileNotFoundException $e) {
                return redirect()->back()->withInput($request->input());
            }

        }

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
