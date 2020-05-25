<?php


namespace app\common\model;


use think\Model;

class Base extends Model
{
    protected $connection = [
        // 数据库类型
        'type'            => 'mysql',
        // 服务器地址
        'hostname'        => '39.99.161.5',
        // 数据库名
        'database'        => 'taolijin_nianchu',
        // 用户名
        'username'        => 'taolijin_nianchu',
        // 密码
        'password'        => 'Hs32KHLNwDsycMjx',
        // 数据库编码默认采用utf8
        'charset'=>'utf8',
        // 数据库端口
        'hostport'=>3306,
        // 自动写入时间戳字段
        'datetime_format'=>false,
        // 数据库表前缀
        'prefix'=>'',
        // 数据库调试模式
        'debug'=>false,
    ];
}