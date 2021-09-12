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

   /* actual sitetheme */
   $siteTheme = e107::getPref('sitetheme');
   
   /* add check for existing UEF fields */
   $ue = e107::getUserExt();
   $tmp = $ue->getFieldValues('user_plugin_skinchange_skin'); 
   $userSkins = explode(",", $tmp);
   if(!isset($userSkins)) $userSkins = array();

   if(in_array($siteTheme, $userSkins)) {  
 
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
    				$userSkin = $memberData['user_plugin_skinchange_skin']; 
    				$siteSkin = !empty($userSkin) ? $userskin : $siteTheme;
                    if(isset($siteSkin)) {
        				e107::getSession()->set('skinchange_skin', $siteSkin);  
        				define("USERTHEME", $siteSkin);
                    
                    }
                    else {
                       define("USERTHEME", "");
                    
                    }
    			}	
    		}
    	}
    }
    define("USERTHEME", $siteTheme);
 
}
 
 
 