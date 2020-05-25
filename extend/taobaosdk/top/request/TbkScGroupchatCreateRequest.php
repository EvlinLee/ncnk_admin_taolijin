<?php
/**
 * TOP API: taobao.tbk.sc.groupchat.create request
 * 
 * @author auto create
 * @since 1.0, 2019.07.04
 */
class TbkScGroupchatCreateRequest
{
	/** 
	 * 目前一个淘客仅开放1个可以容纳5000人的大群，大群下面有10个小群，每个小群可以容纳500人；当小群加满之后会自动创建另一个新的小群，上限是10个小群
	 **/
	private $subGroupNum;
	
	/** 
	 * 群组名称
	 **/
	private $title;
	
	private $apiParas = array();
	
	public function setSubGroupNum($subGroupNum)
	{
		$this->subGroupNum = $subGroupNum;
		$this->apiParas["sub_group_num"] = $subGroupNum;
	}

	public function getSubGroupNum()
	{
		return $this->subGroupNum;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.sc.groupchat.create";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->title,"title");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
