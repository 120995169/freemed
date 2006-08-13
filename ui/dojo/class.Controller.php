<?php
 // $Id$
 //
 // Authors:
 // 	Jeff Buchbinder <jeff@freemedsoftware.org>
 //
 // Copyright (C) 1999-2006 FreeMED Software Foundation
 //
 // This program is free software; you can redistribute it and/or modify
 // it under the terms of the GNU General Public License as published by
 // the Free Software Foundation; either version 2 of the License, or
 // (at your option) any later version.
 //
 // This program is distributed in the hope that it will be useful,
 // but WITHOUT ANY WARRANTY; without even the implied warranty of
 // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 // GNU General Public License for more details.
 //
 // You should have received a copy of the GNU General Public License
 // along with this program; if not, write to the Free Software
 // Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

class Controller {

	protected $smarty;
	protected $vars;
	protected $default = 'org.freemedsoftware.ui.login';

	public function __construct ( ) {
		// Wrap initialize function
		$this->initialize ( );
	}	

	protected function initialize ( ) {
		// Figure out "base URL"
		unset ( $base_uri );
		$base_uri = dirname ( str_replace ( $_SERVER['PATH_INFO'], '', $_SERVER['REQUEST_URI'] ) );

		unset ( $ui );
		$ui = basename ( dirname ( __FILE__ ) );

		// Load smarty engine
		unset ( $smarty );
		include_once(dirname(__FILE__).'/../../lib/smarty/Smarty.class.php');
		$this->smarty = new Smarty;

		// Override Smarty defaults for FreeMED
		$this->smarty->template_dir = dirname(__FILE__)."/view/";
		$this->smarty->compile_dir = dirname(__FILE__)."/../../data/cache/smarty/templates_c/";
		$this->smarty->cache_dir = dirname(__FILE__)."/../../data/cache/smarty/cache/";

		// Load global passed data in whichever order it needs
		$this->load_data ( $_GET );
		$this->load_data ( $_POST );
		$this->load_data ( $_COOKIE );
		$this->load_data ( $_SESSION );

		// Master overrides
		$this->smarty->assign ( "VERSION", DISPLAY_VERSION );
		$this->smarty->assign ( "base_uri", $base_uri );
		$this->smarty->assign ( "htdocs", "${base_uri}/ui/${ui}/htdocs" );
		$this->smarty->assign ( "ui", $ui );
	} // end public function initialize

	public function load ( $template ) {
		// Wrapper for loading Smarty template
		$this->smarty->display ( "${template}.tpl" );
	} // end public function load

	public function load_default ( ) {
		$this->load ( $this->default );
	} // end public function load_default

	private function load_data ( $data ) {
		if ( is_array ( $data ) ) {
			foreach ( $data AS $k => $v ) {
				// Ignore anything beginning with an underscore
				if (substr($k, 0, 1) != '_') {
					// Store in protected data
					$this->vars[$k] = $v;

					// Pass to Smarty engine
					$this->smarty->assign ( $k, $v );
				}
			}
		}
	} // end private function load_data

} // end class Controller

?>