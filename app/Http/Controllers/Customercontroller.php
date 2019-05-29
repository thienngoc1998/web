<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\DB;

class Customercontroller extends Controller
{
    public function list()
    {
    	$customer=Customer::all();
    	return view('Admin.customer.list',compact('customer'));
    }
    public function edit($id)
    {
    	$idcansua=Customer::find($id);
    	return view('Admin.customer.edit',compact('idcansua'));
    	
    }
    public function postedit(Request $request,$id)
    {
    	$idcansua=Customer::find($id);
    	$this->validate($request,[
         'name'=>'required|min:2',
         'gioitinh'=>'required',
         'email'=>'required',
         'address'=>'required',
         'phone_number'=>'required',
         'note'=>'required'
    	],
    	[
         'name.required'=>'Vui lòng nhập tên',
         'gioitinh.required'=>'Vui lòng chọn giới tính',
         'email.required'=>'Vui lòng nhập Email',
         'address.required'=>'Vui lòng nhập địa chỉ',
         'phone_number.required'=>'Vui lòng nhập số điệnt thoại',
         'note.required'=>'Vui lòng nhập ghi chú',
         'name.min'=>'Tên tối thiểu là 2 ký tự'
    	]);
    	$idcansua->name=$request->name;
    	$idcansua->gender=$request->gioitinh;
    	$idcansua->email=$request->email;
    	$idcansua->address=$request->address;
    	$idcansua->phone_number=$request->phone_number;
    	$idcansua->note=$request->note;
    	$idcansua->save();
    	return redirect()->back()->with('thongbao','Sửa thành công');
    }
    public function deletecustomer($id)
    {
    	$idcanxoa=Customer::find($id);
    	$idcanxoa->delete();
    	return redirect()->back();
    }
    public function xemdonhang(Request $request,$id)
    {
        if ($request->ajax())
        {

            $hoadonsp = DB::table('bill_detail')
                ->join('bills','bills.id','=','bill_detail.id_bill')
                ->join('products', 'products.id','=','bill_detail.id_product')
                ->join('customer', 'customer.id', '=', 'bills.id_customer')
                ->when($id, function ($query, $id) {
                    return $query->where('customer.id', $id);
                })
                ->select('products.name','bill_detail.quantity','bill_detail.unit_price','bills.date_order', 'bills.total','bills.payment','bills.note' )
                ->get();
            return json_encode($hoadonsp);
        }
    }
}
