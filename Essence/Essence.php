<?php

namespace Kayue\EssenceBundle\Essence;

use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;

class Essence extends \fg\Essence\Essence
{
    public function __construct($cacheDriver)
    {
        \fg\Essence\Registry::register('cache', new Cache($this->getCache($cacheDriver)));
        parent::__construct();
    }

    private function getCache($name)
    {
        switch($name) {
            case 'apc':
                return new ApcCache();
            default:
                return new ArrayCache();
        }
    }
}