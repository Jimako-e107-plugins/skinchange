<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) { exit; }
 
e107::includeLan(e_PLUGIN."user/languages/".e_LANGUAGE.".php");

/* sitetheme has support this, f.e. admin could change to bootstrap3 */
$siteTheme = e107::getPref('sitetheme');

/* add check for existing UEF fields */
$ue = e107::getUserExt();
$tmp = $ue->getFieldValues('user_plugin_skinchange_skin'); 
$userSkins = explode(",", $tmp);
if(!isset($userSkins)) $userSkins = array();
  print_a($siteTheme); print_a($userSkins);
if(in_array($siteTheme, $userSkins)) { 
 
  $hiddenskins = e107::getPlugPref("skinchange", "hiddenskins" );
   
  $querystring = "";
   
  foreach($_GET as $key=>$value) {
   	if($key != "skin" && isset($value)) $querystring .= "&amp;$key=$value";
  }
  
  //$hiddenskins = explode(",", $hiddenskins);
  if(!isset($hiddenskins)) $hiddenskins = array( );
   
  $content = "<select name=\"skin\" onChange=\"document.location = '".e_REQUEST_SELF."?skin=' + this.options[this.selectedIndex].value + '$querystring';\">";
   
  $directory = opendir(e_THEME);
    
  while($filename = readdir($directory)) {
  	if($filename== "." || $filename== ".." || !is_dir(e_THEME) || (in_array($filename, $hiddenskins)) || !is_readable(e_THEME.$filename."/skinchange.xml")) continue;
   
  	$skinlist[strtolower($filename)] = "<option value=\"$filename\"".(USERTHEME == $filename ? " selected" : "").">$filename</option>";
  }
   
  ksort($skinlist);
  foreach($skinlist as $s) { $content .= $s; }
  unset($skinlist, $s);
  closedir($directory);
  $content .= "</select>";
  
  e107::getRender()->tablerender(LAN_UMENU_THEME_2, $content, 'usertheme');
}
