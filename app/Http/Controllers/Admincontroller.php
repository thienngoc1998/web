<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminRequest;
use App\Http\Requests\Typeproductrequest;
use App\Type_product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Auth;

class Admincontroller extends Controller
{
    public function getdangnhapadmin()
    {
        return view('admin_layout.login');
    }
    public function postdangnhapadmin(adminRequest $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
           return redirect()->route('listtype_product');
        }
        else
        {
            return redirect()->back()->with('thatbai', 'Tài khoản hoặc mật khẩu bị sai');
        }
    }
    public function ajaxtypeproduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $idcantim = Type_product::find($id);
            return response()->json($idcantim);
        }

    }

    public function listtype_product()
    {
        $type_product = Type_product::all();
        return view('Admin.type_product.list', compact('type_product'));
    }

    public function addtype_product()
    {
        return view('Admin.type_product.add');
    }

    public function postaddtypeproduct(Typeproductrequest $addrequest)
    {

        if ($addrequest->ajax()) {
            if ($addrequest->hasFile('image')) {
                $file = $addrequest->file('image');
                $name = $file->getClientOriginalName();
                $path = public_path('/source/image/product/');
                $file->move($path, $name);

                //Lưu vào databaseào
                $type_product = new Type_product;
                $type_product->name = $addrequest->name;
                $type_product->description = $addrequest->description;
                $type_product->image = $name;
                $type_product->save();
                return response()->json(['thongbao', "Thanh cong roi"]);
            }
        }
    }


    public function postedittypeproduct(Typeproductrequest $addrequest)
    {
        if ($addrequest->ajax()) {
            dd($addrequest->all());
            $id = $addrequest->input("id");
            $type_product = Type_product::find($id);
            if ($addrequest->hasFile('image')) {
                $file = $addrequest->file('image');
                $name = $file->getClientOriginalName();
                $path = public_path('/source/image/product/');
                $file->move($path, $name);

                //Lưu vào databaseào
                $type_product = new Type_product;
                $type_product->name = $addrequest->name;
                $type_product->description = $addrequest->description;
                $type_product->image = $name;
                $type_product->save();
                return response()->json(['thongbao', "Thanh cong roi"]);
            } else {
                $type_product->name = $addrequest->name;
                $type_product->description = $addrequest->description;
                $type_product->image = $type_product->image;
                $type_product->save();
                return response()->json(['thongbao' => 'Sửa thành công'], 300);
            }
        }
    }

    public function deletetype_product( Request $request,$id)
    {
        if ($request->ajax()) {
            $deletetype_product = Type_product::find($id);
            $deletetype_product->delete();
            return response()->json(['success' => 'Xóa thành công']);
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginadmin');

    }

    public function timkiem(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('type_products')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

            } else {
                $data = DB::table('type_products')
                    ->orderBy('id', 'asc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                        <tr class="odd gradeX" align="center" id="'.$row->id.'">
                         <td>' . $row->id . '</td>
                         <td>' . $row->name . '</td>
                         <td>' . $row->description . '</td>
                         <td>' . $row->image . '</td>
                         <td class="center">
                                <button class="show-modal btn btn-success btn-sm" data-id="' . $row->id . '"  data-name="' . $row->name . '" data-title="' . $row->description . '" data-src="' . asset('source/image/product/' . $row->image) . '">
                                    <span class="glyphicon glyphicon-eye-open"></span>' . 'Show' . '</button>
                         </td>
                         <td class="center">
                                <button class="edit-modal btn btn-info btn-sm" data-id="' . $row->id . '"  data-name="' . $row->name . '" data-title="' . $row->description . '" data-src="' . asset('source/image/product/' . $row->image) . '">
                                    <span class="glyphicon glyphicon-edit "></span>' . 'Edit' . '</button>
                         </td>
                         <td class="center">
                                .<button class="delete-modal btn btn-danger btn-sm" data-id="' . $row->id . '" data-name="' . $row->name . '" data-title="' . $row->description . '" data-src="' . asset('source/image/product/' . $row->image) . '">
                                    <span class="glyphicon glyphicon-trash"></span>' . ' Delete' . '</button>.
                          </td>
                        </tr>
                        ';
                }
            } else {
                $output = '
               <tr>
                <td align="center" colspan="5">No Data Found</td>
               </tr>
               ';
            }
            $data = array(
                'table_data' => $output,

            );

            echo json_encode($data);
        }
    }
}
