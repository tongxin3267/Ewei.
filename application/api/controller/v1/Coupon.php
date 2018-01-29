<?php
/**
 * Created by PhpStorm.
 * User: heyiw
 * Date: 2018/1/29
 * Time: 0:38
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Coupon as CouponModel;
use app\api\service\Token;
use app\api\model\Cart as CartModel;



class Coupon extends  BaseController
{
    public $uid = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->uid = Token::getCurrentUid();
    }

    /**
     * 获取用户优惠券列表
     * @return array
     */
    public function getUserCouponList(){
        $row = ['errmsg'=>'','errno'=>0,'data'=>[]];
        $type = $this->request->param('types',0);

        $row['data']['data'] = CouponModel::userCoupon( $this->uid,$type);
        $row['data']['types'] = $type;

        return $row;
    }


    /**
     * 获取用户优惠券列表
     * @return array
     */
    public function getUseCouponList(){
        $row = ['errmsg'=>'','errno'=>0,'data'=>[]];
        $type = $this->request->param('types',0);
        //购物车商品ID
        $cartListId = [];
        //购物车商品漂总价
        $totalPrice = 0;
        //购物车商品列表
        $cartList = CartModel::getCartAll($this->uid,true);
        foreach ($cartList as $item) {
            $totalPrice += ($item['price']*100)*$item['num'];
            $cartListId[] = $item['goods_id'];
        }

        $row['data']['data'] = CouponModel::useCoupon( $this->uid,$cartListId ,$totalPrice/100);
        $row['data']['types'] = $type;

        return $row;
    }
}