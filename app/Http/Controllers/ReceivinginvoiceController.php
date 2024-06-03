<?php


namespace App\Http\Controllers;

use App\Models\invoicedetails;
use App\Models\item;
use App\Models\Receivinginvoice;
use App\Models\Store;
use App\Models\unit;
use App\Models\User;
use App\Models\Vendor;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class ReceivinginvoiceController extends Controller
{
    public function index()
    {
        $invoices = Receivinginvoice::orderBy('id', 'desc')->paginate(10);
        return view('receive.index', compact('invoices'));
    }

    public function create()
    {   $items=item::all();
        $stores = Store::all();
        $users = User::all();
        $vendors = Vendor::all();
        $units=unit::all();
        return view('receive.create', compact('stores', 'users', 'vendors','items','units'));
    }

    public function store(Request $request)
    {
        $invoice = ReceivingInvoice::create([
            'store_id' => $request->store_id,
            'vend_id' => $request->vend_id,
            'user_id' => $request->user_id,
            'po_no' => $request->po_no,
            'note' => $request->note,
            'invoice_Date' => $request->invoice_Date,
        ]);

        // إنشاء تفاصيل الفاتورة وتحديث كمية المخزون لكل عنصر
        foreach ($request->items as $item) {
            $itemId = $item['productId'];
            $unit = $item['unit'];
            $quantity = $item['quantity'];

            // إنشاء تفاصيل الفاتورة
            InvoiceDetails::create([
                'rec_id' => $invoice->id,
                'item_id' => $itemId,
                'unit' => $unit,
                'quantity' => $quantity,
            ]);

            $product = Item::findOrFail($itemId);
            $product->quantity += $quantity;
            $product->save();
        }

        session()->flash('add');
        return redirect()->route('receive.index');
    }


    public function edit($id)
    {
        $invoice = ReceivingInvoice::findOrFail($id);
        $invoiceDetails = InvoiceDetails::where('rec_id', $id)->get();
        $vendors = Vendor::all();
        $stores = Store::all();
        $items = Item::all();
        return view('receive.edit', compact('invoice', 'invoiceDetails', 'vendors', 'stores', 'items'));
    }

    public function update(Request $request, $id)
    {
        // استرجاع الفاتورة المحددة
        $invoice = ReceivingInvoice::findOrFail($id);

        // تحديث بيانات الفاتورة الأساسية
        $invoice->update([
            'store_id' => $request->store_id,
            'vend_id' => $request->vend_id,
            'user_id' => $request->user_id,
            'po_no' => $request->po_no,
            'note' => $request->note,
            'invoice_Date' => $request->invoice_Date,
        ]);

        // حذف التفاصيل الحالية للفاتورة
        $currentDetails = InvoiceDetails::where('rec_id', $id)->get();

        // إعادة كمية المخزون لكل عنصر إلى الوضع السابق
        foreach ($currentDetails as $detail) {
            $product = Item::findOrFail($detail->item_id);
            $product->quantity -= $detail->quantity;
            $product->save();
        }

        // حذف تفاصيل الفاتورة الحالية
        InvoiceDetails::where('rec_id', $id)->delete();

        // التحقق من وجود العناصر في الطلب
        if ($request->has('items') && is_array($request->items)) {
            // إعادة إنشاء تفاصيل الفاتورة وتحديث كمية المخزون لكل عنصر
            foreach ($request->items as $item) {
                $itemId = $item['item_id'];
                $unit = $item['unit'];
                $quantity = $item['quantity'];

                // إنشاء تفاصيل الفاتورة
                $invoiceDetail = new InvoiceDetails([
                    'rec_id' => $invoice->id,
                    'item_id' => $itemId,
                    'unit' => $unit,
                    'quantity' => $quantity,
                ]);
                $invoiceDetail->save();

                // تحديث كمية المخزون للعنصر
                $product = Item::findOrFail($itemId);
                $product->quantity += $quantity;
                $product->save();
            }
        } else {
            // معالجة الخطأ في حالة عدم وجود عناصر
            return redirect()->back()->withErrors(['items' => 'No items found in the request.']);
        }

        // إعادة توجيه المستخدم مع رسالة تأكيد
        session()->flash('update', 'Invoice updated successfully.');
        return redirect()->route('receive.index');
    }





    public function show($id)
    {
        $invoice = Receivinginvoice::findOrFail($id);
        return view('receive.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Receivinginvoice::findOrFail($id);
        $invoice->details()->delete();
        session()->flash('delete');
        if ($invoice->delete()) {
            return redirect()->route('receive.index')->with('success', 'Invoice deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete invoice.');
        }
    }

    public function print($id)
    {
        $invoice = Receivinginvoice::where('id', $id)->first();
        return view('receive.print', compact('invoice'));

    }



    public function restore_inv_rec($id)
    {
        $invoice = Receivinginvoice::withTrashed()->find($id);
        $invoice->restore();
        $invoice->details()->withTrashed()->restore();
        return redirect()->back();

    }

    public function delete_inv_rec($id)
    {
        Receivinginvoice::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back();

    }

    public function fetchItems($id)
    {
        $items=DB::table('items')->where('store_id',$id)->pluck('item_name','id');
        return json_decode($items);

    }

    public function fetchUnit($id)
    {

        $items=DB::table('items')->where('id',$id)->pluck('unit','id');
        return json_decode($items);
    }
    public function up(Request $request, $id){
        $invoice = Receivinginvoice::findOrFail($id);
        $invoice->update([
            'store_id' => $request->store_id,
            'vend_id' => $request->vend_id,
            'user_id' => $request->user_id,
            'po_no' => $request->po_no,
            'note' => $request->note,
            'invoice_Date' => $request->invoice_Date,
        ]);

        foreach ($request->item_id as $key => $item_id) {
            $itemId=$request->item_id[$key];
            $unit = $request->unit[$key];
            $quantity = $request->quantity[$key];

            // إنشاء تفاصيل الفاتورة
            $invoice_update=invoicedetails::findOrFail($id);
            $invoice_update->update([
                'rec_id' => $invoice->id,
                'item_id' => $itemId,
                'unit' => $unit,
                'quantity' => $quantity,
            ]);

            $item = item::findOrFail($item_id);
            $item->quantity += $quantity;
            $item->save();
        }
        return redirect('receive');
    }


}
