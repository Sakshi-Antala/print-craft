<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\membership;
use App\Models\membership_purchase;
use App\Models\order;
use App\Models\order_detail;
use App\Models\product_attr;
use App\Models\psize;
use App\Models\review;
use App\Models\subcategory;
use App\Models\product;
use App\Models\p_image;
use App\Models\users;
use App\Models\pcolor;
use App\Models\paper_stock;
use App\Models\agency;
use App\Models\coupon;
use App\Models\attributevalue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class admin extends Controller
{
    public function dashboard(){
        $data['product']=product::all();
        $data['order']=order::all();
        $data['agency']=users::where('status',2)->get();
        $data['customer']=users::where('status',1)->get();
        if (session()->has('admin')){
            $data['chart']=\DB::select("select count(o_id) as orders,sum(amount) as amt,SUBSTRING(STR_TO_DATE(o_date,'%d-%m-%Y'),1,7) as month from orders group by month");
            return view('admin.dashboard',$data);
        }else{
            return redirect('admin');
        }
    }
    public function category(){
        $data['category']=category::all();
        if (session()->has('admin')){
            return view('admin.category',$data);
        }else{
            return redirect('admin');
        }

    }
    public function login(){
        return view('admin.login');
    }
    public function auth(Request $request){
        $data=$request->input();
        $request->validate([
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required'
        ]);
        $res=users::where(['email'=>$data['email'],'password'=>$data['password'],'status'=>0])->first();
        if ($res!='')
        {
            session()->put('admin',$res);
            return redirect('admin/dashboard');
        }
        else{
            session()->flash('message','Invalid Email Or Password');
            return redirect('admin');
        }
    }
    public function logout(){
        session()->pull('admin');
        return redirect('admin');
    }
    public function profile(){
        $data['admin']=users::where('status',0)->first();
        return view('admin.profile',$data);
    }
    public function subcategory(){
        $data['data']=category::all();
        $data['subcat']=subcategory::all();
        return view('admin.subcategory',$data);
    }
    public function insertcategory(Request $request){
        $request->validate([
            'cname'=>'required'
        ]);
        $data=$request->input();
        category::create($data);
        session()->flash('catmsg','Category Sucessfully Inserted');
        return redirect('admin/category');
    }
    public function fetchcategory($id){
        $data['cate']=category::where('cat_id',$id)->first();
        return view('admin.updatecategory',$data);
    }
    public function updatecategory(Request $request,$id){
        $data=$request->input();
        $update=array(
            'cname'=>$data['cname']
        );
        category::where('cat_id',$id)->update($update);
        return redirect('admin/category')->with('cmsg','Category Updated Sucessfully');
    }
    public function deletecategory($id){
        category::destroy($id);
        return redirect('admin/category')->with('msg','Record Deleted Sucessfullly');
    }
    public function insertsubcategory(Request $request){
        $request->validate([
            's_c_name'=>'required'
        ]);
        $subdata=$request->input();
        subcategory::create($subdata);
        session()->flash('subcatmsg','Subcategory Sucessfully Inserted');
        return redirect('admin/subcategory');
    }
    public function fetchsubcategory($id){
        $data['subcat']=subcategory::where('sub_cat_id',$id)->first();
        $data['cat']=category::all();
        return view('admin/updatesubcategory',$data);
    }
    public function updatesubcategory(Request $request,$id){
        $data=$request->input();
        $update=array(
            's_c_name'=>$data['s_c_name'],
            'cat_id'=>$data['cat_id']
        );
        subcategory::where('sub_cat_id',$id)->update($update);
        return redirect('admin/subcategory')->with('submsg','Subcategory Updated Sucessfully');
    }
    public function deletesubcategory($id){
        subcategory::destroy($id);
        return redirect('admin/subcategory')->with('msg','Record Deleted Sucessfullly');
    }
    public function getsubcat($id){
        $data=subcategory::where('cat_id',$id)->get();
        foreach ($data as $val){
            echo "<option value=".$val->sub_cat_id.">".$val->s_c_name."</option>";
        }
    }
    public function product(){
        $data['cat']=category::all();
        $data['subcat']=subcategory::where('cat_id',$data['cat'][0]->cat_id)->get();
        $data['product']=\DB::select('select *,(select s_c_name from subcategories where sub_cat_id=products.sub_cat_id) as catname from products');
        
        $data['size']=psize::all();
        $data['color']=pcolor::all();
        $data['paperstock']=paper_stock::all();
        if (session()->has('admin')){
            return view('admin/product',$data);
        }else{
            return redirect('admin');
        }
    }
    public function insertproduct(Request $request){
        $request->validate([
            'desc'=>'required',
            'min_qty'=>'required|numeric',
            'price'=>'required|numeric',
            'pname'=>'required',
            'required_data'=>'required',
            'image.*'=>'required|image|mimes:jpg,jpeg,png'
        ]);
         $data=$request->input();
        echo "<pre>";
         print_r($data);
         $ins=array(
             'pname'=>$data['pname'],
             'p_desc'=>$data['desc'],
             'required_data'=>$data['required_data'],
             'min_qty'=>$data['min_qty'],
             'price'=>$data['price'],
             'sub_cat_id'=>$data['sub_cat_id'],
             'uid'=>1,
         );
        $id=product::create($ins)->pid;
        $p['pid']=$id;
        $image=$request->file('image');
        if ($request->hasFile('image')){
              foreach ($image as $key=>$value){
                  $path=public_path('Assets/img/product-img');
                  $filename=time().$key.'.'.$value->extension();
                  $value->move($path,$filename);
                  $p['url']=$filename;
                  p_image::create($p);
              }
        }
        $attr['pid']=$id;
        if ($request->hasFile('cimage')){
            $image=$request->file('cimage');
            foreach ($image as $key=>$value){
                print_r($value);
                $path=public_path('Assets/img/product-color-img');
                $filename=time().$key.'.'.$value->extension();
                $value->move($path,$filename);
                $attr['url']=$filename;
                $attr['color_id']=$data['color'][$key];
                $attr['size_id']=$data['size'][$key];
                product_attr::create($attr);
            }
        }

//        $attr['pid']=$id;
//        foreach ($data['color'] as $key=>$val){
//            $attr['color_id']=$val;
//            $attr['size_id']=$data['size'][$key];
//
////            product_attr::create($attr);
//        }
//
//        foreach ($data['color'] as $value){
//            $color=array(
//                'pid'=>$id,
//                'type'=>0,
//                'a_id'=>$value
//            );
//            attributevalue::create($color);
//        }
//        foreach ($data['size'] as $value){
//            $size=array(
//                'pid'=>$id,
//                'type'=>1,
//                'a_id'=>$value
//            );
//            attributevalue::create($size);
//        }
//        foreach ($data['paperstock'] as $value){
//            $paperstock=array(
//                'pid'=>$id,
//                'type'=>2,
//                'a_id'=>$value
//            );
//            attributevalue::create($paperstock);
//        }
//        print_r($data['size']);
        return redirect('admin/product')->with('pmsg','Product Inserted Sucessfully');
    }
    public function deleteproduct($id){
        $image=p_image::where('pid',$id)->get();
        if (isset($image[0])){
            foreach ($image as $value){
                unlink("Assets/img/product-img/".$value->url);
            }
        }
        p_image::where('pid',$id)->delete();
        $attr=product_attr::where('pid',$id)->get();
        foreach ($attr as $value){
            unlink("Assets/img/product-color-img/".$value->url);
        }
        product_attr::where('pid',$id)->delete();
        product::destroy($id);
        return redirect('admin/product')->with('msg','Record Deleted Sucessfullly');
    }
    public function fetchproduct($id){
        $data['cat']=category::all();
        $data['color']=pcolor::all();
        $data['size']=psize::all();
        $data['paperstock']=paper_stock::all();
        $data['product']=product::join('subcategories','subcategories.sub_cat_id','=','products.sub_cat_id')->where('pid',$id)->first();
        $data['subcat']=subcategory::where('cat_id',$data['product']['cat_id'])->get();
        $data['attr']=product_attr::leftjoin('psizes','psizes.size_id','product_attrs.size_id')->leftjoin('pcolors','pcolors.color_id','product_attrs.color_id')->where('pid',$data['product']['pid'])->get();
//        echo "<pre>";
//        print_r($data['color']);
        return view('admin.updateproduct',$data);
    }
    public function updateproduct(Request $request,$id){
        $data=$request->input();
        print_r($data);
        $update=array(
            'pname'=>$data['pname'],
            'p_desc'=>$data['desc'],
            'required_data'=>$data['required_data'],
            'min_qty'=>$data['min_qty'],
            'price'=>$data['price'],
            'sub_cat_id'=>$data['sub_cat_id'],
//            'uid'=>1,
        );
        if ($request->hasFile('cimage')) {
            $image=$request->file('cimage');
            foreach ($image as $key => $value) {
                $path = public_path('Assets/img/product-color-img');
                $filename = time() . $key . '.' . $value->extension();
                $value->move($path, $filename);
                $attr['url'] = $filename;
                $attr['color_id'] = $data['color'][$key];
                $attr['size_id'] = $data['size'][$key];
                if ($data['p_a_id'][$key] != '') {
                    $find_attr = product_attr::where('p_a_id',$data['p_a_id'][$key])->first();
                    unlink("Assets/img/product-color-img/" . $find_attr->url);
                    product_attr::where('p_a_id', $data['p_a_id'][$key])->update($attr);
                } else {
                    $attr['pid'] = $id;
                    product_attr::create($attr);
                }
            }
        }
//            foreach ($data['color'] as $key => $val) {
//                $attr['color_id'] = $val;
//                $attr['size_id'] = $data['size'][$key];
//                $attr['p_s_id'] = $data['paperstock'][$key];
//                if ($data['p_a_id'][$key]!='')
//                {
//                    product_attr::where('p_a_id', $data['p_a_id'][$key])->update($attr);
//                }
//                else{
//                    $attr['pid']=$id;
//                    product_attr::create($attr);
//                }
//
//            }
        product::where('pid',$id)->update($update);
        return redirect('admin/product')->with('message','Record Updated Sucessfully');
    }
    public function deleteproductattr($id,$pid){
          $attr=product_attr::find($id);
          unlink("Assets/img/product-color-img/".$attr->url);
          product_attr::destroy($id);
          return redirect('admin/fetchproduct/'.$pid);
    }
    public function getpname($pname){
        $data=product::where('pname',$pname)->first();
        if ($data!=''){
            echo "Product Already Exits";
        }else{
            echo "Product Not Exits";
        }
    }
    public function userlist(){
        $data['user']=users::where('status',1)->get();
        return view('admin.userlist',$data);
    }
//    public function userapproval($id,$val)
//    {
//        $data=users::where('uid',$id)->first();
//        users::where('uid',$data->uid)->update(array('u_approval'=>$val));
//        return redirect('admin/userlist');
//
//    }
    public function agencylist(){
        $data['mspurchase']=membership_purchase::select('membership_purchase.status as type','user.name as name',
            'membership_purchase.p_date as p_date','membership_purchase.e_date as e_date',
        'membership_purchase.transaction_id as transaction_id','membership_purchase.p_amount as p_amount',
            'membership_purchase.mid as mid','user.uid as uid')->join('user','user.uid','membership_purchase.uid')->get();
        $data['agency']=agency::all();
        return view('admin.agencylist',$data);
    }
    public function agencyapproval($id){
        $uid=agency::join('user','user.uid','agencies.uid')->where('agencies.aid',$id)->get();
        agency::where('aid',$id)->update(array('status'=>1));
        users::where('uid',$uid[0]->uid)->update(array('status'=>2));
        return redirect()->back();
    }
    public function coupon(){
        $data['user']=users::where('status',1)->get();
        $data['coupon']=coupon::leftJoin('user','user.uid','coupons.uid')->get();
        return view('admin.coupon',$data);
    }
    public function checkcode($code){
        $coupon=coupon::where('code',$code)->first();
        if ($coupon==''){
            echo "0";
        }else{
            echo "1";
        }
    }
    public function insertcoupon(Request $request){
        $data=$request->input();
        $request->validate([
            'code'=>'required',
            's_date'=>'required',
            'e_date'=>'required',
            'uses'=>'required',
            'min_order'=>'required',
            'amount'=>'required',
            's_date'=>'required',
            'e_date'=>'required'
        ]);
        $coupon=coupon::where('code',$data['code'])->first();
        if ($coupon==''){
            $cinsert=array(
                'code'=>$data['code'],
                'type'=>$data['type'],
                's_date'=>$data['s_date'],
                'e_date'=>$data['e_date'],
                'c_status'=>1,
                'no_of_uses'=>$data['uses'],
                'min_order'=>$data['min_order'],
                'c_amount'=>$data['amount'],
                'uid'=>$data['uid']
            );
            coupon::create($cinsert);
            return redirect('admin/coupon')->with('message','Coupon Inserted Sucessfully');
        }else{
            return redirect('admin/coupon')->with('message','Coupon Already Exits');
        }
    }
    public function fetchcoupon($cid){
        $data['user']=users::where('status',1)->get();
        $data['coupon']=coupon::where('coupon_id',$cid)->first();
        return view('admin.updatecoupon',$data);
    }
    public function updatecoupon(Request $request,$id){
        $data=$request->input();
        $update=array(
            'code'=>$data['code'],
            'type'=>$data['type'],
            's_date'=>$data['s_date'],
            'e_date'=>$data['e_date'],
            'c_status'=>1,
            'no_of_uses'=>$data['uses'],
            'min_order'=>$data['min_order'],
            'c_amount'=>$data['amount'],
            'uid'=>$data['uid']
        );
        coupon::where('coupon_id',$id)->update($update);
        return redirect('admin/coupon')->with('msg','Record Update Successfully');
    }
    public function deletecoupon($id){
        coupon::destroy($id);
        return redirect('admin/coupon')->with('msg','Record Deleted Sucessfullly');
    }
    public function forgetpassword(){
        return view('admin.forgetpassword');
    }
    public function getlink(Request $request){
        $data=$request->input();
        $email=$data['email'];
        $user=users::where('email',$email)->first();
        if($user!=''){
            $data['token']=rand(11111,99999);
            users::where('uid',$user->uid)->update(array('token'=>$data['token']));
            Mail::send('admin.foremail',$data,function ($message) use($email){
               $message->to($email)
                   ->subject('Forget Password Link');
            });
            return redirect('admin')->with('message','Please Check Your Email');
        }else{
            return redirect('admin/forgetpassword')->with('message','This Email Is Not Registered');
        }
    }
    public function resetlink($token){
        $data['token']=$token;
        return view('admin.resetlink',$data);
    }
    public function changepass(Request $request){
        $data=$request->input();
        if ($data['password']==$data['cpassword']){
            $update=array(
                'password'=>$data['password'],
//                'cpassword'=>$data['cpassword'],
                'token'=>''
            );
            users::where('token',$data['token'])->update($update);
            return redirect('admin')->with('message','Password Successfully Changed');
        }else{
            return redirect('/admin/resetlink/'.$data['token'])->with('message','Password Mismatched');
        }
    }
    public function changeadminprofile(Request $request,$id){
        $data=$request->input();
        $update=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'address'=>$data['address'],
        );
        if ($request->hasFile('image')){
            $image=$request->file('image');
            $path=public_path('Assets/admin/admin_image');
            $filename=time().'.'.$image->extension();
            $image->move($path,$filename);
            $update['url']=$filename;
        }
       users::where('uid',$id)->update($update);
       return redirect('admin/profile')->with('message','Profile Updated Sucessfully');
    }
    public function changepassword(){
        return view('admin.changepassword');
    }
    public function updatepassword(Request $request){
        $data=$request->input();
        $user=users::where([['uid',session()->get('admin.uid')],['password',$data['opassword']]])->first();
        if ($user==''){
            return redirect('admin/changepassword')->with('msg','Old Password Is Wrong');
        }else{
            if ($data['password']==$data['cpassword']){
                users::where('uid',$user->uid)->update(array('password'=>$data['password']));
                return redirect('admin/changepassword')->with('msg','Password Changed Successfully');
            }else{
                return redirect('admin/changepassword')->with('msg','New Password And Confrim Password Mismatched');
            }
        }
    }
    public function deliveryboy(){
        $data['user']=users::where('status',3)->get();
        return view('admin.deliveryboy',$data);
    }
    public function insertdeliveryboy(Request $request){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required|numeric|digits:10',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required|same:cpassword',
            'cpassword'=>'required|same:password',
            'dob'=>'required',
            'address'=>'required',
            'pincode'=>'required|numeric|digits:6',
        ]);
        $data=$request->input();
        $dboy=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'password'=>$data['password'],
