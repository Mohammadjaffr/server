<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\invoice_iss;
use App\Models\receivinginvoice;
use App\Models\vendor;
use Illuminate\Http\Request;

class reportes extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = vendor::all();
        return view('report.vendor_report',compact('vendor',));
    }
    public function Search_vendor(Request $request){


// في حالة البحث بدون التاريخ
            $vendor = vendor::all();
            if ($request->vendor && $request->start_at =='' && $request->end_at=='') {

                $invoices = receivinginvoice::select('*')->where('vend_id','=',$request->vendor)->get();
                return view('report.vendor_report',compact('vendor'))->withDetails($invoices);
            }


            // في حالة البحث بتاريخ

            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

                $invoices = receivinginvoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('vend_id','=',$request->vendor)->get();
                $vendor = vendor::all();
                return view('report.vendor_report',compact('vendor'))->withDetails($invoices);


            }

        }


    public function report_client()
{
    $client = client::all();
    return view('report.client_report',compact('client',));
}

    public function Search_client(Request $request)
{
    $client = client::all();
    if ($request->client && $request->start_at =='' && $request->end_at=='') {

        $invoices = invoice_iss::select('*')->where('client_id','=',$request->client)->get();
        return view('report.client_report',compact('client'))->withDetails($invoices);
    }


    // في حالة البحث بتاريخ

    else {

        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        $invoices = invoice_iss::whereBetween('invoice_Date',[$start_at,$end_at])->where('client_id','=',$request->client)->get();
        $client = client::all();
        return view('report.client_report',compact('client'))->withDetails($invoices);


    }

}

    public function report_invoice_rec()
    {
        $vendor = Vendor::all();
        $invoice = ReceivingInvoice::latest()->first();
        $allInvoices = ReceivingInvoice::all();
        return view('report.invoice_rec_report', compact('vendor', 'invoice', 'allInvoices'));
    }


    public function Search_invoice_rec(Request $request)
    {
        $vendor = Vendor::all();

        if ($request->Status && $request->start_at == '' && $request->end_at == '') {
            $details = ReceivingInvoice::where('Status', $request->Status)->get();
            return view('report.invoice_rec_report', compact('vendor', 'details'));
        } else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = receivinginvoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->Status)->get();
            $vendor = Vendor::all();
            return view('report.invoice_rec_report',compact('vendor'))->withDetails($invoices);
        }


    }


    public function report_invoice_iss()
    {
        $client = client::all();
        $invoice = invoice_iss::latest()->first();
        $allInvoices = invoice_iss::all();
        return view('report.invoice_iss_report', compact('client', 'invoice', 'allInvoices'));
    }


    public function Search_invoice_iss(Request $request)
    {
        $client = client::all();

        if ($request->Status && $request->start_at == '' && $request->end_at == '') {
            $details = invoice_iss::where('Status', $request->Status)->get();
            return view('report.invoice_iss_report', compact('client', 'details'));
        } else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = invoice_iss::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->Status)->get();
            $client = client::all();
            return view('report.invoice_iss_report',compact('client'))->withDetails($invoices);
        }


    }


}
