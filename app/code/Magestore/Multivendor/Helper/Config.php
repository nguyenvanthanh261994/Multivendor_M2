<?php
/**
 * Created by PhpStorm.
 * User: anhnc
 * Date: 16/01/2017
 * Time: 13:56
 */

namespace Magestore\Multivendor\Helper;


class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getStoreConfig($path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}