<?php

/**
 * data
 * @author auto create
 */
class MaterialDto
{
	
	/** 
	 * 后台一级类目
	 **/
	public $category_id;
	
	/** 
	 * 商品优惠券推广链接
	 **/
	public $coupon_click_url;
	
	/** 
	 * 优惠券结束时间
	 **/
	public $coupon_end_time;
	
	/** 
	 * 优惠券面额
	 **/
	public $coupon_info;
	
	/** 
	 * 优惠券剩余量
	 **/
	public $coupon_remain_count;
	
	/** 
	 * 优惠券开始时间
	 **/
	public $coupon_start_time;
	
	/** 
	 * 优惠券总量
	 **/
	public $coupon_total_count;
	
	/** 
	 * 优惠券(商品优惠券推广链接中的券)类型，1 公开券，2 私有券，3 妈妈券
	 **/
	public $coupon_type;
	
	/** 
	 * 商品id
	 **/
	public $item_id;
	
	/** 
	 * 商品淘客链接
	 **/
	public $item_url;
	
	/** 
	 * 佣金比率(%)
	 **/
	public $max_commission_rate;
	
	/** 
	 * 商品妈妈优惠券推广链接
	 **/
	public $mm_coupon_click_url;
	
	/** 
	 * 妈妈优惠券结束时间
	 **/
	public $mm_coupon_end_time;
	
	/** 
	 * 妈妈优惠券面额
	 **/
	public $mm_coupon_info;
	
	/** 
	 * 妈妈优惠券剩余量
	 **/
	public $mm_coupon_remain_count;
	
	/** 
	 * 妈妈优惠券开始时间
	 **/
	public $mm_coupon_start_time;
	
	/** 
	 * 妈妈优惠券总量
	 **/
	public $mm_coupon_total_count;
	
	/** 
	 * 预售有礼-推广链接
	 **/
	public $ysyl_click_url;
	
	/** 
	 * 预售有礼-佣金比例（%）（ 预售有礼活动享受的推广佣金比例，注：推广该活动有特殊分成规则，请详见：https://tbk.bbs.taobao.com/detail.html?appId=45301&postId=9334376 ）
	 **/
	public $ysyl_commission_rate;
	
	/** 
	 * 预售有礼-预估淘礼金（元）
	 **/
	public $ysyl_tlj_face;
	
	/** 
	 * 预售有礼-淘礼金发放时间
	 **/
	public $ysyl_tlj_send_time;
	
	/** 
	 * 预售有礼-淘礼金使用结束时间
	 **/
	public $ysyl_tlj_use_end_time;
	
	/** 
	 * 预售有礼-淘礼金使用开始时间
	 **/
	public $ysyl_tlj_use_start_time;	
}
?>