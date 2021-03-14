<?php

namespace App\Model\Repository;

use App\Model\Entity\Result;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

final class ResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Result::class);
    }

    public function save(Result $result)
    {
        try {
            $this->_em->persist($result);
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            $this->logger->error(sprintf("%s exception thrown while saving Result with %s", get_class($e), $result->getRoutingKey()));
            throw new ApplicationException(Response::HTTP_INTERNAL_SERVER_ERROR, "Something went wrong on our side, please try again in a few minutes", $e);
        }
    }
}