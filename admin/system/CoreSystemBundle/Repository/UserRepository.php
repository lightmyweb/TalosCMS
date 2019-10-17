<?php
namespace CoreSystemBundle\Repository;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Doctrine\ORM\NoResultException;

use CoreSystemBundle\Entity\User;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        $q = $this
        ->createQueryBuilder('u')
        ->where('u.username = :username OR u.email = :email')
        ->andWhere('u.active = TRUE')
        ->setParameter('username', $username)
        ->setParameter('email', $username)
        ->getQuery();

        try {
            // La méthode Query::getSingleResult() lance une exception
            // s'il n'y a pas d'entrée correspondante aux critères
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin AcmeUserBundle:User object identified by "%s".', $username), 0, $e);
        }

        return $user;


    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getIdUser());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }

    public function getTotalCount()
    {
        return $this
            ->createQueryBuilder('p')
            ->select('COUNT(p.idUser)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}