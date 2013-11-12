<?php

//function dave_subtheme_form_system_theme_settings_alter(&$form, &$form_state){
//
//
//$form['bootswatch'] = array(
//    '#title' => 'Bootswatch Configurations - Kapasoft.com',
//    '#type' => 'fieldset',
//    '#collapsible' => FALSE,
//    '#collapsed' => FALSE,
//);
//
//$form['bootswatch']['bootswatch_theme'] = array(
//    '#title' => t('Bootswatch Themes'),
//    '#type' => 'select',
//    '#default_value' => theme_get_setting('bootswatch_theme'),
//    '#options' => _theme_schemas(),
//);
//}
//
//function _theme_schemas(){
//    $themes = array();
//    $active_theme_path = drupal_get_path('theme', $GLOBALS['theme_key']);
//    $themeNames = scandir('./'. $active_theme_path.'/css/bootswatch');
//
//    foreach($themeNames as $dir){
//        if($dir != '.' && $dir != '..'){
//            $themes[$dir] = $dir;
//        }
//    }
//    return $themes;
//}
