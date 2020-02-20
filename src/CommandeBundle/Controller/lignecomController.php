<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\cmd;
use CommandeBundle\Entity\lignecmd;
use CommandeBundle\Form\lignecmdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class lignecomController extends Controller
{
    public function ajoutLigneClientAction(Request $request)
    {
        $lignecmd = new lignecmd();
        $form=$this->createForm(lignecmdType::class,$lignecmd);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($lignecmd);
            $em->flush();
        }

        return $this->render("@Commande/Ligne/ajoutL.html.twig",array('form'=>$form->createView()));
    }

    public function afficherLigneClientAction()
    {
        $em=$this->getDoctrine()->getManager();
        $lignecmd = $em->getRepository(lignecmd::class)->findAll();
        return $this->render("@Commande/Ligne/afficheL.html.twig",array("lignecmd"=>$lignecmd));
    }
}
