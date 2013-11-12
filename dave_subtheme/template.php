<?php

/**
 * @file template.php
 */

//function dave_subtheme_css_alter(&$css){
//    $active_theme_path = drupal_get_path('theme', $GLOBALS['theme']);
//    $themeNames = scandir('./'. $active_theme_path.'/css/bootswatch');
//
//    //reset for all themes
//    $allThemes = array();
//        foreach($themeNames as $dir){
//            if($dir != '.' && $dir != '..'){
//                $pathToTheme = $active_theme_path.'/css/bootswatch/'.$dir.'/bootstrap.min.css';
//                $allThemes[$pathToTheme] = false;
//            }
//        }
//
//    $css = array_diff_key($css, $allThemes);
//
//    //adding selected bootswatch theme
//    $theme = theme_get_setting('bootswatch_theme');
//    $path = $active_theme_path.'/css/bootswatch/'.$theme.'/bootstrap.min.css';
//    if(!file_exists('./'.$path)){
//      //default to general
//        $path = $active_theme_path.'/css/bootstrap.min.css';
//    }
//
//    $css[$path]['data'] = $path;
//    $css[$path]['type'] = 'file';
//    $css[$path]['group'] = 100;
//    $css[$path]['every_page'] = true;
//    $css[$path]['media'] = "all";
//    $css[$path]['preprocess'] = false;
//    $css[$path]['weight'] = 0;
//    $css[$path]['browsers'] = array(
//        'IE' => true,
//        '!IE' => true,
//    );
//}