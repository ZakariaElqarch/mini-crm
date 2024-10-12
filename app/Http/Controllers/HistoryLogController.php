<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all history logs, optionally with relationships like admin and employee
        $historyLogs = HistoryLog::with(['admin', 'employee'])->orderBy('created_at', 'desc')->get();
        // Pass the history logs to a view
        return view('admin.history.index', compact('historyLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
