<?php
/*
Plugin Name: FortySix Mobile
Plugin URI: http://www.fortysix.co.jp/news/760/
Description: Japanese mobile phone simple display plugin.
Version: 1.0
Author: iFortySix
Author URI: http://www.fortysix.co.jp/
*/
/*  Copyright 2009 FortySix Inc.(email : support at fortysix.jp)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once(dirname(__FILE__) . '/includes/config.php');

require_once(dirname(__FILE__) . '/includes/functions.php');

require_once(dirname(__FILE__) . '/admin/initial.php');

$fscm = new FsMb_Initial;

if ( $fscm->is_mobile ) {

	$fscm->init_mobile();
	
} else {

	$fscm->init_pc();
}
?>
