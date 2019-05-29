<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('wellcome');
});


Route::get('trangchu', 'masterController@trangchu')->name('trangchu');
Route::get('trangchu/{id}', 'masterController@getproduct')->name('laysanpham');
Route::get('xemchitiet/{id}', 'masterController@detailproduct')->name('xemchitiet');
Route::get('themgiohang/{id}', 'masterController@getAddCart')->name('themgiohang');
Route::get('xoagiohang/{id}', 'masterController@getdeleteCart')->name('xoagiohang');
Route::get('gioithieu', 'masterController@getabout')->name('about');
Route::get('dathang', 'masterController@dathang')->name('dathang')->middleware('checklogin');
Route::post('dathang', 'masterController@postdathang')->name('postdathang');

Route::get('dangnhap', 'masterController@dangnhap')->name('login');
Route::post('login', 'masterController@postdangnhap')->name('postdangnhap');

Route::get('register', 'masterController@dangki')->name('register');
Route::post('/registerform', 'masterController@postregister')->name('postregister');

Route::get('logout', 'masterController@postlogout')->name('postlogout');
Route::get('serch', 'masterController@postserch')->name('postserch');

Route::get('dangnhapadmin', 'Admincontroller@getdangnhapadmin')->name('loginadmin');
Route::post('dangnhapadmin', 'Admincontroller@postdangnhapadmin')->name('postdangnhapadmin');

Route::group(['prefix' => 'admin' ,'middleware'=>'admin'], function () {
    Route::get('index', 'Admincontroller@index')->name('indexadmin');
    Route::get('dangxuat', 'Admincontroller@logout')->name('dangxuat');
    //end index admin
    Route::group(['prefix' => 'type_product'], function () {
        Route::get('/list', 'Admincontroller@listtype_product')->name('listtype_product');

        Route::get('/add', 'Admincontroller@addtype_product')->name('addtype_product');
        Route::post('/postadd', 'Admincontroller@postaddtypeproduct')->name('postaddtype_product');

        Route::post('postedit', 'Admincontroller@postedittypeproduct')->name('postedittypeproduct');
        Route::get('/ajaxmodal/{id}', 'Admincontroller@ajaxtypeproduct');

        Route::get('/delete/{id}', 'Admincontroller@deletetype_product')->name('deletetype_product');
        Route::get('/timkiem', 'Admincontroller@timkiem')->name('timkiemtypeproduct');
    });

    //end type_product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/list', 'Productcontroller@list')->name('listproduct');
        Route::get('ajaxlist', 'Productcontroller@ajaxlist');
        Route::get('/add', 'Productcontroller@add')->name('addproduct');
        Route::post('/add', 'Productcontroller@postadd')->name('postadd');
        Route::get('/edit/{id}', 'Productcontroller@edit')->name('editproduct');
        Route::post('/edit/{id}', 'Productcontroller@postedit')->name('postedit');
        Route::get('/delete/{id}', 'Productcontroller@deleteproduct')->name('deleteproduct');
        Route::get('/timkiem', 'Productcontroller@timkiem')->name('timkiem');
    }); /*end group product*/
    Route::group(['prefix' => 'slide'], function () {
        Route::get('/list', 'Slidecontroller@list')->name('listslide');
        Route::get('/add', 'Slidecontroller@add')->name('addslide');
        Route::post('/add', 'Slidecontroller@postadd')->name('postadd');
        Route::get('/edit/{id}', 'Slidecontroller@edit')->name('editslide');
        Route::post('/editslide/{id}', 'Slidecontroller@postedit')->name('postedit');
        Route::get('/delete/{id}', 'Slidecontroller@deleteslide')->name('deleteslide');
    }); /*end group slide*/
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/list', 'Customercontroller@list')->name('listcustomer');
        Route::get('/edit/{id}', 'Customercontroller@edit')->name('editcustomer');
        Route::post('/edit/{id}', 'Customercontroller@postedit')->name('posteditcustomer');
        Route::get('/delete/{id}', 'Customercontroller@deletecustomer')->name('deletecustomer');
        Route::get('/xemdonhang/{id}', 'Customercontroller@xemdonhang')->name('xemdonhang');

    }); /*end group customer*/
    Route::group(['prefix' => 'user'], function () {
        Route::get('/listuser', 'Usercontroller@listuser')->name('listuser');
        Route::get('/themuser', 'Usercontroller@themuser')->name('themuser');
        Route::post('/postthemuser', 'Usercontroller@postthemuser')->name('postthemuser');
        Route::get('/timkiem', 'Usercontroller@timkiemuser')->name('timkiemuser');
        Route::get('/sua/{id}', 'Usercontroller@getsua')->name('getsua');
        Route::post('/suauser/{id}', 'Usercontroller@postsua')->name('postsua');
        Route::get('/xoa/{id}', 'Usercontroller@xoauser')->name('xoauser');
    });

});
/*Route::get('dangki','Usercontroller@them')->name('them');
Route::post('postdangki','Usercontroller@postthem')->name('postthem');*/

Route::get('ajaxRequest', 'Homecontroller@ajaxRequest');
Route::post('ajaxRequest', 'Homecontroller@ajaxRequestPost');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/{provider}', 'masterController@redirectToProvider')->name('loginprovider');
Route::get('auth/{provider}/callback', 'masterController@handleProviderCallback');



