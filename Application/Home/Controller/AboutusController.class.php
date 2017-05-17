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
 * 前台关于我们控制器
 */
class AboutusController extends HomeController {
	
	// 关于我们首页
	public function index() {
		// 获取关于我们下的子分类
		$category = D ( 'Category' )->getTree ( '45' );
		
		$this->assign ( 'category', $category );
		
		$this->display ();
	}
	
	// 关于我们新闻列表
	public function news_list() {
		// 获取关于我们下的子分类
		$category = D ( 'Category' )->getTree ( '45' );
		
		$this->assign ( 'category', $category );
		
		$this->display ();
	}
	
	// 关于我们新闻详情
	public function news() {
		$this->display ();
	}
	
	// 关于我们方舟团队
	public function team() {
		//
		$home_adv = $this->getBanners ();
		$this->assign ( 'home_adv', $home_adv ); // 主页轮播图
		$this->display ();
	}
	private function getBanners() {
		$home_adv = D ( 'Document' )->lists ( '43' );
		foreach ( $home_adv as $key => $value ) {
			if ($value ['cover_id'] > 0) {
				$picture_info = D ( 'Picture' )->getPictureInfo ( $value ['cover_id'] );
				if ($picture_info) {
					$value ['cover_path'] = $picture_info ['path'];
				} else {
					$value ['cover_path'] = '';
				}
				$home_adv [$key] = $value;
			}
		}
		return $home_adv;
	}
}