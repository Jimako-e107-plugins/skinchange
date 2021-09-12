# Skin Change plugin for e107

Special Theme changing plugin for e107. Just for demo site now.

*Inspiration for this plugin*: efiction CMS

The main difference against the core solution is that this plugin works for quests, not only for registered members (with little change in class2.php), but it was inspired with core usertheme menu. 

For more information please visit https://www.e107sk.com/. You can see it in action on its demo site https://www.e107sk.com/efictiondemo/.

## Info:
- it uses User Extended plugin field skin
- user can set default value in their profile
- actual selection uses e107 sessions handler

## Available themes:
add file skinchange.xml in the theme folder.  All themes have to use the same layout system. And the same menuareas system is next plus. 

## Core change:
- in class2.php comment line cca 1639: 
  /* define('USERTHEME', false); */

## Warning!
This plugin is just for theme development purpose for now. Don't use it, if you don't know what you are doing. 


# Changelog

## Version 1.0.1
- first version, used on demo site

## Version 1.0.2
- added userfield back (deleted by mistake)
- tested if sitetheme is listed in UEA fields