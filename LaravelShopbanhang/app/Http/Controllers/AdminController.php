<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Login; //sử dụng model Login
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{

    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');

        if($authUser){
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('login_normal',true);
        Session::put('admin_id',$account_name->admin_id);
    }elseif($customer_new){
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('login_normal',true);
        Session::put('admin_id',$account_name->admin_id);
    }

     return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();

        if($authUser){

            return $authUser;
        }else{
           $customer_new = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

           $orang = Login::where('admin_email',$users->email)->first();

           if(!$orang){
            $orang = Login::create([
                'admin_name' => $users->name,
                'admin_email' => $users->email,
                'admin_password' => '',

                'admin_phone' => '',
                'admin_status' => 1
            ]);
        }
        $customer_new->login()->associate($orang);
        $customer_new->save();
        return $customer_new;

        }
      
       



    }





    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->admin_id);
            
        }else{

            $admin_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''
     

                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $account_name = Login::where('admin_id',$admin_login->user)->first();
            Session::put('admin_name',$admin_login->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$admin_login->admin_id);
           
        } 
         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }





    public function AuthLogin(){
  
        $admin_id = Session::get('admin_id'); 
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
             return Redirect::to('admin')->send();

        }

    
}
    public function index(){
    	 return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $data = $request->all();
    	$admin_email = $data['admin_email'];
    	$admin_password = md5($data['admin_password']);

    	$login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        
        if($login){
         //    $login_count = $login->count();
        	// if($login_count){
        		Session::put('admin_name',$login->admin_name);
        		Session::put('admin_id',$login->admin_id);
        		return Redirect::to('/dashboard');
        	// }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại');
                return Redirect::to('/admin');
            }
    }
     public function logout(){
        $this->AuthLogin();
     	Session::put('admin_name',null);
    		Session::put('admin_id',null); 
            Session::put('login_normal',null);   
    		return Redirect::to('/admin');     
    }
}
