<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dathangrequest;
use App\Http\Requests\Loginrequest;
use App\Http\Requests\Registerrequest;
use App\Socialprovider;
use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\Type_product;
use App\Cart;
use Laravel\Socialite\Facades\Socialite;
use Session;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\RedirectResponse;
use Validator;

class masterController extends Controller
{
    public function trangchu()
    {
        $slide = Slide::all();
        $product = Product::where('new', 1)->paginate(4);
        $lastproduct = Product::where('new', 0)->paginate(8);
        return view('layout.trangchu', compact('slide', 'product', 'lastproduct'));

    }

    public function getproduct($id)
    {
        $sanpham = Product::where([['id_type', $id], ['new', 1]])->paginate(2);
        $loaisanpham = Type_product::find($id);
        $sanphamcu = Product::where([['id_type', $id], ['new', 0]])->paginate(3);
        $loai = Type_product::where('id', $id)->first();
        return view('product.typeproduct', compact('loaisanpham', 'sanpham', 'sanphamcu', 'loai'));
    }

    public function detailproduct(Request $id)
    {
        $detail = Product::where('id', $id->id)->first();
        $relateproduct = Product::where('id_type', $detail->id_type)->paginate(3);
        $newproduct = Product::where([['id_type', $detail->id_type], ['new', 1]])->get();

        return view('product.detailproduct', compact('detail', 'relateproduct', 'newproduct'));
    }

    public function getAddCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            $oldcart = Session('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldcart);
            $cart->add($product, $id);
            $newcart = $request->session()->put('cart', $cart);
            return \GuzzleHttp\json_encode($cart);
        }

    }

    public function getdeleteCart(Request $reg, $id)
    {
        if ($reg->ajax())
        {
            $oldcart = Session('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldcart);
            $cart->removeItem($id);
            if (count($cart->items) > 0) {
                $reg->session()->put('cart', $cart);
            } else {
                $reg->session()->forget('cart');
            }
            return json_encode($cart);
        }

    }

    public function getabout()
    {
        return view('layout.gioithieu');
    }

    public function dathang()
    {
        if (Session('cart')) {
            $oldcart = Session::get('cart');
            $cart = new Cart($oldcart);
            /*dd($cart);*/
            return view('product.dathang', ['productcart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
        }

    }

    public function postdathang(Dathangrequest $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->adress;
        $customer->phone_number = $request->phone;
        $customer->note = $request->notes;
        $customer->save();
        return back()->with('thongbao', 'Đặt hàng thành công');

    }

    public function dangnhap()
    {
        return view('layout.login');
    }

    public function dangki()
    {
        return view('layout.register');
    }

    public function postregister(Registerrequest $request)
    {
        if ($request->ajax()) {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->provider=$request->provider;
            $user->provider_id=$request->provider_id;
            $user->save();
            return response()->json(['thongbao' => 'Đăng kí thành công']);
        }

    }

    public function postdangnhap(Loginrequest $request)
    {

        $mang = array('email' => $request->email, 'password' => $request->password);
        if (Auth::attempt($mang)) {
            return redirect()->route('trangchu');
        } else {
            return redirect()->back()->with('thatbai', 'Đăng nhập thất bại');
        }
    }

    public function postlogout()
    {
        Auth::logout();
        return redirect()->route('trangchu');

    }

    public function postserch(Request $request)
    {

        $product = Product::where('name', 'like', '%' . $request->key . '%')->orWhere('unit_price', $request->key)->get();
        return view('product.searchproduct', compact('product'));

    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user);

        // Chỗ này để check xem nó có chạy hay không
        // dd($user);

        Auth::login($authUser, true);

        return redirect()->route('trangchu');
    }

    private function findOrCreateUser($facebookUser){
        $authUser = User::where('provider_id', $facebookUser->id)->first();

        if($authUser){
            return $authUser;
        }

        return User::create([
            'username' => $facebookUser->name,
            'password' => $facebookUser->token,
            'email' => $facebookUser->email,
            'provider_id' => $facebookUser->id,
            'provider' => $facebookUser->id,
        ]);
    }

}
