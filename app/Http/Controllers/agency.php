<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\order_detail;
use App\Models\users;
use App\Models\category;
use App\Models\product_attr;
use App\Models\psize;
use App\Models\subcategory;
use App\Models\product;
use App\Models\p_image;
use App\Models\pcolor;
use App\Models\paper_stock;
use Illuminate\Http\Request;
use Mail;

class agency extends Controller
{
    public function dashboard(){
        if (session()->has('agency')){
            $data['product']=product::where('uid',session()->get('agency.uid'))->get();
            $data['order']=product::join('order_details','order_details.pid','products.pid')
                ->join('orders','orders.o_id','order_details.o_id')->select(\DB::raw('count(products.pid)'))
                ->groupBy('orders.o_id')->where('products.uid',session()->get('agency.uid'))->get();
            $uid=session()->get('agency.uid');
            $data['chart']=\DB::select("SELECT COUNT(o_id) as ord,sum(amount) as amt,SUBSTRING(STR_TO_DATE(o_date,'%d-%m-%Y'),1,7) as month FROM orders WHERE o_id IN (SELECT o_id FROM order_details,products where order_details.pid=products.pid AND products.uid=".$uid.") GROUP BY month");
            $data['result']=json_decode(json_encode($data['chart']),true);
            return view('agency.dashboard',$data);
        }else{
            return redirect('agency');
        }
    }
    public function login(){
        return view('agency.login');
    }
    public function auth(Request $request){
        $data=$request->input();
        $res=users::where(['email'=>$data['email'],'password'=>$data['password'],'status'=>2])->first();
        if ($res!='')
        {
            session()->put('agency',$res);
            return redirect('agency/dashboard');
        }
        else{
            session()->flash('message','Invalid Email Or Password');
            return redirect('agency');
        }
    }
    public function logout(){
        session()->pull('agency');
        return redirect('agency');
    }
    public function product(){
        $data['cat']=category::all();
        $data['subcat']=subcategory::where('cat_id',$data['cat'][0]->cat_id)->get();
        $data['product']=product::where('uid',session()->get('agency.uid'))->get();
        $data['size']=psize::all();
        $data['color']=pcolor::all();
        $data['paperstock']=paper_stock::all();
        if (session()->has('agency')){
            return view('agency/product',$data);
        }else{
            return redirect('agency');
        }
    }
    public function getpname($pname){
        $data=product::where('pname',$pname)->first();
        if ($data!=''){
            echo "Product Already Exits";
        }else{
            echo "Product Not Exits";
        }
    }
    public function getsubcat($id){
        $data=subcategory::where('cat_id',$id)->get();
        foreach ($data as $val){
            echo "<option value=".$val->sub_cat_id.">".$val->s_c_name."</option>";
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
        $ins=array(
            'pname'=>$data['pname'],
            'p_desc'=>$data['desc'],
            'required_data'=>$data['required_data'],
            'min_qty'=>$data['min_qty'],
            'price'=>$data['price'],
            'sub_cat_id'=>$data['sub_cat_id'],
            'uid'=>session()->get('agency.uid'),
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
        }else{
            foreach ($data['size'] as $key=>$val){
//            $attr['color_id']=$val;
            $attr['size_id']=$data['size'][$key];
            product_attr::create($attr);
             }
        }
        return redirect('agency/product')->with('pmsg','Product Inserted Sucessfully');
    }
    public function fetchproduct($id){
        $data['cat']=category::all();
        $data['color']=pcolor::all();
        $data['size']=psize::all();
        $data['paperstock']=paper_stock::all();
        $data['image']=p_image::where('pid',$id)->get();
        $data['product']=product::join('subcategories','subcategories.sub_cat_id','=','products.sub_cat_id')->where('pid',$id)->first();
        $data['subcat']=subcategory::where('cat_id',$data['product']['cat_id'])->get();
        $data['attr']=product_attr::leftjoin('psizes','psizes.size_id','product_attrs.size_id')->leftjoin('pcolors','pcolors.color_id','product_attrs.color_id')->where('pid',$data['product']['pid'])->get();
        return view('agency.updateproduct',$data);
    }
    public function updateproduct(Request $request,$id){
        $data=$request->input();
        $sak=array();
        print_r($data['p_a_id']);
//        foreach ($data['p_a_id'] as $key=>$value){
//            if ($value==''){
//                $sak[$key]=$value;
//            }
//        }
        $d=array_keys($sak);
        $update=array(
            'pname'=>$data['pname'],
            'p_desc'=>$data['desc'],
            'required_data'=>$data['required_data'],
            'min_qty'=>$data['min_qty'],
            'price'=>$data['price'],
            'sub_cat_id'=>$data['sub_cat_id'],
        );
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
        if ($request->hasFile('cimage')) {
            $image=$request->file('cimage');
            foreach ($image as $key=>$value) {
                $path = public_path('Assets/img/product-color-img');
                $filename = time() . $key . '.' . $value->extension();
                $value->move($path, $filename);
                $attr['url'] = $filename;
                $attr['color_id'] = $data['color'][$key];
                $attr['size_id'] = $data['size'][$key];
                if ($data['p_a_id'][$key] != '') {
                    $find_attr = product_attr::where('p_a_id',$data['p_a_id'][$key])->first();
//                    unlink("Assets/img/product-color-img/" . $find_attr->url);
                    product_attr::where('p_a_id', $data['p_a_id'][$key])->update($attr);
                } else {
                    $attr['pid'] = $id;
                    product_attr::create($attr);
                }
            }
        }else{
            foreach ($data['size'] as $key => $val) {
                $attr['size_id'] = $data['size'][$key];
                if ($data['p_a_id'][$key]!='')
                {
                    product_attr::where('p_a_id', $data['p_a_id'][$key])->update($attr);
                }
                else{
                    $attr['pid']=$id;
                    product_attr::create($attr);
                }
            }
        }
        product::where('pid',$id)->update($update);
        return redirect('agency/fetchproduct/'.$id)->with('message','Record Updated Sucessfully');
    }
    public function deleteimage($id,$pid){
        $image=p_image::where('p_i_id',$id)->get();
        if (isset($image[0])){
            foreach ($image as $value){
                unlink("Assets/img/product-img/".$value->url);
            }
        }
        p_image::where('p_i_id',$id)->delete();
        return redirect('agency/fetchproduct/'.$pid)->with('message','Record Updated Sucessfully');
    }
    public function deleteproductattr($id,$pid){
        $attr=product_attr::find($id);
        if ($attr->url!=''){
            unlink("Assets/img/product-color-img/".$attr->url);
        }
        product_attr::destroy($id);
        return redirect('agency/fetchproduct/'.$pid);
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
        return redirect('agency/product')->with('msg','Record Deleted Sucessfullly');
    }
    public function forgetpassword(){
        return view('agency.forgetpassword');
    }
    public function getlink(Request $request){
        $data=$request->input();
        $email=$data['email'];
        $user=users::where([['email',$email],['status',2]])->first();
        if($user!=''){
            $data['token']=rand(11111,99999);
            users::where('uid',$user->uid)->update(array('token'=>$data['token']));
            Mail::send('agency.foremail',$data,function ($message) use($email){
                $message->to($email)
                    ->subject('Forget Password Link');
            });
            return redirect('agency')->with('message','Please Check Your Email');
        }else{
            return redirect('agency/forgetpassword')->with('message','This Email Is Not Registered');
        }
    }
    public function resetlink($token){
        $data['token']=$token;
        return view('agency.resetlink',$data);
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
            return redirect('agency')->with('message','Password Successfully Changed');
        }else{
            return redirect('/agency/resetlink/'.$data['token'])->with('message','Password Mismatched');
        }
    }
    public function profile(){
        $data['agency']=users::where('uid',session()->get('agency.uid'))->first();
        return view('agency.profile',$data);
    }
    public function changepassword(){
        return view('agency.changepassword');
    }
    public function updatepassword(Request $request){
        $data=$request->input();
        $user=users::where([['uid',session()->get('agency.uid')],['password',$data['opassword']]])->first();
        if ($user==''){
            return redirect('agency/changepassword')->with('msg','Old Password Is Wrong');
        }else{
            if ($data['password']==$data['cpassword']){
                users::where('uid',$user->uid)->update(array('password'=>$data['password']));
                return redirect('agency/changepassword')->with('msg','Password Changed Successfully');
            }else{
                return redirect('agency/changepassword')->with('msg','New Password And Confrim Password Mismatched');
            }
        }
    }
    public function changeagencyprofile(Request $request){
        $data=$request->input();
        $update=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'address'=>$data['address'],
        );
        users::where('uid',session()->get('agency.uid'))->update($update);
        return redirect('agency/profile')->with('message','Profile Updated Sucessfully');
    }
    public function color(){
        $data['color']=pcolor::all();
        return view('agency.color',$data);
    }
    public function insertcolor(Request $request){
        $request->validate([
            'color'=>'required',
        ]);
        $data=$request->input();
        $obj=new pcolor();
        $obj->name=$data['color'];
        $obj->save();
        session()->flash('pcolor','Color Inserted Sucessfully');
        return redirect('agency/color');
    }
    public function fetchcolor($id){
        $data['color']=pcolor::where('color_id',$id)->first();
        return view('agency.updatecolor',$data);
    }
    public function updatecolor(Request $request,$id){
        $data=$request->input();
        $update=array(
            'name'=>$data['color']
        );
        pcolor::where('color_id',$id)->update($update);
        return redirect('agency/color')->with('cmsg','Color Updated Sucessfully');
    }
    public function deletecolor($id){
        pcolor::destroy($id);
        return redirect('agency/color')->with('msg','Record Deleted Sucessfullly');
    }
    public function size(){
        $data['size']=psize::all();
        return view('agency.size',$data);
    }
    public function insertsize(Request $request){
        $request->validate([
            'size'=>'required',
        ]);
        $data=$request->input();
        $obj=new psize();
        $obj->size=$data['size'];
        $obj->save();
        session()->flash('psize','Size Inserted Sucessfully');
        return redirect('agency/size');
    }
    public function fetchsize($id){
        $data['size']=psize::where('size_id',$id)->first();
        return view('agency.updatesize',$data);
    }
    public function updatesize(Request $request,$id){
        $data=$request->input();
        $update=array(
            'size'=>$data['size']
        );
        psize::where('size_id',$id)->update($update);
        return redirect('agency/size')->with('cmsg','Size Updated Sucessfully');
    }
    public function deletesize($id){
        psize::destroy($id);
        return redirect('agency/size')->with('msg','Record Deleted Sucessfullly');
    }
    public function paperstock(){
        $data['pstock']=paper_stock::all();
        return view('agency.paperstock',$data);
    }
    public function insertpaperstock(Request $request){
        $request->validate([
            'paperstock'=>'required',
        ]);
        $data=$request->input();
        $obj=new paper_stock();
        $obj->m_type=$data['paperstock'];
        $obj->save();
        session()->flash('pmsg','Paperstock Inserted Sucessfully');
        return redirect('agency/paperstock');
    }
    public function fetchpaperstock($id){
        $data['paperstock']=paper_stock::where('p_s_id',$id)->first();
        return view('agency.updatepaperstock',$data);
    }
    public function updatepaperstock(Request $request,$id){
        $data=$request->input();
        $update=array(
            'm_type'=>$data['paperstock']
        );
        paper_stock::where('p_s_id',$id)->update($update);
        return redirect('agency/paperstock')->with('cmsg','Paperstock Updated Sucessfully');
    }
    public function deletepaperstock($id){
        paper_stock::destroy($id);
        return redirect('agency/paperstock')->with('msg','Record Deleted Sucessfullly');
    }
    public function orderlist(){
        $data['order']=product::join('order_details','order_details.pid','products.pid')
            ->join('orders','orders.o_id','order_details.o_id')->select('orders.*',\DB::raw('count(products.pid)'))
            ->groupBy('orders.o_id')
            ->where('products.uid',session()->get('agency.uid'))->get();
        return view('agency.orderlist',$data);
    }
    public function orderdetail($id){
        $data['order']=order::where('o_id',$id)->first();
        $data['odetail']=order_detail::join('products','products.pid','order_details.pid')->where('order_details.o_id',$id)->get();
        return view('agency.orderdetail',$data);
    }
}
