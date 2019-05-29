<?php

namespace App\Providers;
use App\Type_product;
use App\Cart;
use App\User;
use Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layout.header','Admin.type_product.list'],function($view){
            $loaisp=Type_product::all();
            
            $view->with('loaisp',$loaisp);
        });
        view()->composer('Admin.product.edit',function($view){
            $loaisp=Type_product::all();
            $view->with('loaisp',$loaisp);
        });
        view()->composer(['layout.header','product.dathang'],function($view){
            if (Session('cart')) {
                $oldcart=Session::get('cart');
                $cart=new Cart($oldcart);
                $view->with(['cart'=>Session::get('cart'),'productcart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
            });
        view()->composer('Admin.admin_layout.header',function($view){
            $admin=User::where('role',1)->get();
            $view->with('loaisp',$admin);
        });
       Schema::defaultStringLength(191);
    }
}
