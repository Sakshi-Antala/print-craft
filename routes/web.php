<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user;
use App\Http\Controllers\admin;
use App\Http\Controllers\agency;
use App\Http\Controllers\deliveryboy;
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
Route::get('/',[user::class,'home']);
Route::get('/registration',[user::class,'registration']);
Route::post('/submit',[user::class,'submit']);
Route::get('/login',[user::class,'login']);
Route::get('/contact',[user::class,'contact']);
Route::post('/addtocart',[user::class,'addtocart']);
Route::get('/shoppingcart',[user::class,'shoppingcart']);
Route::get('/updatecart/{key}/{qty}',[user::class,'updatecart']);
Route::get('/removecart/{key}',[user::class,'removecart']);
Route::get('/shop',[user::class,'shop']);
Route::get('/checkout',[user::class,'checkout']);
Route::get('/productdetail/{id}',[user::class,'productdetail']);
Route::post('/logincheck',[user::class,'logincheck']);
Route::get('/logout',[user::class,'logout']);
Route::get('/joinasagency',[user::class,'joinasagency']);
Route::post('/insertagency/{id}',[user::class,'insertagency']);
Route::get('/sessiondestroy',[user::class,'sessiondestroy']);
Route::get('/sendmail',[user::class,'sendmail']);
Route::get('/forgetpass',[user::class,'forgetpass']);
Route::post('/getotp',[user::class,'getotp']);
Route::get('/otpverification',[user::class,'otpverification']);
Route::post('/otpcheck',[user::class,'otpcheck']);
Route::get('/resetpassword/{otp}',[user::class,'resetpassword']);
Route::post('/passchange',[user::class,'passchange']);
Route::get('/couponcheck/{code}',[user::class,'couponcheck']);
Route::get('/profile',[user::class,'profile']);
Route::post('/updateprofile',[user::class,'updateprofile']);
Route::get('/changepassword',[user::class,'changepassword']);
Route::post('/updatepassword',[user::class,'updatepassword']);
Route::any('/payment',[user::class,'payment']);
Route::get('/demo',[user::class,'demo']);
Route::get('/myorder',[user::class,'myorder']);
Route::get('/orderdetail/{id}',[user::class,'orderdetail']);
Route::get('/invoice/{id}',[user::class,'invoice']);
Route::post('/addreview',[user::class,'addreview']);
Route::get('/wishlist/{id}',[user::class,'wishlist']);
Route::get('/displaywishlist',[user::class,'displaywishlist']);
Route::get('/removewishlist/{id}',[user::class,'removewishlist']);
Route::post('/contactus',[user::class,'contactus']);
Route::get('/categoryproduct/{id}',[user::class,'categoryproduct']);
Route::post('/subcribe',[user::class,'subcribe']);
Route::any('/facebookwithlogin',[user::class,'facebookwithlogin']);
Route::post('/filter',[user::class,'filter']);
Route::post('/filtercategory',[user::class,'filtercategory']);
Route::get('/mspurchase/{id}',[user::class,'mspurchase']);
Route::any('/purchase',[user::class,'purchase']);
Route::get('/agencyform',[user::class,'agencyform']);
Route::post('/search',[user::class,'search']);
//Route::get('/homeaddtocart/{id}',[user::class,'homeaddtocart']);


