<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('skinchange',true);


class skinchange_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'skinchange_ui',
			'path' 			=> null,
			'ui' 			=> 'skinchange_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

		// 'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),
		
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'skinchange';
}




				
class skinchange_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'skinchange';
		protected $pluginName		= 'skinchange';
	//	protected $eventName		= 'skinchange-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= array (
		);		
		
		protected $fieldpref = array();
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
           /*  'allow_theme_select' => array('title'=> 'Allow theme select', 'tab'=>0, 'type'=>'boolean', 'data' => 'int', 'help'=>'', 'writeParms' => array()), */
			'hiddenskins'		=> array('title'=> 'Hidden themes', 'tab'=>0, 'type'=>'method', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
		); 

	
		public function init()
		{
 
		}
 
		
 
			
}
				


class skinchange_form_ui extends e_admin_form_ui
{

	
	// Custom Method/Function (pref)
	function hiddenskins($curVal,$mode)
	{
 
		$hiddenskins =  $curVal;
		// Get the list of available themes
		$handle = opendir(e_THEME);
		while ($file = readdir($handle)) 
		{
			if ($file != "." && $file != ".." && $file != "templates" && $file != "" && $file != "CVS") 
			{
				if (is_readable(e_THEME.$file."/theme.php") && is_readable(e_THEME.$file."/skinchange.xml")) 
				{
					$themeOptions[] = $file;
					$themeCount[$file] = 0;
				}
			}
		}
		closedir($handle);
 

		switch($mode)
		{			
			case 'write': // Edit Page
				 	$directory = opendir(e_THEME);
                    if(!isset($hiddenskins)) $hiddenskins = array( );
                  	if(is_string($hiddenskins)) $hiddenskins = explode(",", $hiddenskins);
                    
                    foreach($themeOptions AS  $filename) {   
                   		$skinlist[strtolower($filename)] = "<input type='checkbox' value='$filename' name='hiddenskins[".$filename."]' ".(is_array($hiddenskins) && in_array($filename, $hiddenskins) ? " checked" : "")."> $filename<br />\n";
                  	}
                  	ksort($skinlist);
                    
                  	$output .= "<div><form method=\"POST\" style='width: 250px; margin: 1em auto;' id='hiddenskins' class='tblborder' name=\"form\" enctype=\"multipart/form-data\" action=\"admin.php?action=skins\">";
                  	foreach($skinlist as $s) { $output .= $s; }
                  	unset($skinlist, $s);
 
                    return $output;
                 
                 
                 
			break;
			
		}
		
		return null;
	}

}		
		
		
new skinchange_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

