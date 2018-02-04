<?php

namespace app\api\model;

use think\Model;
use think\Db;

class Order extends BaseModel
{
    /**
     * 添加订单信息
     */
    public static function addOrder( $param = [] ){
        if( !is_array($param) || $param == [] ){
            return [];
        }
        Db::name('order')->insert($param);

        $id = Db::name('order')->getLastInsID();

        if( empty($id) || !$id  || $id == 0){
            return 0;
        }

        //创建订单商品表数据

        return $id;
    }

    /**
     * 修改订单状态
     * @param array $param
     */
    public static function updateOrderStatic($param = [] ){

    }

    public static function getSummaryByUser( $uid,$page,$ize){
        $row = [];
        $note = [1=>'未支付',2=>'已支付'];
        $data = Db::name('order')->where(['buyer_id'=>$uid])->order('create_time desc,order_status asc')->select();
        foreach ( $data as$key=> $item){
            $row[$key]['id'] = $item['id'];
            $row[$key]['order_sn'] = $item['order_no'];
            $row[$key]['order_status_text'] = $note[$item['order_status']];
            $row[$key]['actual_price'] = $item['order_money'];
            $row[$key]['handleOption'] = $note[$item['order_status']] == 1 ? true:false;
            $row[$key]['order_type'] = $item['order_type'];
            $row[$key]['point'] = $item['point'];
            $row[$key]['goodsList'] = Db::name('order_product')->where(['order_id'=>$item['id']])->field('num,goods_name,goods_picture')->select()->toArray();
        }

        return $row;
    }
}
