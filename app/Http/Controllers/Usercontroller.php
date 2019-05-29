<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registerrequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Validator;

class Usercontroller extends Controller
{
    public function listuser()
    {
        $danhsachuser = User::all();
        return view('Admin.user.danhsacg', compact('danhsachuser'));

    }

    public function themuser()
    {
        return view('Admin.user.them');
    }

    public function getsua($id)
    {
        $usercantim = User::find($id);
        return view('Admin.user.sua', compact('usercantim'));
    }

    public function postthemuser(Registerrequest $request)
    {

        if ($request->ajax()) {


            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->provider = $request->provider;
            $user->provider_id = $request->provider_id;
            $user->role = $request->role;
            $user->save();
            return response()->json(['success' => 'Thành công rồi .'], 200);
        }


    }

    public function timkiemuser(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('users')
                    ->where('username', 'like', '%' . $query . '%')
                    ->orwhere('role', 'like', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

            } else {
                $data = DB::table('users')
                    ->orderBy('id', 'asc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $role = '';
                    if ($row->role == 1)
                        $role = 'Admin';
                    else
                        $role = 'Thành viên';
                    $output .= '
                        <tr class="odd gradeX" align="center" id="'.$row->id.'">
                         <td>' . $row->id . '</td>
                         <td>' . $row->username . '</td>
                         <td>' . $row->email . '</td>
                         <td>' . $role . '</td>
                         <td class="center">
                                <a href="admin/user/sua/'. $row->id.'" class="btn btn-info btn-sm"><span
                                            class="glyphicon glyphicon-edit "></span>Edit</a>
                         </td>
                         <td class="center">
                                .<button class="delete-modal btn btn-danger btn-sm" data-id="' . $row->id . '" data-user="' . $row->username . '" >
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

    public function postsua(Request $request, $id)
    {
        if ($request->ajax()) {
            $usercansua = User::find($id);
            $usercansua->username = $request->username;
            $usercansua->role = $request->role;
            $usercansua->save();
            return \GuzzleHttp\json_encode($usercansua);
        }
    }

    public function xoauser(Request $request, $id)
    {
        if ($request->ajax()) {
            $userxoa = User::find($id);
            $userxoa->delete();
            return response()->json(['thongbao' => 'xoa thanh cong']);
        }
    }

}
