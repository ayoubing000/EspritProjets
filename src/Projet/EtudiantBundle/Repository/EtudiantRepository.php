<?php

namespace Projet\EtudiantBundle\Repository;
use Doctrine\ORM\EntityRepository;


class EtudiantRepository extends EntityRepository
{
    public function compteDQL($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("select count(e) as nb from ProjetEtudiantBundle:Etudiant e 
                               where e.projet=:n")
            ->setParameter('n',$id);
        return $query->getResult();
    }
}
