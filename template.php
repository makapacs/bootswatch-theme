<?php

// Provide < PHP 5.3 support for the __DIR__ constant.
if (!defined('__DIR__')) {
  define('__DIR__', dirname(__FILE__));
}
require_once __DIR__ . '/includes/bootstrap.inc';
require_once __DIR__ . '/includes/theme.inc';
require_once __DIR__ . '/includes/pager.inc';
require_once __DIR__ . '/includes/form.inc';
require_once __DIR__ . '/includes/admin.inc';
require_once __DIR__ . '/includes/menu.inc';

// Load module specific files in the modules directory.
$includes = file_scan_directory(__DIR__ . '/includes/modules', '/\.inc$/');
foreach ($includes as $include) {
  if (module_exists($include->name)) {
    require_once $include->uri;
  }
}

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('bootstrap_rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}

/**
 * Implements hook_theme().
 */
function bootswatch_theme(&$existing, $type, $theme, $path) {
  // If we are auto-rebuilding the theme registry, warn about the feature.
  if (
    // Only display for site config admins.
    isset($GLOBALS['user']) && function_exists('user_access') && user_access('administer site configuration')
    && theme_get_setting('bootstrap_rebuild_registry')
    // Always display in the admin section, otherwise limit to three per hour.
    && (arg(0) == 'admin' || flood_is_allowed($GLOBALS['theme'] . '_rebuild_registry_warning', 3))
  ) {
    flood_register_event($GLOBALS['theme'] . '_rebuild_registry_warning');
    drupal_set_message(t('For easier theme development, the theme registry is being rebuilt on every page request. It is <em>extremely</em> important to <a href="!link">turn off this feature</a> on production websites.', array('!link' => url('admin/appearance/settings/' . $GLOBALS['theme']))), 'warning', FALSE);
  }
  
  return array(
    'bootstrap_links' => array(
      'variables' => array(
        'links' => array(),
        'attributes' => array(),
        'heading' => NULL
      ),
    ),
    'bootstrap_btn_dropdown' => array(
      'variables' => array(
        'links' => array(),
        'attributes' => array(),
        'type' => NULL
      ),
    ),
    'bootstrap_modal' => array(
      'variables' => array(
        'heading' => '',
        'body' => '',
        'footer' => '',
        'attributes' => array(),
        'html_heading' => FALSE,
      ),
    ),
    'bootstrap_accordion' => array(
      'variables' => array(
        'id' => '',
        'elements' => array(),
      ),
    ),
    'bootstrap_search_form_wrapper' => array(
      'render element' => 'element',
    ),
    'bootstrap_append_element' => array(
      'render element' => 'element',
    ),
  );
}

/**
 * Override theme_breadrumb().
 *
 * Print breadcrumbs as a list, with separators.
 */
function bootswatch_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    $breadcrumbs = '<ul class="breadcrumb">';
    
    $count = count($breadcrumb) - 1;
    foreach ($breadcrumb as $key => $value) {
      if ($count != $key) {
        $breadcrumbs .= '<li>' . $value . '</li>';
      }
      else{
        $breadcrumbs .= '<li>' . $value . '</li>';
      }
    }
    $breadcrumbs .= '</ul>';
    
    return $breadcrumbs;
  }
}

/**
 * Override or insert variables in the html_tag theme function.
 */
function bootswatch_process_html_tag(&$variables) {
  $tag = &$variables['element'];

  if ($tag['#tag'] == 'style' || $tag['#tag'] == 'script') {
    // Remove redundant type attribute and CDATA comments.
    unset($tag['#attributes']['type'], $tag['#value_prefix'], $tag['#value_suffix']);

    // Remove media="all" but leave others unaffected.
    if (isset($tag['#attributes']['media']) && $tag['#attributes']['media'] === 'all') {
      unset($tag['#attributes']['media']);
    }
  }
}

/**
 * Preprocess variables for page.tpl.php
 *
 * @see page.tpl.php
 */
function bootswatch_preprocess_page(&$variables) {
  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['columns'] = 3;
  }
  elseif (!empty($variables['page']['sidebar_first'])) {
    $variables['columns'] = 2;
  }
  elseif (!empty($variables['page']['sidebar_second'])) {
    $variables['columns'] = 2;
  }
  else {
    $variables['columns'] = 1;
  }

  // Primary nav
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    // Build links
    $variables['primary_nav'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
    // Provide default theme wrapper function
    $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
  }

  // Secondary nav
  $variables['secondary_nav'] = FALSE;
  if ($variables['secondary_menu']) {
    // Build links
    $variables['secondary_nav'] = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
    // Provide default theme wrapper function
    $variables['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
  }

}

/**
 * Bootstrap theme wrapper function for the primary menu links
 */
