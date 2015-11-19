<?php
/**
 * Main controller
 *
 * @author jarek
 */
use Jarek;

// Get configuration
$config = parse_ini_file('../configs/default.ini', true);

set_include_path(get_include_path() . PATH_SEPARATOR . $config['app']['libraryPath']);

// Autoload function
function __autoload($class) {
    require_once(str_replace('\\', '/', $class) . '.php');
}

// Disable/enable errors
ini_set('error_reporting', $config['app']['errorReporting']);
ini_set('display_errors', $config['app']['displayErrors']);


// Filter input parameters
$params = array(
    'searchAction' => '/',
    'search'       => '',
    'page'         => 1
);
if (isset($_GET['search'])) {
    $params['search'] = Jarek\Input::Filter(Jarek\Input::REGEXP, $_GET['search'], '/[^a-zA-Z0-9\s\-]/u');
}
if (isset($_GET['page'])) {
    $params['page'] = Jarek\Input::Filter(Jarek\Input::INTEGER, $_GET['page']);
}

// Search gallery
try {
    if (!empty($params['search'])) {
        $gallery = new Jarek\Gallery($config['gallery']);
        $gallery->search($params['search'], $params['page']);
        $params['photos']       = $gallery->getPhotos();
        $params['range']        = $config['gallery']['range'];
        $params['items']        = $gallery->getItems();
        $params['itemsPerPage'] = $gallery->getItemsPerPage();
        $params['page']         = $gallery->getPage();
        $params['pages']        = $gallery->getPages();
        if ($gallery->getMaxPages()
            && ($gallery->getPages() >= $gallery->getMaxPages())) {
            $params['maxItems'] = $gallery->getMaxItems();
        }
    }
} catch (Exception $e) {
    // Show errors if debug is enabled
    if ($config['app']['debug']) {
        $params['error'] = $e->getMessage();
    }
}

// Display page
$page = new Jarek\Page($config['page']);
echo $page->render('index.php', $params);