Route::get('/admin',[admin::class,'login']);
Route::post('/admin/auth',[admin::class,'auth']);
Route::get('/admin/logout',[admin::class,'logout']);
Route::get('/admin/profile',[admin::class,'profile']);
Route::get('/admin/dashboard',[admin::class,'dashboard']);
Route::get('/admin/category',[admin::class,'category']);
Route::post('/admin/insertcategory',[admin::class,'insertcategory']);
Route::get('/admin/fetchcategory/{id}',[admin::class,'fetchcategory']);
Route::post('/admin/updatecategory/{id}',[admin::class,'updatecategory']);
Route::get('/admin/subcategory',[admin::class,'subcategory']);
Route::post('/admin/insertsubcategory',[admin::class,'insertsubcategory']);
Route::get('/admin/fetchsubcategory/{id}',[admin::class,'fetchsubcategory']);
Route::post('/admin/updatesubcategory/{id}',[admin::class,'updatesubcategory']);
Route::get('/admin/deletecategory/{id}',[admin::class,'deletecategory']);
Route::get('/admin/product',[admin::class,'product']);
Route::get('/admin/getsubcat/{id}',[admin::class,'getsubcat']);
Route::get('/admin/deletesubcategory/{id}',[admin::class,'deletesubcategory']);
Route::post('/admin/insertproduct',[admin::class,'insertproduct']);
Route::get('/admin/deleteproduct/{id}',[admin::class,'deleteproduct']);
Route::get('/admin/fetchproduct/{id}',[admin::class,'fetchproduct']);
Route::get('/admin/deleteproductattr/{id}/{pid}',[admin::class,'deleteproductattr']);
Route::post('/admin/updateproduct/{id}',[admin::class,'updateproduct']);
Route::get('/admin/getpname/{pname}',[admin::class,'getpname']);
Route::get('/admin/userlist',[admin::class,'userlist']);
Route::get('/admin/agencylist',[admin::class,'agencylist']);
Route::get('/admin/agencyapproval/{id}',[admin::class,'agencyapproval']);
Route::get('/admin/deleteuser/{id}',[admin::class,'deleteuser']);
Route::get('/admin/coupon',[admin::class,'coupon']);
Route::get('/admin/checkcode/{code}',[admin::class,'checkcode']);
Route::post('/admin/insertcoupon',[admin::class,'insertcoupon']);
Route::get('/admin/fetchcoupon/{id}',[admin::class,'fetchcoupon']);
Route::post('/admin/updatecoupon/{id}',[admin::class,'updatecoupon']);
Route::get('/admin/deletecoupon/{id}',[admin::class,'deletecoupon']);
Route::get('/admin/forgetpassword',[admin::class,'forgetpassword']);
Route::post('/admin/getlink',[admin::class,'getlink']);
Route::get('/admin/resetlink/{token}',[admin::class,'resetlink']);
Route::post('/admin/changepass',[admin::class,'changepass']);
Route::post('/admin/changeadminprofile/{id}',[admin::class,'changeadminprofile']);
Route::get('/admin/changepassword',[admin::class,'changepassword']);
Route::post('/admin/updatepassword',[admin::class,'updatepassword']);
Route::get('/admin/deliveryboy',[admin::class,'deliveryboy']);
Route::post('/admin/insertdeliveryboy',[admin::class,'insertdeliveryboy']);
Route::get('/admin/fetchdeliveryboy/{id}',[admin::class,'fetchdeliveryboy']);
Route::post('/admin/updatedeliveryboy/{id}',[admin::class,'updatedeliveryboy']);
Route::get('/admin/deletedeliveryboy/{id}',[admin::class,'deletedeliveryboy']);
Route::get('/admin/orderlist',[admin::class,'orderlist']);
Route::post('/admin/assigndeliveryboy',[admin::class,'assigndeliveryboy']);
Route::get('/admin/orderstatus/{oid}/{status}',[admin::class,'orderstatus']);
Route::get('/admin/orderdetail/{id}',[admin::class,'orderdetail']);
Route::get('/admin/review',[admin::class,'review']);
Route::get('/admin/addmembership',[admin::class,'addmembership']);
Route::post('/admin/insertmembership',[admin::class,'insertmembership']);
Route::get('/admin/fetchmembership/{mid}',[admin::class,'fetchmembership']);
Route::post('/admin/updatemembership/{mid}',[admin::class,'updatemembership']);
Route::get('/admin/deletemembership/{id}',[admin::class,'deletemembership']);







