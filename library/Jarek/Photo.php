<?php
/**
 * Class for Photo
 *
 * @author jarek
 */
namespace Jarek;

class Photo
{
    /**
     * Code of thumbnail size
        * 
     * s	small square 75x75
     * q	large square 150x150
     * t	thumbnail, 100 on longest side
     * m	small, 240 on longest side
     * n	small, 320 on longest side
     * -	medium, 500 on longest side
     * z	medium 640, 640 on longest side
     * c	medium 800, 800 on longest side†
     * b	large, 1024 on longest side*
     * o	original image, either a jpg, gif or png, depending on source format
     * source: http://www.flickr.com/services/api/misc.urls.html
     *
     * @var string
     */
    protected $_thumbSize = 'q';

    /**
     * Identifier
     *
     * @var integer
     */
    protected $_id;

    /**
     * Farm id
     *
     * @var integer
     */
    protected $_farm;

    /**
     * Server id
     *
     * @var integer
     */
    protected $_server;

    /**
     * Secret
     *
     * @var string
     */
    protected $_secret;

    /**
     * Title
     *
     * @var string
     */
    protected $_title;

    /**
     * Owner
     *
     * @var string
     */
    protected $_owner;


    /**
     * Constructor
     * 
     * @var Photo 
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
     * @return Photo 
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
     * Set thumbnail size code
     * 
     * @param  string $code
     * @return Photo 
     */
    public function setThumbSize($code)
    {
        $this->_thumbSize = (string) $code;
        return $this;
    }

    /**
     * Get thumbnail size code
     *
     * @return string
     */
    public function getThumbSize()
    {
        return $this->_thumbSize;
    }

    /**
     * Set id
     * 
     * @param  integer $id
     * @return Photo 
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set farm id
     * 
     * @param  integer $id
     * @return Photo 
     */
    public function setFarm($id)
    {
        $this->_farm = (int) $id;
        return $this;
    }

    /**
     * Get farm id
     *
     * @return integer
     */
    public function getFarm()
    {
        return $this->_farm;
    }

    /**
     * Set server id
     * 
     * @param  integer $id
     * @return Photo 
     */
    public function setServer($id)
    {
        $this->_server = (int) $id;
        return $this;
    }

    /**
     * Get server id
     *
     * @return integer
     */
    public function getServer()
    {
        return $this->_server;
    }

    /**
     * Set secret
     * 
     * @param  string $secret
     * @return Photo 
     */
    public function setSecret($secret)
    {
        $this->_secret = (string) $secret;
        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->_secret;
    }

    /**
     * Set title
     * 
     * @param  string $title
     * @return Photo 
     */
    public function setTitle($title)
    {
        $this->_title = (string) $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set owner
     * 
     * @param  string $owner
     * @return Photo 
     */
    public function setOwner($owner)
    {
        $this->_owner = (string) $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * Get original url
     *
     * @return string
     */
    public function getUrl()
    {
        return 'http://farm' . $this->getFarm() . '.staticflickr.com/'
                . $this->getServer() . '/' . $this->getId() . '_'
                . $this->getSecret() . '.jpg';
    }

    /**
     * Get thhumbnail url
     *
     * @return string
     */
    public function getThumbUrl()
    {
        return 'http://farm' . $this->getFarm() . '.staticflickr.com/'
                . $this->getServer() . '/' . $this->getId() . '_'
                . $this->getSecret() . '_' . $this->getThumbSize() . '.jpg';
    }
}
