<?php
namespace Vikhyat\BlogManager\Api;

use Vikhyat\BlogManager\Api\Data\BlogIndexerInterface;

interface BlogIndexerRepositoryInterface
{
    public function save(BlogIndexerInterface $blogIndexer);
    public function getById($id);
    public function getByBlogAndCustomer($blogId, $customerId);
    public function delete(BlogIndexerInterface $blogIndexer);
    public function deleteById($id);
    public function deleteByBlogId($blogId);
}