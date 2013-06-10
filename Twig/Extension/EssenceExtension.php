<?php

namespace Kayue\EssenceBundle\Twig\Extension;

use Kayue\EssenceBundle\Essence\Essence;

class EssenceExtension extends \Twig_Extension
{
    protected $essence;

    function __construct(Essence $essence)
    {
        $this->essence = $essence;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "essence";
    }

    public function getFunctions()
    {
        return array(
            'essence_embed' => new \Twig_Function_Method($this, 'embed')
        );
    }

    public function getFilters()
    {
        return array(
            'essence_replace' => new \Twig_Filter_Method($this, 'replace')
        );
    }

    public function embed($url, array $options = array())
    {
        return $this->essence->embed($url, $options);
    }

    public function replace($text, $template = "")
    {
        return $this->essence->replace($text, $template);
    }
}