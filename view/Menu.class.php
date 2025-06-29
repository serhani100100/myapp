<?php

class Menu{
	public function run(){
		$html = Html::load('menu.html');
		$menu = html::load('menu-logged-out.html');
		$user = 'U';
		if (Session::getValue('logged')):
			$menu = html::load('menu-logged-in.html');
			if (Session::getValue('admin')):
				$user = 'A';
			endif;
		endif;
		$menu = str_replace('#USER#',$user,$menu);
		$html = str_replace('#SYSTEM-MENU#',$menu,$html);
		
		return $html;
	}
}