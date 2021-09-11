<?php 
 
/* USERTHEME can't be NULL, core templates fails then */
 
if(e_ADMIN_AREA === true)  
{
}  //USER_AREA is not defined
elseif(defined(e_MENUMANAGER_ACTIVE) && e_MENUMANAGER_ACTIVE == true) 
{
}
else 
{ 
	/**************  DETECT THEME + SKIN HERE *************************************/
	//in e_module is not defined USER
	//in e_module is not defined LAYOUT
	//in e_module is not defined e_CURRENT_PLUGIN
	
	/* niekto pouzil menu, aj ked ma nastavenu inu temu */ 
	if(isset($_GET['skin'])) 
	{  //first priority 
		$siteskin = $_GET['skin'];
		e107::getSession()->set('skinchange_skin', $siteskin);  
		define("USERTHEME", $siteskin);
	}
	else 
	{ 
		/* niekto uz pouzil menu */
		if (e107::getSession()->is('skinchange_skin') > 0) 
		{
			$siteskin = e107::getSession()->get('skinchange_skin');
			define("USERTHEME", $siteskin);
		}
		else {
			/* ziadna zmena, ale mozno si to nastavil v ucte */	
			if (USERID) 
			{  //fully managed by e107, user is logged in
				$memberData = e107::user(USERID);
				$userskin = $memberData['user_plugin_skinchange_skin'];
				$siteskin = !empty($userskin) ? $userskin : e107::getPref('sitetheme');
				e107::getSession()->set('skinchange_skin', $siteskin);  
				define("USERTHEME", $siteskin);
			}	
		}
	}
}
 
 
 