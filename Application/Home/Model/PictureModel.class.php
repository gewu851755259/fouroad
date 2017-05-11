<?php

namespace Home\Model;
use Think\Model;

class PictureModel extends Model{
	
	public function getPictureInfo($id){
		if ($id && $id > 0){
			$pictureInfo = $this->field(true)->find($id);
			if (!$pictureInfo){
				$this->error = '无此图片';
			}
		} else {
			$this->error = '图片id错误';
		}
		return $pictureInfo;
	}

}