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
class ProductController extends HomeController {
	
	// 系统首页
	public function index() {
		// 获取云产品下的内容
		$products = D ( 'Document' )->lists ( '44' , '`level` DESC' );
		// 合并内容以及内容详情
		foreach ( $products as $key => $value ) {
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
			$products [$key] = $data;
		}
		
		//
		$home_adv = $this->getBanners ();
		
		$this->assign ( 'products', $products ); // 云产品内容
		$this->assign ( 'home_adv', $home_adv ); // 主页轮播图
		$this->display ();
	}
	
	// 产品详情界面
	public function details() {
		// 获取云产品下的内容
		$products = D ( 'Document' )->lists ( '44' , '`level` DESC' );
		// 合并内容以及内容详情
		foreach ( $products as $key => $value ) {
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
			$products [$key] = $data;
		}
		
		//
		$home_adv = $this->getBanners ();
		
		$this->assign ( 'products', $products ); // 云产品内容
		$this->assign ( 'home_adv', $home_adv ); // 主页轮播图
		$this->display ();
	}
	
	// 获取轮播图
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