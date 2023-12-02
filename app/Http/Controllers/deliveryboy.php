<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\order_detail;
use App\Models\users;
use Mail;
use Illuminate\Http\Request;

class deliveryboy extends Controller
{
    public function login(){
        return view('deliveryboy.login');
    }
    public function auth(Request $request){
        $data=$request->input();
        $res=users::where(['email'=>$data['email'],'password'=>$data['password'],'status'=>3])->first();
        if ($res!='')
        {
            session()->put('deliveryboy',$res);
            return redirect('deliveryboy/dashboard');
        }
        else{
            session()->flash('message','Invalid Email Or Password');
            return redirect('deliveryboy');
        }
    }
    public function dashboard(){
        $data['order']=order::where('d_b_id',session()->get('deliveryboy.uid'))->get();
        $uid=session()->get('deliveryboy.uid');
        $data['chart']=\DB::select("select count(o_id) as orders,sum(amount) as amt,SUBSTRING(STR_TO_DATE(o_date,'%d-%m-%Y'),1,7) as month from orders  WHERE d_b_id=".$uid." group by month");
        $data['result']=json_decode(json_encode($data['chart']),true);
        if (session()->has('deliveryboy')){
            return view('deliveryboy.dashboard',$data);
        }else{
            return redirect('deliveryboy');
        }

    }
    public function logout(){
        session()->pull('deliveryboy');
        return redirect('deliveryboy');
    }
    public function forgetpassword(){
        return view('deliveryboy.forgetpassword');
    }
    public function getlink(Request $request){
        $data=$request->input();
        $email=$data['email'];
        $user=users::where([['email',$email],['status',3]])->first();
        if($user!=''){
            $data['token']=rand(11111,99999);
            users::where('uid',$user->uid)->update(array('token'=>$data['token']));
            Mail::send('deliveryboy.foremail',$data,function ($message) use($email){
                $message->to($email)
                    ->subject('Forget Password Link');
            });
            return redirect('deliveryboy')->with('message','Please Check Your Email');
        }else{
            return redirect('deliveryboy/forgetpassword')->with('message','This Email Is Not Registered');
        }
    }
    public function resetlink($token){
        $data['token']=$token;
        return view('deliveryboy.resetlink',$data);
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
            return redirect('deliveryboy')->with('message','Password Successfully Changed');
        }else{
            return redirect('/deliveryboy/resetlink/'.$data['token'])->with('message','Password Mismatched');
        }
    }
    public function orderlist(){
        $data['order']=order::where('d_b_id',session()->get('deliveryboy.uid'))->get();
        return view('deliveryboy.orderlist',$data);
    }
    public function orderdetail($oid){
        $data['order']=order::where('o_id',$oid)->first();
        $data['odetail']=order_detail::join('products','products.pid','order_details.pid')->where('o_id',$oid)->get();
        return view('deliveryboy.orderdetail',$data);
    }
    public function profile(){
        $data['agency']=users::where('uid',session()->get('deliveryboy.uid'))->first();
        return view('deliveryboy.profile',$data);
    }
    public function changepassword(){
        return view('deliveryboy.changepassword');
    }
    public function updatepassword(Request $request){
        $data=$request->input();
        $user=users::where([['uid',session()->get('deliveryboy.uid')],['password',$data['opassword']]])->first();
        if ($user==''){
            return redirect('deliveryboy/changepassword')->with('msg','Old Password Is Wrong');
        }else{
            if ($data['password']==$data['cpassword']){
                users::where('uid',$user->uid)->update(array('password'=>$data['password']));
                return redirect('deliveryboy/changepassword')->with('msg','Password Changed Successfully');
            }else{
                return redirect('deliveryboy/changepassword')->with('msg','New Password And Confrim Password Mismatched');
            }
        }
    }
}
