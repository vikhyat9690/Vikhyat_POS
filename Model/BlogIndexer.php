<?php
namespace Vikhyat\BlogManager\Model;

use Magento\Framework\Model\AbstractModel;
use Vikhyat\BlogManager\Api\Data\BlogIndexerInterface;
use Vikhyat\BlogManager\Model\ResourceModel\BlogIndexer as ResourceModelBlogIndexer;

class BlogIndexer extends AbstractModel implements BlogIndexerInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModelBlogIndexer::class);
    }

    public function getBlogId()
    {
        return $this->getData(self::BLOG_ID);
    }

    public function setBlogId($id)
    {
        return parent::setData(self::BLOG_ID, $id);
    }

    public function getBlogTitle()
    {
        return $this->getData(self::BLOG_TITLE);
    }

    public function setBlogTitle($title)
    {
        return parent::setData(self::BLOG_TITLE ,$title);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId($id)
    {
        return parent::setData(self::CUSTOMER_ID, $id);
    }

    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    public function setCustomerEmail($email)
    {
        return parent::setData(self::CUSTOMER_EMAIL, $email);
    }

    public function getBlogContent()
    {
        return $this->getData(self::BLOG_CONTENT);
    }

    public function setBlogContet($content)
    {
        return parent::setData(self::BLOG_CONTENT, $content);
    }

    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    public function setCustomerName($name)
    {
        return parent::setData(self::CUSTOMER_NAME, $name);
    }
}