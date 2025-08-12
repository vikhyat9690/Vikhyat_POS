<?php

namespace Vikhyat\BlogManager\Api\Data;

interface BlogIndexerInterface
{
    const INDEX_ID = 'index_id';
    const BLOG_ID = 'blog_id';
    const CUSTOMER_ID = 'customer_id';
    const BLOG_TITLE = 'title';
    const BLOG_CONTENT = 'content';
    const CUSTOMER_NAME = 'customer_name';
    const CUSTOMER_EMAIL = 'customer_email';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getBlogId();
    public function setBlogId($id);
    public function getCustomerId();
    public function setCustomerId($id);
    public function getBlogTitle();
    public function setBlogTitle($title);
    public function getBlogContent();
    public function setBlogContet($content);
    public function getCustomerName();
    public function setCustomerName($name);
    public function getCustomerEmail();
    public function setCustomerEmail($email);
}
