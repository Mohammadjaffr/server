<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\item;
use App\Models\packing;
use App\Models\store;
use App\Models\unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\json;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units=unit::all();
        $packings=packing::all();
        $companys=company::all();
        $stores=store::all();
        $items=item::all();
        return view('item.create_item',compact('units','companys','items','packings','stores'));
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
        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input
//        $validatedData=$request->validate([
//                'item_name'=>'required|unique:items|max:100',
//                'com_id'=>'max:100',
//
//            ]
//        ) ;

        $item=new item();
        $item->item_name =$request->item_name;
        $item->quantity =$request->quantity;
        $item->com_id=$request->company_id;
        $item->unit=$request->unit_code;
        $item->pakcking_id=$request->packing_id;
        $item->store_id=$request->store_id;
        $item->save();
        $item->stores()->attach($request->store_id);
        $item->com()->attach($request->company_id);
        session()->flash('Add','Added successfully ');
        return redirect('item');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $notificationId = DB::table('notifications')->where('data->id', $id)->pluck('id')->first(); // استرجاع الـ id الأول فقط
        if ($notificationId) { // التأكد من أن الإشعار تم العثور عليه
            DB::table('notifications')->where('id', $notificationId)->update(['read_at' => now()]);
        }
        return view('item.read_notification',compact('item'));



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }
    public function notiy(){
        $item = session('item');
        return view('item.read_notification',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $item=item::findorfail($id);
        $item->update(
            [
                 'item_name' =>$request->item_name,
                 'quantity' =>$request->quantity,
                 'com_id'=>$request->company_id,
                 'unit'=>$request->unit_code,
                 'pakcking_id'=>$request->packing_id,
                 'store_id'=>$request->store_id,
            ]
        );

        $item->save();
        $item->stores()->attach($request->store_id);
        $item->com()->attach($request->company_id);
        session()->flash('edit','edited successfully ');
        return redirect('item');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(packing $packing,$id)
    {
        item::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect()->back();
    }
    public function getunit($id)
    {
      $unit=DB::table('units')->where('packing_id',$id)->pluck('Unit_code','id');
      return json_decode($unit);
    }


    public function get_unit($id)
    {
        $itmes=DB::table('items')->where('com_id',$id)->pluck('item_name','id');
        return json_decode($itmes);
    }


        public function rec_unit($id)
    {
        $unit=DB::table('items')->where('item_id[0]',$id)->pluck('item_name','id');
        return json_decode($unit);

    }
    public function MarkAsRead_all(Request $request)
    {
        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }




    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }


}
