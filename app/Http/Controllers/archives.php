<?php

namespace App\Http\Controllers;

use App\Models\invoice_iss;
use App\Models\receivinginvoice;
use Illuminate\Http\Request;

class archives extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice = invoice_iss::onlyTrashed()->get();
        $invoices = Receivinginvoice::onlyTrashed()->get();
        return view('archives.show', compact('invoice','invoices'));

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
