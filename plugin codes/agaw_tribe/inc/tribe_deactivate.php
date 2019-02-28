<?php if(!defined('ABSPATH')){ die();}
/**
 * @package agawtribe
 * 
 */
class tribe_deactivate_plugin
{
   public static function deactivate()
   {
     flush_rewrite_rules();
   }
}