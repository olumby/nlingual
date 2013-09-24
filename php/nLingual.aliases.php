<?php
/*
 * Aliases to nLingual methods
 */

use nLingual as nL;

function nL_get_option($name){
	return nL::get_option($name);
}

function nL_languages(){
	return nL::languages();
}

function nL_post_types(){
	return nL::post_types();
}

function nL_default_lang(){
	return nL::default_lang();
}

function nL_current_lang(){
	return nL::current_lang();
}

function nL_cache_get($id, $section){
	return nL::cache_get($id, $section);
}

function nL_cache_set($id, $lang, $section){
	return nL::cache_set($id, $lang, $section);
}

function nL_lang_exists($lang){
	return nL::lang_exists($lang);
}

function nL_post_type_exists($type){
	return nL::post_type_exists($type);
}

function nL_get_lang($field = null, $lang = null){
	return nL::get_lang($field, $lang);
}

function nL_lang_term($lang = null, $field = null){
	return nL::lang_term($lang, $field);
}

function nL_set_lang($lang, $lock = true){
	return nL::set_lang($lang, $lock);
}

function nL_switch_lang($lang){
	return nL::switch_lang($lang);
}

function nL_restore_lang(){
	return nL::restore_lang();
}

function nL_get_post_lang($id = null, $default = null){
	return nL::get_post_lang($id, $default);
}

function nL_set_post_lang($id = null, $lang = null){
	return nL::set_post_lang($id, $lang);
}

function nL_delete_translation($id = null, $lang = null){
	return nL::delete_translation($id, $lang);
}

function nL_in_this_lang($id = null, $lang){
	return nL::in_this_lang($id, $lang);
}

function nL_in_default_lang($id = null){
	return nL::in_default_lang($id);
}

function nL_in_current_lang($id = null){
	return nL::in_current_lang($id);
}

function nL_get_translation($id, $lang = null, $return_self = true){
	return nL::get_translation($id, $lang, $return_self);
}

function nL_associate_posts($post_id, $posts){
	return nL::associate_posts($post_id, $posts);
}

function nL_associated_posts($post_id, $include_self = false){
	return nL::associated_posts($post_id, $include_self);
}

function nL_process_url($host, $uri){
	return nL::process_url($host, $uri);
}

function nL_localize_url($url = null, $lang = null, $force_admin = false){
	return nL::localize_url($url, $lang, $force_admin);
}

function nL_get_permalink($id = null, $lang = null, $echo = true){
	return nL::get_permalink($id, $lang, $echo);
}

function nL_lang_links($echo = false, $prefix = '', $sep = ' '){
	return nL::lang_links($echo, $prefix, $sep);
}

function nL_split_langs($text, $lang = null, $sep = null, $force = false){
	return nL::split_langs($text, $lang, $sep, $force);
}