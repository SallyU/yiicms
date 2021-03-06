<?php
/**
 * 我的评论
 * @author        zhao jinhan <326196998@qq.com>
 * @copyright     Copyright (c) 2014-2015. All rights reserved.
 *
 */


class MyreplysAction extends CAction
{
	public $_seoTitle;
	public $_setting;
	public $_static_public;
	public $_stylePath;
	public $_content_models;
	
	public function run(){
		$controller  = $this->getController();				
		$this->_setting = $controller->_setting;	
		$this->_stylePath = $controller->_stylePath;
		$this->_static_public = $controller->_static_public;			
		
		$controller->_seoTitle = Yii::t('common','User Center').' - '.Yii::t('common','My Replys').' - '.$this->_setting['site_name'];
		//加载css,js
		Yii::app()->clientScript->registerCssFile($this->_stylePath . "/css/user.css");
		Yii::app()->clientScript->registerScriptFile($this->_static_public . "/js/jquery/jquery.js");		
		
		//我的回复
		$uid = Yii::app()->user->id;
		$comment_mod = new Comment();
		$reply_mod = new Reply();
		$model_type = new ModelType();
		$uid = Yii::app()->user->id;
		$criteria = new CDbCriteria();
		$criteria->condition = 't.user_id='.$uid;
		$criteria->order = 't.id DESC';
		
		//分页
		$count = $reply_mod->count( $criteria );
		$pages = new CPagination( $count );
		$pages->pageSize = 15;
		$criteria->limit = $pages->pageSize;
		$criteria->offset = $pages->currentPage * $pages->pageSize;
		$datalist = $reply_mod->findAll($criteria);	
		foreach((array)$datalist as $k => $v){
			$reply = $comment_mod->findByPk($v->cid);			
			if($reply) {
				$c_mod_class = $controller->_content_models[$reply->type];
				$c_mod_name = strtolower($c_mod_class);
				$content_mod = new $c_mod_class();
				$content = $content_mod->findByPk($reply->topic_id);
				$datalist[$k]['title'] = $content->title;
				$datalist[$k]['url'] = $controller->createUrl($c_mod_name.'/view', array('id'=>$reply->topic_id));
			}			
		}			
		$controller->render('my_replys', array('datalist'=>$datalist));
	}

}