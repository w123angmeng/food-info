<?php

namespace App\Http\Controllers\Mobile;

use Aimeos\Shop\Base\View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \DB;
use \Request;

class CartController extends Controller
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

    public function showCart(){
        $result = DB::select('select * from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d") = ?',[date('Y-m-d')]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=?',[date('Y-m-d')]);
        return view("mobile/cart",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    //添加商品到购物车
    public function addGoodsToCart(){
        $id = $_POST["id"];
        $num = $_POST["num"];
        $today = date('Y-m-d');
        $result_g = DB::select('select * from i_goods_info where t_id =? and date_format(oper_time,"%Y-%m-%d") = ?', [$id, $today]);
        //判断商品是否存在-商品表
        if (empty($result_g)) {
            return array(
                "status" => 0,
                "info" => "该商品不存在！请刷新页面，重新选购"
            );
        }
        $result_g = $result_g[0];
        //判断商品是否存在-购物车
        $result = "";
        $result_c = DB::select('select * from i_goods_cart_info where t_id =? and date_format(oper_time,"%Y-%m-%d")=?', [$id, $today]);
        if (empty($result_c)) {
            //添加
            $data = [$result_g->t_id, $result_g->name, $result_g->image, $result_g->price, $num, $result_g->unit, $result_g->price*$num, date('Y-m-d H:i:s')];
            $result = DB::insert('insert into i_goods_cart_info (t_id, name, image, price, num,unit,total_price,oper_time) values (?, ?, ?, ?, ?, ?, ?, ?)', $data);
        } else {
            $result_c = $result_c[0];
            //编辑
            $data = [$result_c->num + $num,$result_c->price*($result_c->num + $num), $id, $today];
            $result = DB::update('update i_goods_cart_info set num = ? ,total_price = ? where t_id = ? and date_format(oper_time,"%Y-%m-%d")=?', $data);
        }
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=?', [$today]);
        if ($result) {
            return array(
                "status" => 1,
                "total_num" => $results_num[0]->total_num,
                "total_price"=> $results_num[0]->total_price,
                "info" => "添加成功！"
            );
        }
        return array(
            "status" => 0,
            "total_num" => $results_num[0]->total_num,
            "total_price"=> $results_num[0]->total_price,
            "info" => "添加失败！"
        );
    }

    public function delGoodsFromCart($id){
        $results = DB::select('select * from i_goods_cart_info where t_id =? and date_format(oper_time,"%Y-%m-%d") = ?',[$id,date('Y-m-d')]);
        if(empty($results)){
            return array(
                "status" => 0,
                "info" => "该商品不存在！"
            );
        }
        $result = DB::delete('delete from i_goods_cart_info where t_id =? and date_format(oper_time,"%Y-%m-%d") = ?',[$id,date('Y-m-d')]);
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
