<?php

namespace App\Http\Controllers\Web;

use Aimeos\Shop\Base\View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \DB;
use \Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function showUser(){
        $result_goods = array();
        $result_u = DB::select('select * from food_info_users');
        return view("web/user",["op" => "show", "result" => $result_u,"result_g"=>$result_goods]);
    }

    public function editUser($id){
        $result_goods = array();
        $result_r = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ?',[date('Y-m-d')]);
        if(!empty($result_r))
        {
            foreach ($result_r as $r)
            {
                $result_g = DB::select('select * from i_order_goods_info where date_format(oper_time,"%Y-%m-%d") = ? and order_id = ?',[date('Y-m-d'),$r->id]);
                $result_goods[$r->id] = $result_g;
            }
        }
        return view("web/orderList",["op" => "show", "result" => $result_r,"result_g"=>$result_goods]);
    }

    public function delUser($id){
        $result = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ? and id = ?',[date('Y-m-d'),session('user')['uid'],$id]);
        if(empty($result))
        {
            array(
                'status' => 0,
                'info' => '删除数据不存在！'
            );
        }
        $result_r = DB::delete('delete from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ? and id = ?',[date('Y-m-d'),session('user')['uid'],$id]);
        $result_g = DB::delete('delete from i_order_goods_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ? and order_id = ?',[date('Y-m-d'),session('user')['uid'],$id]);
        if($result_r && $result_g)
        {
            array(
                'status' => 1,
                'info' => '删除订单成功！'
            );
        }
        array(
            'status' => 0,
            'info' => '删除订单失败！'
        );
    }
}
