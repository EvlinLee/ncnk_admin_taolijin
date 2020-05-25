<?php
/**
 * TOP API: taobao.tbk.sc.groupchat.message.send request
 * 
 * @author auto create
 * @since 1.0, 2019.07.04
 */
class TbkScGroupchatMessageSendRequest
{
	/** 
	 * 券id
	 **/
	private $activityId;
	
	/** 
	 * 强制定向，通用佣金结算
	 **/
	private $dx;
	
	/** 
	 * 消息发送群组id列表，逗号分隔
	 **/
	private $groupIds;
	
	/** 
	 * 商品id
	 **/
	private $itemId;
	
	/** 
	 * 加密e参数
	 **/
	private $me;
	
	/** 
	 * 淘客pid
	 **/
	private $pid;
	
	/** 
	 * 消息文本
	 **/
	private $text;
	
	private $apiParas = array();
	
	public function setActivityId($activityId)
	{
		$this->activityId = $activityId;
		$this->apiParas["activity_id"] = $activityId;
	}

	public function getActivityId()
	{
		return $this->activityId;
	}

	public function setDx($dx)
	{
		$this->dx = $dx;
		$this->apiParas["dx"] = $dx;
	}

	public function getDx()
	{
		return $this->dx;
	}

	public function setGroupIds($groupIds)
	{
		$this->groupIds = $groupIds;
		$this->apiParas["group_ids"] = $groupIds;
	}

	public function getGroupIds()
	{
		return $this->groupIds;
	}

	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId()
	{
		return $this->itemId;
	}

	public function setMe($me)
	{
		$this->me = $me;
		$this->apiParas["me"] = $me;
	}

	public function getMe()
	{
		return $this->me;
	}

	public function setPid($pid)
	{
		$this->pid = $pid;
		$this->apiParas["pid"] = $pid;
	}

	public function getPid()
	{
		return $this->pid;
	}

	public function setText($text)
	{
		$this->text = $text;
		$this->apiParas["text"] = $text;
	}

	public function getText()
	{
		return $this->text;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.sc.groupchat.message.send";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->groupIds,"groupIds");
		RequestCheckUtil::checkNotNull($this->pid,"pid");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
