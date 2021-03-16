<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TypeProducts;
use Yajra\DataTables\Facades\DataTables;

class TypeProductsController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()){
             return datatables()->collection(TypeProducts::getPages())->toJson();
        }else{
            return view('admin.typeproducts.index');
        }
    }

    public function store(Request $request){
//        dd($request->all());
        $arItem=array(
            'name'=>$request->name,
            'producer_id'=>$request->producer_id,

        );
        $ok= TypeProducts::insert($arItem);
        return json_encode($ok);
//        if (TypeProducts::insert($arItem)) {
//            $request->session()->flash('msg', 'Thêm thành công');
//            return redirect()->route('admin.typeproducts.index');
//        }else{
//            $request->session()->flash('msg','Có lỗi khi thêm');
//            return redirect()->route('admin.typeproducts.index');
//        }
    }
    public function destroy(Request $request){

        $id= (int)$request->id;
        $OneUser = TypeProducts::find($id);
        if(empty($OneUser)){return;}
        $OneUser->delete();
        return json_encode(true);
//        $arCat=TypeProducts::find($id);
//        if($arCat->delete()){
//            $request->session()->flash('msg','Xóa thành công');
//            return redirect()->route('admin.typeproducts.index');
//        }else{
//            $request->session()->flash('msg','Xóa thất bại');
//            return redirect()->route('admin.typeproducts.index');
//        }
    }

//    public function edit($id){
//        $data['arItems']=TypeProducts::find($id);
//        return view('admin.typeproducts.edit',$data);
//    }
    public function update(Request $request){

        $id = (int)$request->id;
        $OneUser = TypeProducts::find($id);
        if(empty($OneUser)){return;}
        if($request->action =="LoadDataEdit"){
           return json_encode((array) $OneUser->toArray());
        }
        $OneUser->name = $request->name;
        $OneUser->producer_id = $request->producer_id;
        $OneUser->save();

        return json_encode($OneUser);

//        dd($request->all());
//        $arType=TypeProducts::find($id);
//        $arType->name=$request->name;
//        $arType->producer_id=$request->producer_id;
//        if($arType->update()){
//            $request->session()->flash('msg','Sửa thành công');
//            return redirect()->route('admin.typeproducts.index');
//        }else{
//            $request->session()->flash('msg','Sửa thất bại');
//            return redirect()->route('admin.typeproducts.edit');
//        }

    }

}