function bootswatch_menu_tree__primary(&$variables) {
  return '<ul class="nav navbar-nav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the secondary menu links
 */
function bootswatch_menu_tree__secondary(&$variables) {
  return '<ul class="nav navbar-nav pull-right">' . $variables['tree'] . '</ul>';
}

/**
 * Returns HTML for a single local action link.
 *
 * This function overrides theme_menu_local_action() to add the icons that ship
 * with Bootstrap to the action links.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: A render element containing:
 *     - #link: A menu link array with "title", "href", "localized_options", and
 *       "icon" keys. If "icon" is not passed, it defaults to "plus-sign".
 *
 * @ingroup themeable
 *
 * @see theme_menu_local_action().
 */
function bootswatch_menu_local_action($variables) {
  $link = $variables['element']['#link'];

  // Build the icon rendering element.
  if (empty($link['icon'])) {
    $link['icon'] = 'plus-sign';
  }
  $icon = '<i class="glyphicon ' . drupal_clean_css_identifier('glyphicon-' . $link['icon']) . '"></i>';

  // Format the action link.
  $output = '<li>';
  if (isset($link['href'])) {
    $options = isset($link['localized_options']) ? $link['localized_options'] : array();

    // If the title is not HTML, sanitize it.
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }

    // Force HTML so we can add the icon rendering element.
    $options['html'] = TRUE;
    $output .= l($icon . $link['title'], $link['href'], $options);
  }
  elseif (!empty($link['localized_options']['html'])) {
    $output .= $icon . $link['title'];
  }
  else {
    $output .= $icon . check_plain($link['title']);
  }
  $output .= "</li>\n";

  return $output;
}

/**
 * Preprocess variables for region.tpl.php
 *
 * @see region.tpl.php
 */
function bootswatch_preprocess_region(&$variables, $hook) {
  if ($variables['region'] == 'content') {
    $variables['theme_hook_suggestions'][] = 'region__no_wrapper';
  }
  
  if ($variables['region'] == "sidebar_first") {
    $variables['classes_array'][] = 'well';
  }
}

/**
 * Preprocess variables for block.tpl.php
 *
 * @see block.tpl.php
 */
function bootswatch_preprocess_block(&$variables, $hook) {
//    var_dump($variables['block_html_id']);
  //$variables['classes_array'][] = 'row';
  // Use a bare template for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }

  if ($variables['block_html_id'] == 'block-search-form') {
       $variables['theme_hook_suggestions'][] = 'block__bootstrap_search_form';
  }
  $variables['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function bootswatch_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}

/**
 * Returns the correct span class for a region
 */
function _bootstrap_content_span($columns = 1) {
  $class = FALSE;
  
  switch($columns) {
    case 1:
      $class = 'col-md-12';
      break;
    case 2:
      $class = 'col-md-9';
      break;
    case 3:
      $class = 'col-md-6';
      break;
  }
  
  return $class;
}

/**
 * Adds the search form's submit button right after the input element.
 *
 * @ingroup themable
 */
function bootswatch_bootstrap_search_form_wrapper(&$variables) {
//  $output = '<div class="form-group">';
    $output = '<div class="input-group">';
    $output .= $variables['element']['#children'];
//  $output .=   '<input type="text" class="form-control">';
  $output .=   '<span class="input-group-btn">';
//  $output .=   '<button class="btn btn-default" type="submit">'.t('Submit').'</button>';

  $output .= '<button type="submit" class="btn btn-default">';
  $output .= '<i class="glyphicon glyphicon-search"></i>';
  $output .= '<span class="element-invisible">' . t('Search') . '</span>';
  $output .= '</button>';

  $output .=   '</span>';
//  $output .= '<button type="submit" class="btn btn-default btn-sm">';
//  $output .= '<i class="glyphicon glyphicon-search"></i>';
//  $output .= '<span class="element-invisible">' . t('Search') . '</span>';
//  $output .= '</button>';
  $output .= '</div>';
//  $output .=   '<button class="btn btn-default" type="submit">'.t('Submit').'</button>';

    return $output;
 }


/*********Bootstrap 3.0.x Added By Margots from Kapasoft.com/margotskapacs.com*************/
function bootswatch_textfield($variables) {
    $element = $variables['element'];
    $element['#attributes']['type'] = 'text';
    element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
    _form_set_class($element, array('form-text', 'form-control'));

    $extra = '';
    if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
        drupal_add_library('system', 'drupal.autocomplete');
        $element['#attributes']['class'][] = 'form-autocomplete';

        $attributes = array();
        $attributes['type'] = 'hidden';
        $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
        $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
        $attributes['disabled'] = 'disabled';
        $attributes['class'][] = 'autocomplete';
        $extra = '<input' . drupal_attributes($attributes) . ' />';
    }

    $output = '<input' . drupal_attributes($element['#attributes']) . ' />';

    return $output . $extra;
}


function bootswatch_password($variables) {
    $element = $variables['element'];
    $element['#attributes']['type'] = 'password';
    element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
    _form_set_class($element, array('form-text', 'form-control'));

    return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function bootswatch_container($variables) {
    $element = $variables['element'];

    // Special handling for form elements.
    if (isset($element['#array_parents'])) {
        // Assign an html ID.
        if (!isset($element['#attributes']['id'])) {
            $element['#attributes']['id'] = $element['#id'];
        }
        // Add the 'form-wrapper' class.
        $element['#attributes']['class'][] = 'form-wrapper';
    }

    $element['#attributes']['class'] = array_diff($element['#attributes']['class'], array('container-inline'));

    return '<div' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</div>';
//    return $element['#children'];
}
