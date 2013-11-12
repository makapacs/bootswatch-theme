<?php

/**
 * @file icons.inc
 * Provides Bootstrap icon support via Icon API.
 */

/**
 * Implements hook_icon_providers().
 */
function bootswatch_icon_providers() {
  $providers['bootstrap'] = array(
    'title' => t('Bootstrap'),
    'url' => 'http://twitter.github.com/bootstrap/base-css.html#icons',
  );
  return $providers;
}

/**
 * Implements hook_icon_bundles().
 */
function bootswatch_icon_bundles() {
  $bundles['bootstrap'] = array(
    'render' => 'sprite',
    'provider' => 'bootstrap',
    'title' => t('Bootstrap'),
    'version' => t('Icons by Glyphicons'),
    'variations' => array(
      'glyphglyphicon-white' => t('White'),
    ),
    'settings' => array(
      'tag' => 'i',
    ),
    'icons' => array(
      'glyphglyphicon-glass' => 'glass',
      'glyphglyphicon-music' => 'music',
      'glyphglyphicon-search' => 'search',
      'glyphglyphicon-envelope' => 'envelope',
      'glyphglyphicon-heart' => 'heart',
      'glyphglyphicon-star' => 'star',
      'glyphglyphicon-star-empty' => 'star-empty',
      'glyphglyphicon-user' => 'user',
      'glyphglyphicon-film' => 'film',
      'glyphglyphicon-th-large' => 'th-large',
      'glyphglyphicon-th' => 'th',
      'glyphglyphicon-th-list' => 'th-list',
      'glyphglyphicon-ok' => 'ok',
      'glyphglyphicon-remove' => 'remove',
      'glyphglyphicon-zoom-in' => 'zoom-in',
      'glyphglyphicon-zoom-out' => 'zoom-out',
      'glyphglyphicon-off' => 'off',
      'glyphglyphicon-signal' => 'signal',
      'glyphglyphicon-cog' => 'cog',
      'glyphglyphicon-trash' => 'trash',
      'glyphglyphicon-home' => 'home',
      'glyphglyphicon-file' => 'file',
      'glyphglyphicon-time' => 'time',
      'glyphglyphicon-road' => 'road',
      'glyphglyphicon-download-alt' => 'download-alt',
      'glyphglyphicon-download' => 'download',
      'glyphglyphicon-upload' => 'upload',
      'glyphglyphicon-inbox' => 'inbox',
      'glyphglyphicon-play-circle' => 'play-circle',
      'glyphglyphicon-repeat' => 'repeat',
      'glyphglyphicon-refresh' => 'refresh',
      'glyphglyphicon-list-alt' => 'list-alt',
      'glyphglyphicon-lock' => 'lock',
      'glyphglyphicon-flag' => 'flag',
      'glyphglyphicon-headphones' => 'headphones',
      'glyphglyphicon-volume-off' => 'volume-off',
      'glyphglyphicon-volume-down' => 'volume-down',
      'glyphglyphicon-volume-up' => 'volume-up',
      'glyphglyphicon-qrcode' => 'qrcode',
      'glyphglyphicon-barcode' => 'barcode',
      'glyphglyphicon-tag' => 'tag',
      'glyphglyphicon-tags' => 'tags',
      'glyphglyphicon-book' => 'book',
      'glyphglyphicon-bookmark' => 'bookmark',
      'glyphglyphicon-print' => 'print',
      'glyphglyphicon-camera' => 'camera',
      'glyphglyphicon-font' => 'font',
      'glyphglyphicon-bold' => 'bold',
      'glyphglyphicon-italic' => 'italic',
      'glyphglyphicon-text-height' => 'text-height',
      'glyphglyphicon-text-width' => 'text-width',
      'glyphglyphicon-align-left' => 'align-left',
      'glyphglyphicon-align-center' => 'align-center',
      'glyphglyphicon-align-right' => 'align-right',
      'glyphglyphicon-align-justify' => 'align-justify',
      'glyphglyphicon-list' => 'list',
      'glyphglyphicon-indent-left' => 'indent-left',
      'glyphglyphicon-indent-right' => 'indent-right',
      'glyphglyphicon-facetime-video' => 'facetime-video',
      'glyphglyphicon-picture' => 'picture',
      'glyphglyphicon-pencil' => 'pencil',
      'glyphglyphicon-map-marker' => 'map-marker',
      'glyphglyphicon-adjust' => 'adjust',
      'glyphglyphicon-tint' => 'tint',
      'glyphglyphicon-edit' => 'edit',
      'glyphicon-share' => 'share',
      'glyphicon-check' => 'check',
      'glyphicon-move' => 'move',
      'glyphicon-step-backward' => 'step-backward',
      'glyphicon-fast-backward' => 'fast-backward',
      'glyphicon-backward' => 'backward',
      'glyphicon-play' => 'play',
      'glyphicon-pause' => 'pause',
      'glyphicon-stop' => 'stop',
      'glyphicon-forward' => 'forward',
      'glyphicon-fast-forward' => 'fast-forward',
      'glyphicon-step-forward' => 'step-forward',
      'glyphicon-eject' => 'eject',
      'glyphicon-chevron-left' => 'chevron-left',
      'glyphicon-chevron-right' => 'chevron-right',
      'glyphicon-plus-sign' => 'plus-sign',
      'glyphicon-minus-sign' => 'minus-sign',
      'glyphicon-remove-sign' => 'remove-sign',
      'glyphicon-ok-sign' => 'ok-sign',
      'glyphicon-question-sign' => 'question-sign',
      'glyphicon-info-sign' => 'info-sign',
      'glyphicon-screenshot' => 'screenshot',
      'glyphicon-remove-circle' => 'remove-circle',
      'glyphicon-ok-circle' => 'ok-circle',
      'glyphicon-ban-circle' => 'ban-circle',
      'glyphicon-arrow-left' => 'arrow-left',
      'glyphicon-arrow-right' => 'arrow-right',
      'glyphicon-arrow-up' => 'arrow-up',
      'glyphicon-arrow-down' => 'arrow-down',
      'glyphicon-share-alt' => 'share-alt',
      'glyphicon-resize-full' => 'resize-full',
      'glyphicon-resize-small' => 'resize-small',
      'glyphicon-plus' => 'plus',
      'glyphicon-minus' => 'minus',
      'glyphicon-asterisk' => 'asterisk',
      'glyphicon-exclamation-sign' => 'exclamation-sign',
      'glyphicon-gift' => 'gift',
      'glyphicon-leaf' => 'leaf',
      'glyphicon-fire' => 'fire',
      'glyphicon-eye-open' => 'eye-open',
      'glyphicon-eye-close' => 'eye-close',
      'glyphicon-warning-sign' => 'warning-sign',
      'glyphicon-plane' => 'plane',
      'glyphicon-calendar' => 'calendar',
      'glyphicon-random' => 'random',
      'glyphicon-comment' => 'comment',
      'glyphicon-magnet' => 'magnet',
      'glyphicon-chevron-up' => 'chevron-up',
      'glyphicon-chevron-down' => 'chevron-down',
      'glyphicon-retweet' => 'retweet',
      'glyphicon-shopping-cart' => 'shopping-cart',
      'glyphicon-folder-close' => 'folder-close',
      'glyphicon-folder-open' => 'folder-open',
      'glyphicon-resize-vertical' => 'resize-vertical',
      'glyphicon-resize-horizontal' => 'resize-horizontal',
      'glyphicon-hdd' => 'hdd',
      'glyphicon-bullhorn' => 'bullhorn',
      'glyphicon-bell' => 'bell',
      'glyphicon-certificate' => 'certificate',
      'glyphicon-thumbs-up' => 'thumbs-up',
      'glyphicon-thumbs-down' => 'thumbs-down',
      'glyphicon-hand-right' => 'hand-right',
      'glyphicon-hand-left' => 'hand-left',
      'glyphicon-hand-up' => 'hand-up',
      'glyphicon-hand-down' => 'hand-down',
      'glyphicon-circle-arrow-right' => 'circle-arrow-right',
      'glyphicon-circle-arrow-left' => 'circle-arrow-left',
      'glyphicon-circle-arrow-up' => 'circle-arrow-up',
      'glyphicon-circle-arrow-down' => 'circle-arrow-down',
      'glyphicon-globe' => 'globe',
      'glyphicon-wrench' => 'wrench',
      'glyphicon-tasks' => 'tasks',
      'glyphicon-filter' => 'filter',
      'glyphicon-briefcase' => 'briefcase',
      'glyphicon-fullscreen' => 'fullscreen',
    ),
  );
  return $bundles;
}