<?php 
/**
 * Get the theme's logo image tag.
 *
 * @package Omeka\Function\View\Head
 * @uses get_theme_option()
 * @return string|null
 */


function footer_logo($number, $width)
{
    $logo = get_theme_option('logo_footer_'.$number);
    //echo get_theme_option('text_footer_one');
    $link = get_theme_option('text_footer_'.$number);
    if ($logo) {
        $storage = Zend_Registry::get('storage');
        $uri = $storage->getUri($storage->getPathByType($logo, 'theme_uploads'));
        return '<a target="_blank" href="'.$link.'" ><img width="'.$width.'" src="' . $uri . '" alt="' . option('site_title') . '" /></a>';
    }
}

function get_items($listId) {
	$itemTable = get_db()->getTable('Item');
	$select = $itemTable->getSelect()->where("items.id IN (".$listId.")");
	$itemObjects = $itemTable->fetchObjects($select);
	$html = '';
	foreach ($itemObjects as $itemObject) {
		$html .= get_view()->partial('items/image.php', array('item' => $itemObject));
		release_object($itemObject);
	}
	return $html;
}

?>