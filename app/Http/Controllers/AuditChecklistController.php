<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use App\Models\AuditChecklist;

class AuditChecklistController extends Controller
{
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
    public function create()
    {
        $audit = Audit::find(request()->audit);
        return view('app.audit.checklist.create', compact('audit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuditChecklist  $auditChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(AuditChecklist $auditChecklist)
    {
        $audit = Audit::find($auditChecklist->audit_id);
        return view('app.audit.checklist.show', compact('auditChecklist', 'audit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditChecklist  $auditChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditChecklist $auditChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditChecklist  $auditChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditChecklist $auditChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditChecklist  $auditChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditChecklist $auditChecklist)
    {
        //
    }
}
