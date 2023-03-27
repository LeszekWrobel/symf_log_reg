<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    //#[IsGranted('ROLE_USER')]
    public function index( /**AuthenticationUtils $authenticationUtils*/): Response
    {
        //$lastUsername = $authenticationUtils->getLastUsername();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');#
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            //'last_username' => $lastUsername 
        ]);
    }
}
