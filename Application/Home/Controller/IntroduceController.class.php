<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台公司介绍控制器
 * 主要获取公司介绍聚合数据
 */
class IntroduceController extends HomeController {

	// 公司介绍
    public function index(){

        $category = D('Category')->getTree(39);
        $condition = array();
        $condition['category_id'] = 39;
        $lists    = D('Document')->where($condition)->select();
        $info = D('Document')->detail($lists[0]['id']);
        if(!$info){
        	$this->error($Document->getError());
        }

        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('info',$info);// 详情

                 
        $this->display();
    }
    
}