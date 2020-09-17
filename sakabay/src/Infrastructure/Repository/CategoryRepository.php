<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{

    /**
     * Category code field for type "Beauté"
     */
    const BEAUTY_CODE = 'BEAUTE';

    /**
     * CategoryRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Category::class));
    }

    public function save(Category $category): void
    {
        $this->_em->persist($category);
        $this->_em->flush($category);
    }

    public function delete(Category $category): void
    {
        $this->_em->remove($category);
        $this->_em->flush($category);
    }

    public function getValidateCode()
    {
        $query = $this->createQueryBuilder('ca')->distinct(true);
        $query->where('ca.code = (:codes)');
        $query->setParameter('codes', CategoryRepository::BEAUTY_CODE);

        return $query->getQuery()->getResult();
    }


}
