<?php
/**
 * Created by PhpStorm.
 * User: AchrefSm
 * Date: 07/12/2019
 * Time: 11:17
 */

namespace Projet\EtudiantBundle\Controller;


use Projet\EtudiantBundle\Entity\Etudiant;
use Projet\EtudiantBundle\Entity\Projet;
use Projet\EtudiantBundle\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EtudiantController extends Controller
{

    public function createEtudiantAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form=$form->handleRequest($request);
        if($form->isValid())
        {
            $niveau=$etudiant->getNiveau();
            $em=$this->getDoctrine();
            $projets=$em->getRepository(Projet::class)->findByNiveau($niveau);
            if($projets!=NULL)
            {
                $seulprojet=$projets[0];
                $etudiant->setProjet($seulprojet);
                $em=$em->getManager();
                $em->persist($etudiant);
                $em->flush();

            }
            else
            {
                return new Response("qsndfnhjh");
            }

            return $this->redirectToRoute('CreateEtudiant');


        }
        return $this->render('@ProjetEtudiant/Etudiant/create.html.twig',array(
            'form'=>$form->createView()
        ));
    }
}