<?php
/**
 * Page class
 *
 * @author jarek
 */
namespace Jarek;

class Page
{
    /**
     * Layout scripts folder
     *
     * @var string
     */
    protected $_layoutPath = '../views/layouts/';

    /**
     * View scripts folder
     *
     * @var string
     */
    protected $_viewPath = '../views/scripts/';

    /**
     * Charset
     *
     * @var string
     */
    protected $_charset = 'UTF-8';

    /**
     * Title
     *
     * @var string
     */
    protected $_title;

    /**
     * Layout script
     *
     * @var string
     */
    protected $_layout;

    /**
     * View script
     *
     * @var string
     */
    protected $_view;

    /**
     * List of CSS files
     *
     * @var array
     */
    protected $_styles;

    /**
     * List of JavaScript files
     *
     * @var array
     */
    protected $_scripts;

    /**
     * List of input params
     *
     * @var array
     */
    protected $_params;

    /**
     * Page content
     *
     * @var string
     */
    protected $_content;


    /**
     * Constructor
     * 
     * @var Page 
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
     * @return Page 
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
     * Set layout scripts path
     * 
     * @param  string $path
     * @return Page 
     */
    public function setLayoutPath($path)
    {
        $this->_layoutPath = (string) $path;
        return $this;
    }

    /**
     * Get layout scripts path
     *
     * @return string
     */
    public function getLayoutPath()
    {
        return $this->_layoutPath;
    }

    /**
     * Set view scripts path
     * 
     * @param  string $path
     * @return Page 
     */
    public function setViewPath($path)
    {
        $this->_viewPath = (string) $path;
        return $this;
    }

    /**
     * Get view scripts path
     *
     * @return string
     */
    public function getViewPath()
    {
        return $this->_viewPath;
    }

    /**
     * Set charset
     * 
     * @param  string $charset
     * @return Page 
     */
    public function setCharset($charset)
    {
        $this->_charset = (string) $charset;
        return $this;
    }

    /**
     * Get charset
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * Set title
     * 
     * @param  string $title
     * @return Page 
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
     * Set layout
     * 
     * @param  string $layout
     * @return Page 
     */
    public function setLayout($layout)
    {
        $this->_layout = (string) $layout;
        return $this;
    }

    /**
     * Get layout
     *
     * @return string
     */
    public function getLayout()
    {
        return $this->_layout;
    }

    /**
     * Set view
     * 
     * @param  string $view
     * @return Page 
     */
    public function setView($view)
    {
        $this->_view = (string) $view;
        return $this;
    }

    /**
     * Get view
     *
     * @return string
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * Set styles
     * 
     * @param  array $styles
     * @return Page 
     */
    public function setStyles($styles)
    {
        $this->_styles = (array) $styles;
        return $this;
    }

    /**
     * Get styles
     *
     * @return array
     */
    public function getStyles()
    {
        return $this->_styles;
    }

    /**
     * Set scripts
     * 
     * @param  array $scripts
     * @return Page 
     */
    public function setScripts($scripts)
    {
        $this->_scripts = (array) $scripts;
        return $this;
    }

    /**
     * Get scripts
     *
     * @return array
     */
    public function getScripts()
    {
        return $this->_scripts;
    }

    /**
     * Set params
     * 
     * @param  array $params
     * @return Page 
     */
    public function setParams($params)
    {
        $this->_params = (array) $params;
        return $this;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }


    /**
     * Get param
     *
     * @param  string $key
     * @return mixed
     */
    public function getParam($key, $escape = true)
    {
        if (!key_exists($key, $this->_params)) {
            return null;
        }
        return $escape ? $this->escape($this->_params[$key]) : $this->_params[$key];
    }

    /**
     * Set content
     *
     * @return string
     */
    public function setContent($content)
    {
        return $this->_content = $content;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Render title
     *
     * @return string
     */
    public function renderTitle()
    {
        return '<title>' . $this->getTitle(). '</title>';
    }

    /**
     * Render meta tags
     *
     * @return string
     */
    public function renderMeta()
    {
        return '<meta http-equiv="Content-Type" content="text/html; charset='
               . $this->getCharset(). '" />';
    }
    
    /**
     * Render styles
     *
     * @return string
     */
    public function renderStyles()
    {
        $content = '';
        $styles = $this->getStyles();
        if (is_array($styles) && !empty($styles)) {
            foreach ($styles as $file) {
                $content .= '<link rel="stylesheet" type="text/css" href="'
                          . $file . '" />';
            }
        }
        return $content;
    }
     
    /**
     * Escape param
     *
     * @param  string $param
     * @return string
     */
    public function escape($param)
    {
        return htmlentities($param);
    }

    /**
     * Render script
     *
     * @param  string  $view
     * @param  array   $params
     * @param  string  $path [Optional]
     * @return string
     */
    public function renderScript($view, $params, $path = null)
    {
        if ($view === null) {
            throw new \Exception('No view defined');
        }
        if ($path === null) {
            $path = $this->getViewPath();
        }
        $stored = $this->getParams();
        $this->setParams($params);
        ob_start();
        include $path . $view;
        // restore params
        $this->setParams($stored);
        return ob_get_clean();
    }

    /**
     * Render page
     *
     * @param  string $view
     * @param  array  $params
     * @return string
     */
    public function render($view, $params)
    {
        // render view
        $this->setContent($this->renderScript($view, $params));

        // render layout if it's set
        $layout = $this->getLayout();
        if ($layout !== null) {
            $content = $this->renderScript(
                           $layout,
                           null,
                           $this->getLayoutPath()
                       );
            $this->setContent($content);
        }

        return $this->getContent();
    }
}
