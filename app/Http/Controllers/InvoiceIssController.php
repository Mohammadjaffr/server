<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\digger;
use App\Models\invoice_iss;
use App\Models\invoice_iss_details;
use App\Models\invoicedetails;
use App\Models\item;
use App\Models\receivinginvoice;
use App\Models\store;
use App\Models\transport;
use App\Models\unit;
use App\Models\User;
use App\Models\vendor;
use App\Notifications\LessQuantity;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoiceIssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoice_iss::orderBy('id', 'desc')->paginate(10);
        return view('issuing.index', compact('invoices'));
    }

    public function create()
    {
        $items = item::all();
        $stores = Store::all();
        $users = User::all();
        $clients = client::all();
        $units = unit::all();
        $transports = transport::all();
        $diggers = digger::all();
        return view('issuing.create', compact('clients', 'diggers', 'transports', 'stores', 'users', 'items', 'units'));
    }

    public function store(Request $request)
    {
        // إنشاء الفاتورة
        $invoice = invoice_iss::create([
            'stor_id' => $request->store_id,
            'client_id' => $request->client_id,
            'user_id' => $request->user_id,
            'digger_id' => $request->digger_id,
            'transport_id' => $request->transport_id,
            'invoice_Date' => $request->invoice_Date,
        ]);

        // إنشاء تفاصيل الفاتورة وتحديث كمية المخزون لكل عنصر
        foreach ($request->items as $item) {
            $itemId = $item['productId'];
            $unit = $item['unit'];
            $quantity = $item['quantity'];

            // إنشاء تفاصيل الفاتورة
            invoice_iss_details::create([
                'issu_id' => $invoice->id,
                'item_id' => $itemId,
                'unit' => $unit,
                'quantity' => $quantity,
            ]);

            // تحديث كمية المنتج في المخزون
            $product = Item::findOrFail($itemId);
            $product->quantity -= $quantity;
            $product->save();

            // التحقق من كمية المنتج وإرسال الإشعار إذا كانت أقل من 100
            if ($product->quantity < 100) {
                $user = User::all();
                Notification::send($user, new LessQuantity($itemId, $product->item_name));
            }
        }

        // رسالة فلاش للتأكيد على نجاح العملية
        session()->flash('add');

        // إعادة توجيه المستخدم إلى الصفحة الرئيسية للفواتير
        return redirect()->route('issue.index');
    }


    public function show($id)
    {
        $invoice = invoice_iss::findOrFail($id);
        return view('issuing.show', compact('invoice'));
    }

    public function edit($id)
    {

        $invoiceDetails = invoice_iss_details::where('issu_id', $id)->get();
        $items = item::all();
        $stores = Store::all();
        $users = User::all();
        $clients = client::all();
        $units = unit::all();
        $transports = transport::all();
        $diggers = digger::all();
        $invoice = invoice_iss::findOrFail($id);
        return view('issuing.edit', compact('clients','invoiceDetails', 'diggers', 'transports', 'stores', 'users', 'items', 'units', 'invoice'));
    }

    public function update(Request $request, $id)
    {
        $invoice = invoice_iss::findOrFail($id);

        $invoice->update([
            'stor_id' => $request->store_id,
            'client_id' => $request->client_id,
            'user_id' => $request->user_id,
            'digger_id' => $request->digger_id,
            'transport_id' => $request->transport_id,
            'invoice_Date' => $request->invoice_Date,
            ]);

        // حذف التفاصيل الحالية للفاتورة
        $currentDetails = invoice_iss_details::where('issu_id', $id)->get();

        // إعادة كمية المخزون لكل عنصر إلى الوضع السابق
        foreach ($currentDetails as $detail) {
            $product = Item::findOrFail($detail->item_id);
            $product->quantity -= $detail->quantity;
            $product->save();
        }

        // حذف تفاصيل الفاتورة الحالية
        invoice_iss_details::where('issu_id', $id)->delete();

        // التحقق من وجود العناصر في الطلب
        if ($request->has('items') && is_array($request->items)) {
            // إعادة إنشاء تفاصيل الفاتورة وتحديث كمية المخزون لكل عنصر
            foreach ($request->items as $item) {
                $itemId = $item['item_id'];
                $unit = $item['unit'];
                $quantity = $item['quantity'];

                // إنشاء تفاصيل الفاتورة
                $invoiceDetail = new invoice_iss_details([
                    'issu_id' => $invoice->id,
                    'item_id' => $itemId,
                    'unit' => $unit,
                    'quantity' => $quantity,
                ]);
                $invoiceDetail->save();

                // تحديث كمية المخزون للعنصر
                $product = Item::findOrFail($itemId);
                $product->quantity -= $quantity;
                $product->save();

                // التحقق من كمية المنتج وإرسال الإشعار إذا كانت أقل من 100
                if ($product->quantity < 100) {
                    $user = User::all();
                    Notification::send($user, new LessQuantity($itemId, $product->item_name));
                }
            }
        } else {
            // معالجة الخطأ في حالة عدم وجود عناصر
            return redirect()->back()->withErrors(['items' => 'No items found in the request.']);
        }

    }

    public function destroy($id)
    {
        $invoice = invoice_iss::findOrFail($id);
        $invoice->details()->delete();
        session()->flash('delete');
        if ($invoice->delete()) {
            return redirect()->route('issue.index')->with('success', 'Invoice deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete invoice.');
        }

    }

    public function print($id)
    {
        $invoice = invoice_iss::where('id', $id)->first();
        return view('issuing.print', compact('invoice'));

    }

        public function restore_inv_iss($id)
    {
        $invoice = invoice_iss::withTrashed()->find($id);
        $invoice->restore();
        $invoice->details()->withTrashed()->restore();
        return redirect()->back();

    }
    public function delete_inv_iss($id)
    {
        invoice_iss::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back();

    }
    public function fetchItems($id)
    {
        $items=DB::table('items')->where('store_id',$id)->pluck('item_name','id');
        return json_decode($items);

    }

    public function fetchUnit($id)
    {

        $unit=DB::table('items')->where('id',$id)->pluck('unit','id');
        return json_decode($unit);
    }


}
