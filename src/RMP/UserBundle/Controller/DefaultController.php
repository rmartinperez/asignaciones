<?php

namespace RMP\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RMPUserBundle:Default:index.html.twig');
    }
}
