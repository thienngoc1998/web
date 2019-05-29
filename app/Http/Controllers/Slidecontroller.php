<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sliderequest;
use Illuminate\Http\Request;
use App\Slide;

class Slidecontroller extends Controller
{
   public function list()
   {
   	$listslide=Slide::all();
   	return view('Admin.slide.list',compact('listslide'));
   }
   public function add()
   {
   	return view('Admin.slide.add');
   }
   public function postadd(Sliderequest $request)
   {
   	if ($request->ajax())
    {
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $name=$file->getClientOriginalName();
            $path=public_path('/source/image/slide/');
            $file->move($path,$name);
            //Lưu vào csdl
            $listslide= new Slide;
            $listslide->link=$request->link;
            $listslide->image=$name;
            $listslide->save();
            return response()->json(['thongbao'=>'Upload thành công']);
        }

    }

   }
   public function edit($id)
   {
   	$idcansua=Slide::find($id);
    return view('Admin.slide.edit',compact('idcansua'));
   }
   public function postedit(Request $request,$id)
   {
    if($request->ajax())
    {
   	$listslide=Slide::find($id);
   	if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = public_path('/source/image/slide/');
            $file->move($path, $name);
            //Lưu vào csdl
        $listslide->link=$request->link;
            $listslide->image = $name;
        $listslide->save();
        return response()->json(['success'=>'thành công']);
        }
     else
     {
         $listslide->link=$request->link;
         $listslide->image = $listslide->image;
         $listslide->save();
         return response()->json(['success'=>'thành công']);
     }


    }


   }
   public function deleteslide(Request $request ,$id)
   {
     if ($request->ajax())
     {
         $idcanxoa=Slide::find($id);
         $idcanxoa->delete();
         return response()->json(['thanhcong'=>'Xóa thành công ']);
     }

   }
}
