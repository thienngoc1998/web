<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{
    public function list(Request $rq)
    {
    	$listproduct=Product::paginate(5);
    	if ($rq->ajax()) {
        return response()->json(view('Admin.product.ajaxlist',compact('listproduct'))->render());
        
      }
      return  view('Admin.product.list',compact('listproduct'));
    }
  
    public function add()
    {
    	return view('Admin.product.add');
    }
    public function postadd(Request $request)
    {
    	$this->validate($request,[
        'name'=>'required|min:3',
        'optradio'=>'required',
        'description'=>'required',
        'unit_price'=>'required|min:1',
         'image'=>'required|mimes:jpg,png,jpeg,gif|max:10000',
         'bantheo'=>'required'
    	],[
          'name.required'=>'Bạn chưa nhập tên',
          'optradio.required'=>'Bạn chưa chọn loại sản phẩm',
          'description.required'=>'Bạn chưa mô tả sản phẩm',
          'unit_price.required'=>'Bạn chưa nhập giá ',
          'bantheo.required'=>'Bạn chưa chọn hình thức bán',
          'image.required'=>'Bạn chưa tải ảnh lên',
          'name.min'=>'Tên sản phẩm phải từ 3 ký tự trở lên',
          'unit_price.min'=>'Tên sản phẩm phải từ 1$ trở lên',
           'image.mimes'=>'Định dạng ảnh bị sai',
           'image.max'=>'Kích thước ảnh quá lớn'
    	]);
    	if($request->hasFile('image'))
    	{
    		$file=$request->file('image');
    		$name=$file->getClientOriginalName();
    		$path=public_path('/source/image/product/');
    		$file->move($path,$name);

    		//Lưu vào csdl
    		$ds=new Product;
    		$ds->name=$request->name;
    		$ds->id_type=$request->optradio;
    		$ds->description=$request->description;
    		$ds->unit_price=$request->unit_price;
    		if(strcmp($request->promotion_price,'')==0)
    		{
    			 $ds->promotion_price=0;
    		}
    		else
    		{
               $ds->promotion_price=$request->promotion_price;
    		}
           $ds->image=$name;
           $ds->unit=$request->bantheo;
           $ds->new=$request->tinhtrang;
           $ds->save();
           return back()->with('thongbao','Thêm mới thành công');
    	}
    }
    public function edit($id)
    {
    	$ds= Product::find($id);
    	return view('Admin.product.edit',['product'=>$ds]);
    }
    public function postedit(Request $request,$id)
    {   
    	$ds=Product::find($id);
    	$this->validate($request,[
        'name'=>'required|min:3',
        'optradio'=>'required',
        'description'=>'required',
        'unit_price'=>'required|min:1',
         'image'=>'mimes:jpg,png,jpeg,gif|max:10000',
         'bantheo'=>'required'
    	],[
          'name.required'=>'Bạn chưa nhập tên',
          'optradio.required'=>'Bạn chưa chọn loại sản phẩm',
          'description.required'=>'Bạn chưa mô tả sản phẩm',
          'unit_price.required'=>'Bạn chưa nhập giá ',
          'bantheo.required'=>'Bạn chưa chọn hình thức bán',
          'image.required'=>'Bạn chưa tải ảnh lên',
          'name.min'=>'Tên sản phẩm phải từ 3 ký tự trở lên',
          'unit_price.min'=>'Tên sản phẩm phải từ 1$ trở lên',
           'image.mimes'=>'Định dạng ảnh bị sai',
           'image.max'=>'Kích thước ảnh quá lớn'
    	]);
    	if($request->hasFile('image'))
    	{
    		$file=$request->file('image');
    		$name=$file->getClientOriginalName();
    		$path=public_path('/source/image/product/');
    		$file->move($path,$name);

    		//Lưu vào csdl
    		$ds->name=$request->name;
    		$ds->id_type=$request->optradio;
    		$ds->description=$request->description;
    		$ds->unit_price=$request->unit_price;
    		if(strcmp($request->promotion_price,'')==0)
    		{
    			 $ds->promotion_price=0;
    		}
    		else
    		{
               $ds->promotion_price=$request->promotion_price;
    		}
           $ds->image=$name;
           $ds->unit=$request->bantheo;
           $ds->new=$request->tinhtrang;
           $ds->save();
           return back()->with('thongbao','Sửa thành công');
    	}
    }
    public function deleteproduct(Request $request, $id)
    {
         if($request->ajax())
         {
             $idcanxoa=Product::find($id);
             $idcanxoa->delete();
             return response()->json(['thanhcong'=>'xoathanhcong']);
         }
    }
    public function timkiem(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('products')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('unit', 'like', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

            } else {
                $data = DB::table('products')->orderBy('id', 'asc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $role = '';
                    if ($row->new == 1)
                        $role = 'Mới';
                    else
                        $role = 'Cũ';
                    $output .= '
                        <tr class="odd gradeX" align="center" id="'.$row->id.'">
                         <td>' . $row->id . '</td>
                         <td>' . $row->name . '</td>
                         <td>' . $row->description. '</td>
                         <td>' . $row->unit_price . '</td>
                         <td>' . $row->promotion_price . '</td>
                           <td>'.$row->image.'</td>
                         <td>' . $row->unit . '</td>
                         <td>'.$role.'</td>
                         <td class="center">
                                <button class="show-modal btn btn-success btn-sm" data-id="' . $row->id . '"  data-name="' . $row->name . '" data-title="' . $row->description . '" data-src="' . asset('source/image/product/' . $row->image) . '">
                                    <span class="glyphicon glyphicon-eye-open"></span>' . 'Show' . '</button>
                         </td>
                         <td class="center">
                                   <a href="admin/product/sua/'. $row->id.'" class="btn btn-info btn-sm"><span
                                            class="glyphicon glyphicon-edit "></span>Edit</a>
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
                'table_data' => $output
            );

            echo json_encode($data);
        }



    }
}
