<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\cmd;
use CommandeBundle\Form\cmdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class gestioncmdController extends Controller
{
    public function ajoutCmdClientAction(Request $request)
    {
        $cmd = new cmd();
        $form = $this->createForm(cmdType::class,$cmd);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($cmd);
            $em->flush();
        }

        return $this->render("@Commande/Commande/ajoutC.html.twig",array("form"=>$form->createView()));
    }

    public function afficheCmdAdminAction()
    {
        $em=$this->getDoctrine()->getManager();
        $cmd=$em->getRepository("CommandeBundle:cmd")->findAll();
        return $this->render("@Commande/Commande/afficheC.html.twig",array("cmd"=>$cmd));
    }

    public function supprimerCmdAdminAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $cmd = $em->getRepository(cmd::class)->find($id);
        $em->remove($cmd);
        $em->flush();
        return $this->redirectToRoute('commande_affiche_admin');
    }
}