Route::get('/agency',[agency::class,'login']);
Route::post('/agency/auth',[agency::class,'auth']);
Route::get('/agency/logout',[agency::class,'logout']);
Route::get('/agency/dashboard',[agency::class,'dashboard']);
Route::get('/agency/product',[agency::class,'product']);
Route::get('/agency/getsubcat/{id}',[agency::class,'getsubcat']);
Route::get('/agency/getpname/{pname}',[agency::class,'getpname']);
Route::post('/agency/insertproduct',[agency::class,'insertproduct']);
Route::get('/agency/deleteproduct/{id}',[agency::class,'deleteproduct']);
Route::get('/agency/fetchproduct/{id}',[agency::class,'fetchproduct']);
Route::post('/agency/updateproduct/{id}',[agency::class,'updateproduct']);
Route::get('/agency/deleteproductattr/{id}/{pid}',[agency::class,'deleteproductattr']);
Route::get('/agency/forgetpassword',[agency::class,'forgetpassword']);
Route::post('/agency/getlink',[agency::class,'getlink']);
Route::get('/agency/resetlink/{token}',[agency::class,'resetlink']);
Route::post('/agency/changepass',[agency::class,'changepass']);
Route::get('/agency/deleteimage/{id}/{pid}',[agency::class,'deleteimage']);
Route::get('/agency/profile',[agency::class,'profile']);
Route::get('/agency/changepassword',[agency::class,'changepassword']);
Route::post('/agency/updatepassword',[agency::class,'updatepassword']);
Route::post('/agency/changeagencyprofile',[agency::class,'changeagencyprofile']);
Route::get('/agency/color',[agency::class,'color']);
Route::post('/agency/insertcolor',[agency::class,'insertcolor']);
Route::get('/agency/fetchcolor/{id}',[agency::class,'fetchcolor']);
Route::post('/agency/updatecolor/{id}',[agency::class,'updatecolor']);
Route::get('/agency/deletecolor/{id}',[agency::class,'deletecolor']);
Route::get('/agency/size',[agency::class,'size']);
Route::post('/agency/insertsize',[agency::class,'insertsize']);
Route::get('/agency/fetchsize/{id}',[agency::class,'fetchsize']);
Route::post('/agency/updatesize/{id}',[agency::class,'updatesize']);
Route::get('/agency/deletesize/{id}',[agency::class,'deletesize']);
Route::get('/agency/paperstock',[agency::class,'paperstock']);
Route::post('/agency/insertpaperstock',[agency::class,'insertpaperstock']);
Route::get('/agency/fetchpaperstock/{id}',[agency::class,'fetchpaperstock']);
Route::post('/agency/updatepaperstock/{id}',[agency::class,'updatepaperstock']);
Route::get('/agency/deletepaperstock/{id}',[agency::class,'deletepaperstock']);
Route::get('/agency/orderlist',[agency::class,'orderlist']);
Route::get('/agency/orderdetail/{id}',[agency::class,'orderdetail']);











Route::get('/deliveryboy',[deliveryboy::class,'login']);
Route::post('/deliveryboy/auth',[deliveryboy::class,'auth']);
Route::get('/deliveryboy/dashboard',[deliveryboy::class,'dashboard']);
Route::get('/deliveryboy/logout',[deliveryboy::class,'logout']);
Route::get('/deliveryboy/forgetpassword',[deliveryboy::class,'forgetpassword']);
Route::post('/deliveryboy/getlink',[deliveryboy::class,'getlink']);
Route::get('/deliveryboy/resetlink/{token}',[deliveryboy::class,'resetlink']);
Route::post('/deliveryboy/changepass',[deliveryboy::class,'changepass']);
Route::get('/deliveryboy/orderlist',[deliveryboy::class,'orderlist']);
Route::get('/deliveryboy/orderdetail/{oid}',[deliveryboy::class,'orderdetail']);
Route::get('/deliveryboy/profile',[deliveryboy::class,'profile']);
Route::get('/deliveryboy/changepassword',[deliveryboy::class,'changepassword']);
Route::post('/deliveryboy/updatepassword',[deliveryboy::class,'updatepassword']);

