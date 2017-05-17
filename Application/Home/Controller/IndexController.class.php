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
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {
	
	// 系统首页
	public function index() {
		
		$category = D ( 'Category' )->getTree ( '40' );
		$lists = D ( 'Document' )->lists ( null );
		
		$this->assign ( 'category', $category ); // 栏目
		$this->assign ( 'lists', $lists ); // 列表
		$this->assign ( 'page', D ( 'Document' )->page ); // 分页
		
		$home_one = D ( 'Document' )->lists ( '41' );
		$home_two = D ( 'Document' )->lists ( '42' );
		foreach ( $home_one as $key => $value ) {
			$info = D ( 'Document' )->detail ( $value ['id'] );
			if ($value ['cover_id'] > 0) {
				$picture_info = D ( 'Picture' )->getPictureInfo ( $value ['cover_id'] );
				if ($picture_info) {
					$value ['cover_path'] = $picture_info ['path'];
				} else {
					$value ['cover_path'] = '';
				}
			}
			$data = array_merge ( $value, $info );
			$home_one [$key] = $data;
		}
		foreach ( $home_two as $key => $value ) {
			$info = D ( 'Document' )->detail ( $value ['id'] );
			if ($value ['cover_id'] > 0) {
				$picture_info = D ( 'Picture' )->getPictureInfo ( $value ['cover_id'] );
				if ($picture_info) {
					$value ['cover_path'] = $picture_info ['path'];
				} else {
					$value ['cover_path'] = '';
				}
			}
			$data = array_merge ( $value, $info );
			$home_two [$key] = $data;
		}
		
		// 
		$home_adv = $this->getBanners();
		
		
		$this->assign ( 'home_one', $home_one ); // 主页文档1
		$this->assign ( 'home_two', $home_two ); // 主页文档2
		$this->assign ( 'home_adv', $home_adv ); // 主页轮播图
		$this->display ();
	}
	
	private function getBanners(){
		$home_adv = D ( 'Document' )->lists ( '43' );
		foreach ( $home_adv as $key => $value ) {
			if ($value ['cover_id'] > 0) {
				$picture_info = D ( 'Picture' )->getPictureInfo ( $value ['cover_id'] );
				if ($picture_info) {
					$value ['cover_path'] = $picture_info ['path'];
				} else {
					$value ['cover_path'] = '';
				}
				$home_adv[$key] = $value;
			}
		}
		return $home_adv;
	}
}