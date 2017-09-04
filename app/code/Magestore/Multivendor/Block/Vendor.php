<?php
namespace Magestore\Multivendor\Block;
class Vendor extends \Magento\Framework\View\Element\Template
{
    protected $_objectManager;
    protected $_storeManager;
    protected $_configHelper;
    const STATUS_ENABLED = 1;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magestore\Multivendor\Helper\Config $configHelper,
        array $data
    )
    {
        $this->_configHelper = $configHelper;
        $this->_objectManager = $objectManager;
        $this->_storeManager = $context->getStoreManager();
        parent::__construct($context, $data);
    }

    public function getVendorCollection() {
        $vendorCollection = $this->_objectManager->create('Magestore\Multivendor\Model\ResourceModel\Vendor\Collection')
            ->addFieldToFilter('status',self::STATUS_ENABLED);
        return $vendorCollection;
    }

    public function getStoreManager() {
        return $this->_storeManager;
    }

    public function getMediaUrlImage($imagePath = '')
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $imagePath;
    }
    public function  toHtml()
    {
        if($this->_configHelper->getStoreConfig('multivendor/general/active') == 0){
            return '';
        }
        else{
            return parent::toHtml(); // TODO: Category the autogenerated stub
        }
    }
}