<?php

namespace App\Http\Controllers\Web;

use Aimeos\Shop\Base\View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \DB;
use \Request;

class GoodsController extends Controller
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

    public function showGoodsList(){
        $date = date('Y-m-d');
        $result = DB::select('select * from i_goods_info where date_format(oper_time,"%Y-%m-%d")=?',[$date]);
        $results_num = DB::select('select sum(num) as total_num,sum(total_price) as total_price from i_goods_cart_info where date_format(oper_time,"%Y-%m-%d")=?', [$date]);
        return view("web/goods",["op" => "show", "result" => $result,"total_num"=>$results_num[0]->total_num,"total_price"=>$results_num[0]->total_price]);
    }

    public function delArticle($id){
        $results = DB::select('select * from food_info_article_category where id =?',[$id]);
        if(empty($results)){
            return array(
                "status" => 0,
                "info" => "该文章分类不存在！"
            );
        }
        $result = DB::delete('delete from food_info_article_category where id =?',[$id]);
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
