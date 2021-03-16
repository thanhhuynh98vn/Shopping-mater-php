<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ModelDetail;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class OrdersController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return datatables()->collection(Order::all())->toJson();
        }else{
            return view('admin.orders.index');
        }
    }
    public function showData(Request $request){
        $id= (int)$request->id;
        $OneOrder = Order::select('users.fullname','order.*')->join('users','users.id','=', 'order.id_user')->where('id_order',$id)->first()->toArray();
        $OrderDetail = ModelDetail::select('products.*')->join('products', 'products.pid', '=', 'order_detail.id_products')->where('order_detail.id_order',$OneOrder['id_order'])->get()->toArray();
        if(empty($OneOrder)){return;}
        return json_encode(['OneOrder'=>$OneOrder,'OrderDetail'=>$OrderDetail]);
    }
    public function showDetail(Request $request){
        $idoder= (int)$request->input('idorder');
        if ($request->ajax()){
            return datatables()->collection(ModelDetail::select('products.*','order_detail.quantity')->join('products', 'products.pid', '=', 'order_detail.id_products')->where('order_detail.id_order',$idoder)->get())->toJson();
        }else{
            return view('admin.orders.index');
        }
    }

    public function active(Request $request){
     $finds=Order::find($request->idRead);
     if($finds->active==1)
     {
        $data['item']=  DB::table('order')
        ->where('id_order',$finds->id_order)
        ->update(['active' => 0]);
    }
    else{
        $data['item'] = DB::table('order')
        ->where('id_order',$finds->id_order )
        ->update(['active' => 1]);

    }
    $data['item'] = DB::table('order')->where('id_order',$finds->id_order )->first();

    return response()->json([
        "status" => true,
        "html" => view("admin.orders._ajaximg",$data)->render(),
    ]);

}
public function destroy($id, Request $request){
    $arDell=Order::find($id);
    if($arDell->delete()){
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.orders.index');
    }else{
        $request->session()->flash('msg','Xóa thất bại');
        return redirect()->route('admin.orders.index');
    }
}
}
