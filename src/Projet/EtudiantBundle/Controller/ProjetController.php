<?php
/**
 * Created by PhpStorm.
 * User: AchrefSm
 * Date: 07/12/2019
 * Time: 10:13
 */

namespace Projet\EtudiantBundle\Controller;


use Projet\EtudiantBundle\Entity\Etudiant;
use Projet\EtudiantBundle\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjetController extends Controller
{
    public function readProjetAction()
    {

        $projets=$em=$this->getDoctrine()->getRepository(
            Projet::class)->findAll();
        return $this->render("@ProjetEtudiant/Projet/read.html.twig",
            array('projets'=>$projets));
    }

    public function deleteProjetAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $projet=$em->getRepository(Projet::class)->find($id);
        $em->remove($projet);
        $em->flush();

        return $this->redirectToRoute('readProjet');
    }

    public function compteEAction($id)
    {
        $n=$em=$this->getDoctrine()->getRepository(Etudiant::class)
            ->compteDQL($id);

        return $this->render("@ProjetEtudiant/Projet/compte.html.twig",
           array('nb'=>$n));
    }


}