<?php

namespace App\Http\Controllers\Web;

use Aimeos\Shop\Base\View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \DB;
use \Request;

class OrderController extends Controller
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

    public function showOrderList(){
        $result_goods = array();
        $result_r = DB::select('select * from i_order_info r LEFT join food_info_users u on u.uid = r.uid where date_format(r.oper_time,"%Y-%m-%d") = ? ORDER BY r.uid ASC ',[date('Y-m-d')]);
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

    public function showOrderDetail(){
        $result = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        return view("mobile/cart",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    public function delOrder($id){
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

    //订单统计
    public function showOrderStatistic(){
        var_dump($result_g);
        $result_g = DB::select('select goods_t_id,goods_name,count(goods_num) as total_num,goods_unit,goods_price from i_order_goods_info where date_format(oper_time,"%Y-%m-%d") = ? group by goods_t_id',[date('Y-m-d')]);
        var_dump($result_g);
        return view("web/orderStatistic",["result" => $result_g]);
    }
}
