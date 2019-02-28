<?php if(!defined('ABSPATH')){ die();}
/**
 * @package agawtribe
 * 
 */
class tribe_activate_plugin
{
   public static function activate()
   {
     flush_rewrite_rules();
   }
}