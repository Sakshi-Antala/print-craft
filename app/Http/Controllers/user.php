<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\contactus;
use App\Models\coupon;
use App\Models\membership;
use App\Models\membership_purchase;
use App\Models\order;
use App\Models\order_detail;
use App\Models\p_image;
use App\Models\paper_stock;
use App\Models\pcolor;
use App\Models\product;
use App\Models\product_attr;
use App\Models\psize;
use App\Models\review;
use App\Models\subcategory;
use App\Models\users;
use App\Models\agency;
use App\Models\wishlist;
use DB;
//use Facade\FlareClient\Api;
use Mail;

use Illuminate\Http\Request;

class user extends Controller
{
    public function home(){
        $data['product']=product::join('subcategories','subcategories.sub_cat_id','products.sub_cat_id')->join('categories','categories.cat_id','subcategories.cat_id')->limit(12)->orderBy('products.pid')->get();
        $data['cate']=category::all();
        return view('home',$data);
    }
    public function registration(){
        return view('registration');
    }
    public function login(){
        return view('login');
    }
    public function contact(){
        return view('contact');
    }
    public function addtocart(Request $request){
        $data=$request->input();
        $data['product']=product::find($data['pid']);
        $data['img']=p_image::where('pid',$data['pid'])->first();
        $cart=session()->get('cart');

        print_r($request->items);
        $flag=0;
        $flags=0;

            if ($request->hasFile('uimage')) {
                $flag = 1;
            } else {
                $flag = 0;
                if ($request->hasFile('cus_design')) {
                    $flags = 1;
                } else {
                    $flags = 0;
                }
            }
        if(isset($request->items)) {
            foreach ($request->items as $val) {
                if ($val != '') {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
        }
        if($flag==1 || $flags==1)
        {
            if (!$cart){
                $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]=array(
                    'pid'=>$data['pid'],
                    'pname'=>$data['product']->pname,
                    'price'=>$data['product']->price,
                    'min_qty'=>$data['product']->min_qty,
                    'qty'=>$data['qty'],
                    'size'=>(isset($data['size'])?$data['size']:''),
                    'color'=>(isset($data['color'])?$data['color']:''),
                    'paperstock'=>(isset($data['paperstock'])?$data['paperstock']:''),
                    'url'=>($data['img']!=''?$data['img']->url:'demo.png'),
                );

                if ($request->items!=''){
                    $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['des']=$request->items;
                }
                if ($request->hasFile('uimage')) {
                    $image = $request->file('uimage');
                    $path = public_path('Assets/img/cimage');
                    $filename = time() . '.' . $image->extension();
                    $image->move($path, $filename);
                    $cart[$data['pid'] . (isset($data['color']) ? "_" . $data['color'] : '') . (isset($data['size']) ? "_" . $data['size'] : '') . (isset($data['paperstock']) ? "_" . $data['paperstock'] : '')]['uimage']= $filename;
                }
                if ($request->hasFile('cus_design')){
                    $image=$request->file('cus_design');
                    foreach ($image as $key=>$value){
                        $path=public_path('Assets/img/product-img/custom_design');
                        $filename=time().$key.'.'.$value->extension();
                        $value->move($path,$filename);
                        $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['cus_design'][]=$filename;
                    }
                    $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['url']='';
                }
                session()->put('cart',$cart);
            }else{
                if (isset($cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')])){
                    $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['qty']=$cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['qty']+$data['qty'];
                    session()->put('cart',$cart);
                }else{
                    $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]=array(
                        'pid'=>$data['pid'],
                        'pname'=>$data['product']->pname,
                        'price'=>$data['product']->price,
                        'min_qty'=>$data['product']->min_qty,
                        'qty'=>$data['qty'],
                        'size'=>(isset($data['size'])?$data['size']:''),
                        'color'=>(isset($data['color'])?$data['color']:''),
                        'paperstock'=>(isset($data['paperstock'])?$data['paperstock']:''),
                        'url'=>($data['img']!=''?$data['img']->url:'demo.png'),
                    );
                    if ($request->items!=''){
////                    foreach ($request->items as $key=>$val){
                        $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['des']=$request->items;
////                    }
                    }
                    if ($request->hasFile('uimage')){
                        $image=$request->file('uimage');
                        $path=public_path('Assets/img/cimage');
                        $filename=time().'.'.$image->extension();
                        $image->move($path,$filename);
                        $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['uimage']=$filename;
                    }
                    if ($request->hasFile('cus_design')){
                        $image=$request->file('cus_design');
                        foreach ($image as $key=>$value){
                            $path=public_path('Assets/img/product-img/custom_design');
                            $filename=time().$key.'.'.$value->extension();
                            $value->move($path,$filename);
                            $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['cus_design'][]=$filename;

                        }
                        $cart[$data['pid'].(isset($data['color'])?"_".$data['color']:'').(isset($data['size'])?"_".$data['size']:'').(isset($data['paperstock'])?"_".$data['paperstock']:'')]['url']='';
                    }

                    session()->put('cart',$cart);
                }
            }
            \Session::flash('message','Prodcut Sucessfully Added In cart');
        }
        else
        {
            \Session::flash('message','Please Fill All Required Data Fields');
        }
        return redirect()->back();
    }
    public function shoppingcart(){
        return view('shoppingcart');
    }
    public function updatecart($key,$qty){
        $cart=session()->get('cart');
        $cart[$key]['qty']=$qty;
        session()->put('cart',$cart);
    }
    public function removecart($key){
        $cart=session()->get('cart');
        if (isset($cart[$key])){
            unset($cart[$key]);
        }
        session()->put('cart',$cart);
        return redirect('shoppingcart')->with('message','Item Is Removed From cart');
    }
    public function sessiondestroy(){
        session()->pull('cart');
    }
    public function shop(){
        $data['sub']=subcategory::all();
        $data['color']=pcolor::all();
        $data['size']=psize::all();
        $data['product']=product::paginate(12);
        foreach ($data['product'] as $value){
            $data['image'][$value->pid]=p_image::where('pid',$value->pid)->first();
        }
        return view('shop',$data);
    }
    public function checkout(){
        if (session()->get('user')){
            $data['cart']=session()->get('cart');
            return view('checkout',$data);
        }else{
            return redirect('/login')->with('message','First You have To login For Checkout');
        }

    }
    public function productdetail($id){
        $data['review']=review::join('user','user.uid','reviews.uid')->where('pid',$id)->get();
        $data['product']=product::join('p_images','p_images.pid','products.pid')->where('products.pid',$id)->get();
        $data['paperstock']=paper_stock::all();
        $data['cat']=product::join('subcategories','subcategories.sub_cat_id','products.sub_cat_id')->join('categories','categories.cat_id','subcategories.cat_id')->where('pid',$id)->first();
        $data['attr']=product_attr::leftjoin('psizes','psizes.size_id','product_attrs.size_id')->leftjoin('pcolors','pcolors.color_id','product_attrs.color_id')->where('product_attrs.pid',$data['product'][0]->pid)->get();
        $query="select * from pcolors where color_id IN(select color_id FROM product_attrs,products WHERE product_attrs.pid=products.pid AND products.pid=".$id.")";
        $data['color']=\DB::select($query);
        $query="select * from psizes where size_id IN(select size_id FROM product_attrs,products WHERE product_attrs.pid=products.pid AND products.pid=".$id.")";
        $data['size']=\DB::select($query);
        $data['cresult']=json_decode(json_encode($data['color']),true);
        $data['sresult']=json_decode(json_encode($data['size']),true);
        return view('productdetail',$data);
    }
    public function submit(Request $request){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required|numeric|digits:10',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required|same:cpassword|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'cpassword'=>'required|same:password',
            'dob'=>'required|date_format:d-m-Y',
            'address'=>'required',
            'pincode'=>'required|numeric|digits:6',
            'terms'=>'accepted',
        ]);
        $data=$request->input();
        $insert=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'dob'=>$data['dob'],
            'address'=>$data['address'],
            'pincode'=>$data['pincode'],
            'terms'=>1,
            'status'=>1
        );
        users::create($insert);
        return redirect('login');
    }
    public function logincheck(Request $request){
        $data=$request->input();
        $res=users::where(['email'=>$data['email'],'password'=>$data['password']])->first();
        if ($res!='')
        {
           session()->put('user',$res);
           return redirect('');
        }
        else{
            session()->flash('message','Invalid Email Or Password');
            return redirect('login');
        }
    }
    public function logout(){
//        session()->pull('user');
        session()->flush();
        return redirect('login');
    }
    public function joinasagency(){
        $data['membership']=membership::all();
        return view('membership',$data);
    }
    public function mspurchase($id){
        $data['user']=users::where('uid',session()->get('user.uid'))->first();
        $data['membership']=membership::where('mid',$id)->first();
        return view('mspurchase',$data);
    }
    public function purchase(Request $request){
        $data=$request->input();
        print_r($data);
        $date=date('Y-m-d');
        $edate=date('Y-m-d',strtotime($date.'+'.$data['duration'].' months'));
        $ins=array(
            'mid'=>$data['mid'],
            'uid'=>session()->get('user.uid'),
            'p_amount'=>$data['amount'],
            'transaction_id'=>$data['payment_id'],
            'status'=>0,
            'p_date'=>date('Y-m-d'),
            'e_date'=>$edate
        );
        membership_purchase::create($ins);
    }
    public function agencyform(){
        return view('joinasagency');
    }
    public function insertagency(Request $request,$id){
        $request->validate([
            'a_name'=>'required',
            'gst'=>'required'
        ]);
        $data=$request->input();
        $datacheck=agency::where('uid',session()->get('user.uid'))->first();
        if ($datacheck!=''){
           return redirect()->back()->with('msg','You Are Already Join As Agency');
        }else{
            $agency=array(
                'a_name'=>$data['a_name'],
                'gst'=>$data['gst'],
                'uid'=>$id,
                'status'=>0
            );
            agency::create($agency);
            \Session::flash('message','Your Detail As a Agency Submitted Successfully');
            return redirect('');
        }
    }
    public function sendmail(){
       $data=array(
           'coupon_name'=>'new20',
           'amount'=>20000
       );
       Mail::send('mail',$data,function ($message){
           $email='sakshiantala109@gmail.com';
           $message->to($email)
           ->subject('First Mail');
       });
    }
    public function forgetpass(){
        return view('forgetpass');
    }
    public function getotp(Request $request){
        $data=$request->input();
        $email=$data['email'];
        $user=users::where('email',$email)->first();
        if ($user!=''){
            $data['token']=rand(111111,999999);
            users::where('uid',$user->uid)->update(array('token'=>$data['token']));
            Mail::send('otpmail',$data,function($message)  use($email){
                $message->to($email)
                    ->subject('Otp For Password Recovery');
            });
            session()->flash('msg','Check Your Email For Otp');
            return redirect('otpverification');
        }else{
            return redirect('forgetpass')->with('message','Your Email Is Not Registered');
        }
    }
    public function otpcheck(Request $request){
        $data=$request->input();
        $user=users::where('token',$data['otp'])->first();
        if ($user!=''){
//            return view('resetpassword',$data);
            return redirect('/resetpassword/'.$data['otp']);
        }else{
            return redirect('otpverification')->with('msg','Invalid OTP');
        }
    }
    public function otpverification(){
        return view('otpverification');
    }
    public function resetpassword($otp){
        return view('resetpassword')->with('otp',$otp);
    }
    public function passchange(Request $request){
        $data=$request->input();
        if ($data['password']==$data['cpassword']){
            $update=array(
                'password'=>$data['password'],
//                'cpassword'=>$data['cpassword'],
                'token'=>''
            );
            users::where('token',$data['otp'])->update($update);
            return redirect('login')->with('message','Your Password Is Updated');
        }
        else{
            return redirect('/resetpassword/'.$data['otp'])->with('msg','Your Password Is Mismatched');
        }
    }
    public function couponcheck($code){
        $cart=session()->get('cart');
        $total=0;
        $d['dis']=0;
        $d['err']='';
        $d['amt']=0;
        session()->pull('coupon');
        if ($cart!='') {
            foreach ($cart as $c){
                $total=$total+($c['qty']*$c['price']);
                $d['amt']=$total;
            }
           $coupon=coupon::where([['code',$code],['c_status',1]])->first();
            if (session()->has('user')){
                $uid=session()->get('user.uid');
                $order=order::where([['uid',$uid],['coupon_code',$code]])->get();
            }
           if ($coupon!=''){
               if ($coupon->uid==0 || (session()->has('user') && $coupon->uid==$uid )){
                   if ($total>$coupon->min_order){
                       if(isset($order)){
                           if (count($order)<$coupon->no_of_uses){
                               if ($coupon->type==0){
                                   $dis=$coupon->c_amount;
                               }else{
                                   $dis=$total*$coupon->c_amount/100;
                               }
                               $d['dis']=$dis;
                               $d['err']="Coupon Applied";
                               $d['amt']=$total-$dis;
                               $c=array(
                                   'amt'=>$dis,
                                   'code'=>$code
                               );
                               session()->put('coupon',$c);
                           }else{
                               $d['err']="Your Coupon Usage Limit Is Over";
                           }
                       }else{
                           if ($coupon->type==0){
                               $dis=$coupon->c_amount;
                           }else{
                               $dis=$total*$coupon->c_amount/100;
                           }
                           $d['dis']=$dis;
                           $d['err']="Coupon Applied";
                           $d['amt']=$total-$dis;
                           $c=array(
                               'amt'=>$dis,
                               'code'=>$code
                           );
                           session()->put('coupon',$c);
                       }

                   }else{
                       $d['err']="Coupon Is Not Applicable For This Amount";
                   }
               }else{
                   $d['err']="Invalid Coupon Code";
               }
           }else{
               $d['err']="Invalid Coupon Code";
           }

        }else{
            $d['err']="Your Cart Is Empty";
        }
        echo json_encode($d);
    }
    public function profile(){
        if (session()->has('user')){
            $data['user']=users::where('uid',session()->get('user.uid'))->first();
            return view('profile',$data);
        }else{
            return redirect('/login')->with('message','First You Have To Login');
        }

    }
    public function updateprofile(Request $request){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required|numeric|digits:10',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'dob'=>'required|date_format:d-m-Y',
            'address'=>'required',
            'pincode'=>'required|numeric|digits:6',
        ]);
        $data=$request->input();
        $update=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'dob'=>$data['dob'],
            'address'=>$data['address'],
            'pincode'=>$data['pincode'],
        );
        users::where('uid',session()->get('user.uid'))->update($update);
        return redirect('/profile')->with('msg','Profile Updated Sucessfully');
    }
    public function changepassword(){
        return view('changepassword');
    }
    public function updatepassword(Request $request){
        $data=$request->input();
        $user=users::where([['uid',session()->get('user.uid')],['password',$data['opassword']]])->first();
        if ($user==''){
            return redirect('changepassword')->with('msg','Old Password Is Wrong');
        }else{
            if ($data['password']==$data['cpassword']){
                users::where('uid',$user->uid)->update(array('password'=>$data['password']));
                return redirect('changepassword')->with('msg','Password Changed Successfully');
            }else{
                return redirect('changepassword')->with('msg','New Password And Confrim Password Mismatched');
            }
        }
    }
    public function payment(Request $request){
        $data=$request->input();
        print_r($data);
//        $api=new Api('rzp_test_eWTQ1slSoRjPEG','UYRL0MN0KgyzfNZqmef7b2zu');
//        $payment=$api->payment->fetch($request->payment_id);
        $ins=array(
          'uid'=>session()->get('user.uid'),
          'amount'=>$data['amount'],
          'o_name'=>$data['name'],
          'address'=>$data['address'],
          'city'=>$data['city'],
          'mobile'=>$data['phone'],
          'email'=>$data['email'],
          'pincode'=>$data['pincode'],
          'o_date'=>date('d-m-Y h:s:i'),
          'status'=>0,
          'transaction_id'=>$data['payment_id']
        );
        if (session()->has('coupon')){
            $ins['coupon_code']=session()->get('coupon.code');
            $ins['d_amt']=session()->get('coupon.amt');
        }
        $id=order::create($ins)->id;
        print_r($ins);
        $cart=session()->get('cart');
        foreach ($cart as $value){
           $odetail=array(
             'qty'=>$value['qty'],
              'o_id'=>$id,
              'price'=>$value['price'],
              'pid'=>$value['pid'],
               'color'=>$value['color'],
              'size'=>$value['size'],
               'paperstock'=>$value['paperstock'],
               'logo_url'=>(isset($value['uimage'])?$value['uimage']:''),
               'required_datas'=>(isset($value['des'])?implode(",",$value['des']):''),
               'user_uploaded_design'=>(isset($value['cus_design'])?implode(",",$value['cus_design']):'')
           );
            order_detail::create($odetail);
        }
        print_r($odetail);
        session()->pull('coupon');
        session()->pull('cart');
        \Session::flash('message','Your Order Is Placed');
    }
    public function myorder(){
        if (session()->has('user')){
            $data['order']=order::where('uid',session()->get('user.uid'))->get();
            return view('myorder',$data);
        }else{
            return redirect('/login')->with('message','First You Have To Login');
        }

    }
    public function orderdetail($id){
        $data['order']=order::where('o_id',$id)->first();
        $data['odetail']=order_detail::join('products','products.pid','order_details.pid')->where('order_details.o_id',$id)->get();
        return view('orderdetails',$data);
    }
    public function invoice($id){
        $data['order']=order::where('o_id',$id)->first();
        $data['odetail']=order_detail::join('products','products.pid','order_details.pid')->where('order_details.o_id',$id)->get();
        return view('invoice',$data);
    }
    public function addreview(Request $request){
        $data=$request->input();
        if (session()->has('user')){
            $ins=array(
                'rating'=>$data['rate'],
                'r_desc'=>$data['r_desc'],
                'pid'=>$data['pid'],
                'uid'=>session()->get('user.uid')
            );
            review::create($ins);
            return redirect('/productdetail/'.$data['pid'])->with('msg','Your Review Is Submitted');
        }else{
            return redirect('/login')->with('message','To Give Review You Have Login First');
        }
    }
    public function wishlist($id){
        if (session()->has('user')){
            $ins=array(
              'pid'=>$id,
              'uid'=>session()->get('user.uid')
            );
            wishlist::create($ins);
            \Session::flash('message','Prodcut Added In Wishlist');
            return redirect()->back();
        }else{
            return redirect('/login')->with('message','First You Have To Login');
        }
    }
    public function displaywishlist(){
        $data['wishlist']=wishlist::join('products','products.pid','wishlists.pid')->where('wishlists.uid',session()->get('user.uid'))->get();
        foreach ($data['wishlist'] as $value){
            $data['pimage'][$value->pid]=product::join('p_images','p_images.pid','products.pid')->where('products.pid',$value->pid)->first();
            $data['attr'][$value->pid]=product_attr::leftjoin('psizes','psizes.size_id','product_attrs.size_id')->leftjoin('pcolors','pcolors.color_id','product_attrs.color_id')->where('product_attrs.pid',$value->pid)->first();
        }
        return view('displaywishlist',$data);
    }
    public function removewishlist($id){
        wishlist::where('pid',$id)->delete();
        return redirect()->back()->with('message','Product Removed From Wishlist');
    }
    public function contactus(Request $request){
        $request->validate([
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'name'=>'required',
            'message'=>'required'
        ]);
        $data=$request->input();
        $ins=array(
            'name'=>$data['name'],
            'email'=>$data['email'],
            'message'=>$data['message']
        );
        contactus::create($ins);
        return redirect('/contact')->with('message','Your Message Is Sent');
    }
    public function categoryproduct($id){
        $data['sub']=subcategory::where('cat_id',$id)->get();
        $data['color']=pcolor::all();
      $data['product']=product::leftjoin('subcategories','subcategories.sub_cat_id','products.sub_cat_id')->leftjoin('categories','categories.cat_id','subcategories.cat_id')->where('categories.cat_id',$id)->get();
        foreach ($data['product'] as $value){
            $data['image'][$value->pid]=p_image::where('pid',$value->pid)->first();
        }
        return view('categoryshop',$data);
    }
    public function subcribe(Request $request){
        $data=$request->input();
        $email=$data['email'];
        if ($email!=''){
            Mail::send('subcribe',$data,function($message)  use($email){
                $message->to($email)
                    ->subject('Subscribe To Vistaprint');
            });
            return redirect()->back()->with('msg','You Will Receive All Notification From Vistaprint');
        }
    }
    public function facebookwithlogin(Request $request)
    {
        $data=$request->input();
        $user=users::where('email',$data['email'])->first();
        if($user!='')
        {
            session()->put('user',$user);
            $result=1;
        }
        else
        {
            $ins=array(
                'name'=>$data['name'],
                'mobile'=>'8738383838',
                'email'=>$data['email'],
                'password'=>$data['name'].'@123',
                'dob'=>'12-02-2000',
                'address'=>'surat',
                'pincode'=>'395010',
                'status'=>1,
            );
            $id=users::create($ins)->uid;
            $user=users::where('uid',$id)->first();
            session()->put('user',$user);
            $result=0;
        }
        echo $result;
    }
    public function filter(Request $request){
        $data=$request->input();
        $query='';
        $query.="select products.pid,products.pname,products.price from products,product_attrs where products.pid=product_attrs.pid";
        if (isset($data['min']) && $data['min']!=''){
            $query.=" AND products.price>=".$data['min'];
        }
        if (isset($data['max']) && $data['max']!=''){
            $query.=" AND products.price<=".$data['max'];
        }
        if (isset($data['cat']) && count($data['cat'])>0){
            $query.=" AND products.sub_cat_id IN (";
            foreach ($data['cat'] as $key=>$val){
                if ($key!=count($data['cat'])-1){
                    $query.=$val.",";
                }else{
                    $query.=$val;
                }
            }
            $query.=")";
        }
        if (isset($data['col']) && count($data['col'])>0){
            $query.=" AND product_attrs.color_id IN (";
            foreach ($data['col'] as $key=>$val){
                if ($key!=count($data['col'])-1){
                    $query.=$val.",";
                }else{
                    $query.=$val;
                }
            }
            $query.=")";
        }
        if (isset($data['sizes']) && count($data['sizes'])>0){
            $query.=" AND product_attrs.size_id IN (";
            foreach ($data['sizes'] as $key=>$val){
                if ($key!=count($data['sizes'])-1){
                    $query.=$val.",";
                }else{
                    $query.=$val;
                }
            }
            $query.=")";
        }
        $query.=" Group by products.pid";
        $data['pro']=\DB::select($query);
        $data['sub']=subcategory::all();
        $data['color']=pcolor::all();
        $data['size']=psize::all();
        foreach ($data['pro'] as $value){
            $data['image'][$value->pid]=p_image::where('pid',$value->pid)->first();
        }
        return view('filterdata',$data);
    }
    public function filtercategory(Request $request){
        $data=$request->input();
        $query='';
        $query.="select products.pid,products.pname,products.price from products,product_attrs where products.pid=product_attrs.pid";
        if (isset($data['min']) && $data['min']!=''){
            $query.=" AND products.price>=".$data['min'];
        }
        if (isset($data['max']) && $data['max']!=''){
            $query.=" AND products.price<=".$data['max'];
        }
        if (isset($data['cat']) && count($data['cat'])>0){
            $query.=" AND products.sub_cat_id IN (";
            foreach ($data['cat'] as $key=>$val){
                if ($key!=count($data['cat'])-1){
                    $query.=$val.",";
                }else{
                    $query.=$val;
                }
            }
            $query.=")";
        }
        if (isset($data['col']) && count($data['col'])>0){
            $query.=" AND product_attrs.color_id IN (";
            foreach ($data['col'] as $key=>$val){
                if ($key!=count($data['col'])-1){
                    $query.=$val.",";
                }else{
                    $query.=$val;
                }
            }
            $query.=")";
        }
        $query.=" Group by products.pid";
        $data['pro']=\DB::select($query);
        $data['sub']=subcategory::where('cat_id',$data['cat_id'])->get();
        $data['color']=pcolor::all();
        foreach ($data['pro'] as $value){
            $data['image'][$value->pid]=p_image::where('pid',$value->pid)->first();
        }
        return view('categoryfilterdata',$data);
    }
    public function search(Request $request){
        $data=$request->input();
        $data['search']=$data['pname'];
        $query="select * from products where pname LIKE '%{$data['pname']}%'";
        $data['product']=\DB::select($query);
        foreach ($data['product'] as $value){
            $data['image'][$value->pid]=p_image::where('pid',$value->pid)->first();
        }
        return view('searchitem',$data);
    }
}
