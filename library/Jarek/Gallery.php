<?php
/**
 * Class for Images
 *
 * @author jarek
 */
namespace Jarek;
//require_once 'Photo.php';

class Gallery
{
    /**
     * Web Service url
     *
     * @var string
     */
    protected $_url;

    /**
     * API key
     *
     * @var string
     */
    protected $_apiKey;

    /**
     * Connection timeout
     *
     * @var integer
     */
    protected $_timeout = 40;

    /**
     * No. of items per page
     *
     * @var integer
     */
    protected $_itemsPerPage = 100;

    /**
     * No. of items
     *
     * @var integer
     */
    protected $_items;

    /**
     * Maximum no. of items
     *
     * @var integer
     */
    protected $_maxItems;

    /**
     * Current page
     *
     * @var integer
     */
    protected $_page = 1;

    /**
     * No. of pages
     *
     * @var integer
     */
    protected $_pages;

    /**
     * Max no. of pages
     *
     * @var integer
     */
    protected $_maxPages;

    /**
     * List of photos
     *
     * @var array
     */
    protected $_photos;


    /**
     * Constructor
     * 
     * @var Jarek_Gallery 
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set object state from options array
     *
     * @param  array $options
     * @return Jarek_Gallery 
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Set url
     *
     * @param  string $url
     * @return Jarek_Gallery 
     */
    public function setUrl($url)
    {
        $this->_url = (string) $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Set API key
     *
     * @param  string $key
     * @return Jarek_Gallery 
     */
    public function setApiKey($key)
    {
        $this->_apiKey = (string) $key;
        return $this;
    }

    /**
     * Get API key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }

    /**
     * Set timeout
     *
     * @param  integer $timeout
     * @return Jarek_Gallery 
     */
    public function setTimeout($timeout)
    {
        $this->_timeout = (int) $timeout;
        return $this;
    }

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->_timeout;
    }

    /**
     * Set items per page
     *
     * @param  integer $items
     * @return Jarek_Gallery 
     */
    public function setItemsPerPage($items)
    {
        $this->_itemsPerPage = (int) $items;
        return $this;
    }

    /**
     * Get items per page
     *
     * @return integer
     */
    public function getItemsPerPage()
    {
        return $this->_itemsPerPage;
    }

    /**
     * Set Total no. of items
     *
     * @param  integer $items
     * @return Jarek_Gallery 
     */
    public function setItems($items)
    {
        $this->_items = (integer) $items;
        return $this;
    }

    /**
     * Get Total no. of items
     *
     * @return integer
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * Set Max no. of items
     *
     * @param  integer $items
     * @return Jarek_Gallery 
     */
    public function setMaxItems($items)
    {
        $this->_maxItems = (integer) $items;
        return $this;
    }

    /**
     * Get Max no. of items
     *
     * @return integer
     */
    public function getMaxItems()
    {
        return $this->_maxItems;
    }

    /**
     * Set page
     *
     * @param  integer $page
     * @return Jarek_Gallery 
     */
    public function setPage($page)
    {
        $this->_page = (integer) $page;
        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->_page;
    }

    /**
     * Set Total no. of pages
     *
     * @param  integer $pages
     * @return Jarek_Gallery 
     */
    public function setPages($pages)
    {
        $this->_pages = (integer) $pages;
        return $this;
    }

    /**
     * Get Total no. of pages
     *
     * @return integer
     */
    public function getPages()
    {
        return $this->_pages;
    }

    /**
     * Set Max no. of pages
     *
     * @param  integer $pages
     * @return Jarek_Gallery 
     */
    public function setMaxPages($pages)
    {
        $this->_maxPages = (integer) $pages;
        return $this;
    }

    /**
     * Get Max no. of pages
     *
     * @return integer
     */
    public function getMaxPages()
    {
        return $this->_maxPages;
    }

    /**
     * Set photos
     * 
     * @param  array $photos
     * @return Jarek_Gallery
     */
    public function setPhotos($photos)
    {
        $this->_photos = (array) $photos;
        return $this;
    }

    /**
     * Get photos
     *
     * @return array
     */
    public function getPhotos()
    {
        return $this->_photos;
    }

    /**
     * Search gallery
     *
     * @param  string   $keyword
     * @param  integer  $page
     * @return Jarek_Gallery
     */
    public function search($keyword, $page = null)
    {
        if ($page === null) {
            $page = $this->getPage();
        }
        if ($this->getMaxItems()) {
            $this->setMaxPages(ceil($this->getMaxItems() / $this->getItemsPerPage()));
        }
        
        if ($page < 1) {
            $page = 1;
        }
        if ($this->getMaxPages() && ($page > $this->getMaxPages())) {
            $page = $this->getMaxPages();
        }
        $args = array(
            'method'       => 'flickr.photos.search',
            'api_key'      => $this->getApiKey(),
            'format'       => 'php_serial',
            'text'         => $keyword,
            'content_type' => 1,
            'per_page'     => $this->getItemsPerPage(),
            'page'         => $page
        );
        $url = $this->getUrl() . '?' . http_build_query($args);

        // Use cURL if it's installed
        if (function_exists('curl_version')) {
            $resource = curl_init();
            curl_setopt($resource, CURLOPT_URL, $url);
            curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($resource, CURLOPT_ENCODING , 'gzip'); 
            curl_setopt($resource, CURLOPT_CONNECTTIMEOUT, $this->getTimeout());
            curl_setopt($resource, CURLOPT_TIMEOUT, $this->getTimeout());
            $response = curl_exec($resource);
            if (empty($response)) {
                throw new \Exception(curl_error($resource));
            }
            curl_close($resource);
        } else {
            $response = '';
            $resource = fopen($url, 'r');
            if ($resource) {
                stream_set_timeout($resource, $this->getTimeout());
                while (($buffer = fgets($resource, 4096)) !== false) {
                    $response .= $buffer;
                }
                if (!feof($resource)) {
                    throw new \Exception('Cannot read from Web Service');
                }
                fclose($resource);
            } else {
                throw new \Exception('Cannot connect to Web Service');
            }
        }

        if ($response) {
            $data = unserialize($response);
            if ($data !== FALSE) {
                if ($data['stat'] === 'ok') {
                    $this->setPage($data['photos']['page'])
                         ->setPages($data['photos']['pages'])
                         ->setItems($data['photos']['total'])
                         ->setItemsPerPage($data['photos']['perpage']);
                    // Set max no. of pages
                    if ($this->getMaxPages() && ($this->getPages() > $this->getMaxPages())) {
                        $this->setPages($this->getMaxPages());
                    }
                    if (is_array($data['photos']['photo'])
                        && !empty($data['photos']['photo'])) {
                        $photos = array();
                        foreach ($data['photos']['photo'] as $photo) {
                            $photos[] = new Photo($photo);
                        }
                        $this->setPhotos($photos);
                    }
                } else {
                    throw new \Exception('Error: ' . $data['message']);
                }
            } else {
                throw new \Exception('Cannot unserialize response');
            }
            return true;
        }
        return false;
    }
}
