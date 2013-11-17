<?php
/**
 * <p>哔哩哔哩转换<strong>&lt;bilibili&gt;av(id)&lt;/bilibili&gt;</strong>即可</p>
 * @package 哔哩哔哩转换
 * @author 镜花水月
 * @version 1.0.0 beta
 * @dependence 9.9.2-*
 * @link http://kloli.tk/blog
 */
class bilibili implements Typecho_Plugin_Interface{
	/**
	 * 激活插件方法,如果激活失败,直接抛出异常
	 *
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function activate(){
		//离线浏览器都是所见即所得模式
		Typecho_Plugin::factory('Widget_XmlRpc')->fromOfflineEditor = array('bilibili', 'toCodeEditor');
		/** 前端输出处理接口 */
		Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('bilibili', 'parse');
		Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('bilibili', 'parse');
	}
	/**
	 * 禁用插件方法,如果禁用失败,直接抛出异常
	 *
	 * @static
	 * @access public
	 * @return void
	 * @throws Typecho_Plugin_Exception
	 */
	public static function deactivate(){

	}
	/**
	 * 获取插件配置面板
	 *
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form 配置面板
	 * @return void
	 */
	public static function config(Typecho_Widget_Helper_Form $form){

	}
	/**
	 * 个人用户的配置面板
	 *
	 * @access public
	 * @param Typecho_Widget_Helper_Form $form
	 * @return void
	 */
	public static function personalConfig(Typecho_Widget_Helper_Form $form){

	}
	/**
	 * 将伪可视化代码转化为可视化代码
	 *
	 * @access public
	 * @param string $content 需要处理的内容
	 * @return string
	 */
	public static function toVisualEditor($content){
		return preg_replace("/<(bilibili)>av(\d+)<\/\\1>/is", "<embed height=\"400\" width=\"480\" quality=\"high\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://static.hdslb.com/miniloader.swf\" flashvars=\"aid=\\2&page=1\" pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\"></embed>", $content);
	}
	/**
	 * 将可视化代码转化为伪可视化代码
	 *
	 * @access public
	 * @param string $content 需要处理的内容
	 * @return string
	 */
	public static function toCodeEditor($content){
		return preg_replace("/<(bilibili)[^>]*data=\"http://static.hdslb.com/miniloader.swf?aid\=(\d+)\">(.*?)<\/\\1>/is", "<bilibili>\\2</bilibili>", $content);
	}
	/**
	 * 插件实现方法
	 *
	 * @access public
	 * @return void
	 */
	public static function parse($text, $widget, $lastResult){
		$text = empty($lastResult) ? $text : $lastResult;
		if($widget instanceof Widget_Archive){
			$text = preg_replace('/<(bilibili)>av(\d+)<\/\\1>/is', "<embed height=\"400\" width=\"480\" quality=\"high\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://static.hdslb.com/miniloader.swf\" flashvars=\"aid=\\2&page=1\" pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\"></embed>", $text);
		}
		return $text;
	}
}