//            'cpassword'=>$data['cpassword'],
            'dob'=>$data['dob'],
            'address'=>$data['address'],
            'pincode'=>$data['pincode'],
            'status'=>3
        );
        print_r($dboy);
        users::create($dboy);
        return redirect('/admin/deliveryboy')->with('msg','DeliveryBoy Inserted Sucessfully');
    }
    public function fetchdeliveryboy($id){
        $data['user']=users::where([['uid',$id],['status',3]])->first();
        return view('admin.updatedeliveryboy',$data);
    }
    public function updatedeliveryboy(Request $request,$id){
        $data=$request->input();
        $update=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'password'=>$data['password'],
//            'cpassword'=>$data['cpassword'],
            'dob'=>$data['dob'],
            'address'=>$data['address'],
            'pincode'=>$data['pincode'],
        );
        users::where('uid',$id)->update($update);
        return redirect('/admin/fetchdeliveryboy/'.$id)->with('msg','Record Updated Successfully');
    }
    public function deletedeliveryboy($id){
        users::destroy($id);
        return redirect('admin/deliveryboy')->with('message','Record Deleted Sucessfullly');
    }
    public function orderlist(){
        $data['order']=order::orderBy('o_id','DESC')->get();
        $data['deliveryboy']=users::where('status',3)->get();
        return view('admin.orderlist',$data);
    }
    public function assigndeliveryboy(Request $request){
       $data=$request->input();
        print_r($data);
       $update=array(
           'd_b_id'=>$data['d_b_id'],
           'status'=>2
       );
       order::where('o_id',$data['oid'])->update($update);
        return redirect('/admin/orderlist')->with('msg','Order Assigned To Delivery Boy');
    }
    public function orderstatus($oid,$status){
        order::where('o_id',$oid)->update(array('status'=>$status));
        return redirect('/admin/orderlist')->with('msg','Order Status Updated Successfully');
    }
    public function orderdetail($id){
        $data['order']=order::where('o_id',$id)->first();
        $data['odetail']=order_detail::join('products','products.pid','order_details.pid')->where('order_details.o_id',$id)->get();
        return view('admin.orderdetail',$data);
    }
    public function review(){
        $data['review']=review::join('user','user.uid','reviews.uid')->get();
        return view('admin.review',$data);
    }
    public function addmembership(){
        $data['member']=membership::all();
        return view('admin.addmembership',$data);
    }
    public function insertmembership(Request $request){
        $request->validate([
            'membershipname'=>'required',
            'desc'=>'required',
            'price'=>'required|numeric',
            'duration'=>'required|numeric'
        ]);
        $data=$request->input();
        $ins=array(
            'm_title'=>$data['membershipname'],
            'm_desc'=>$data['desc'],
            'price'=>$data['price'],
            'duration'=>$data['duration']
        );
        membership::create($ins);
        return redirect('admin/addmembership')->with('msg','Membership Added Sucessfully');
    }
    public function fetchmembership($id){
        $data['member']=membership::where('mid',$id)->first();
        return view('admin.updatemembership',$data);
    }
    public function updatemembership(Request $request,$id){
        $data=$request->input();
        $update=array(
            'm_title'=>$data['membershipname'],
            'm_desc'=>$data['desc'],
            'price'=>$data['price'],
            'duration'=>$data['duration']
        );
        membership::where('mid',$id)->update($update);
        return redirect('/admin/fetchmembership/'.$id)->with('msg','Record Updated Successfully');
    }
    public function deletemembership($id){
        membership::destroy($id);
        return redirect('admin/addmembership')->with('message','Record Deleted Sucessfullly');
    }
}
