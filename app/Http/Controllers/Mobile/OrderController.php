<?php

namespace App\Http\Controllers\Mobile;

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

    public function showConfirmOrder(){
        $result = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        return view("mobile/confirmOrder",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    //生成订单
    public function createOrder(){
        $result_c = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $result_sum = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        //判断商品是否存在-商品表
        if (empty($result_c)) {
            return array(
                "status" => 0,
                "info" => "提交商品不能为空！"
            );
        }
        $result_sum = $result_sum[0];
        //订单号12位
        $order_no = "DF".substr(date('Ymd'),-6).rand('1000','9999');
        //订单表中插入数据
        $data = [$order_no,$result_sum->total_price,$result_sum->total_num,date('Y-m-d H:i:s'),session('user')['uid'],session('user')['username'],1,0];
        $result_r = DB::insert('insert into i_order_info (order_no, total_price, total_num, oper_time, uid, username, is_valid, cancle_flag) values (?, ?, ?, ?, ?, ?, ?, ?)', $data);
        if(empty($result_r))
        {
            return array(
                "status" => 0,
                "info" => "抱歉，生成订单失败！"
            );
        }
        $result_r = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $result_r = $result_r[0];
        $flag = true;
        //订单商品表中插入数据
        foreach ($result_c as $item)
        {
            $item_data = [$result_r->id,$result_r->order_no,$item->t_id,$item->t_id,
                $item->name,$item->num,$item->unit,$item->price,$item->total_price,
                date('Y-m-d H:i:s'),session('user')['uid'],
                session('user')['username'],1,0];
            $result_item = DB::insert('insert into i_order_goods_info 
                (order_id, order_no, goods_id, goods_t_id, goods_name, goods_num, goods_unit,
                 goods_price, total_price, oper_time, uid, username, is_valid,
                  cancle_flag) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $item_data);
            if(empty($result_item))
            {
                $flag = false;
            }
        }
        if($flag)
        {
            return array(
                "status" => 1,
                "info" => "生成订单成功！"
            );
        }
        return array(
            "status" => 0,
            "info" => "订单生成失败！"
        );
    }
    public function showOrderList(){
        $result = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        return view("mobile/cart",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    public function showOrderDetail(){
        $result = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        return view("mobile/cart",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    public function delOrder(){
        $result = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        return view("mobile/cart",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }



    public function delGoodsFromCart($id){
        $results = DB::select('select * from i_goods_cart_info where t_id =? and date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[$id,date('Y-m-d'),session('user')['uid']]);
        if(empty($results)){
            return array(
                "status" => 0,
                "info" => "该商品不存在！"
            );
        }
        $result = DB::delete('delete from i_goods_cart_info where t_id =? and date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[$id,date('Y-m-d'),session('user')['uid']]);
        if($result){
            return array(
                "status" => 1,
                "info" => "更新数据成功！"
            );
        }
        return array(
            "status" => 0,
            "info" => "更新数据失败！"
        );
    }
}
