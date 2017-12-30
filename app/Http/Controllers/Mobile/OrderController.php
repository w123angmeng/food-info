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
        return view("mobile/orderConfirm",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    //生成订单
    public function createOrder(){
        $result_c = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $result_sum = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        $result_info = array();
        //判断商品是否存在-商品表
        if (empty($result_c)) {
            $result_info["status"] = 0;
            $result_info["info"] = '提交商品不能为空！';
        }
        //$result_sum = $result_sum[0];
        //订单号12位
        $order_no = "DF".substr(date('Ymd'),-6).rand('1000','9999');
        //订单表中插入数据
        $data = [$order_no,$result_sum[0]->total_price,$result_sum[0]->total_num,date('Y-m-d H:i:s'),session('user')['uid'],session('user')['username'],1,0];
        $result_r = DB::insert('insert into i_order_info (order_no, total_price, total_num, oper_time, uid, username, is_valid, cancle_flag) values (?, ?, ?, ?, ?, ?, ?, ?)', $data);
        if(empty($result_r))
        {
            $result_info["status"] = 0;
            $result_info["info"] = '抱歉，生成订单失败！';
        }
        $result_r = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ? order by oper_time DESC',[date('Y-m-d'),session('user')['uid']]);
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
            //生成订单后清空购物车
            DB::select('DELETE from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
            $result_info["status"] = 1;
            $result_info["info"] = '生成订单成功！';
        }
        else
        {
            $result_info["status"] = 0;
            $result_info["info"] = '订单生成失败！';
        }
        return view("mobile/commonTip",["type" => "order", "result" => $result_info]);
    }
    public function showOrderList(){
        $result_goods = array();
        $result_r = DB::select('select * from i_order_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ?',[date('Y-m-d'),session('user')['uid']]);
        if(!empty($result_r))
        {
            foreach ($result_r as $r)
            {
                $result_g = DB::select('select * from i_order_goods_info where date_format(oper_time,"%Y-%m-%d") = ? and uid = ? and order_id = ?',[date('Y-m-d'),session('user')['uid'],$r->id]);
                $result_goods[$r->id] = $result_g;
            }
        }
        return view("mobile/orderList",["op" => "show", "result" => $result_r,"result_g"=>$result_goods]);
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
