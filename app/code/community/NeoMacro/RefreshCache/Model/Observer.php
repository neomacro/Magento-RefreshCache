<?php

class NeoMacro_RefreshCache_Model_Observer extends Mage_Core_Model_Abstract
{
    private static $singleton = false;

    public function refreshCache($observer)
    {
        if (static::$singleton)
            return;

        static::$singleton = $this;

        try {
            // $allTypes = Mage::app()->useCache(); /* All cache types */
            $allTypes = Mage::app()->getCacheInstance()->getInvalidatedTypes(); /* Only invalidated cache types */
            foreach ($allTypes as $type => $value) {
                Mage::app()->getCacheInstance()->cleanType($type);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
