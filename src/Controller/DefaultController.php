<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $response = $this->render('default/index.html.twig'); /* @var $response Response */
        $response->setSharedMaxAge(800);
        $date = new \DateTime();
        $date->modify('+800 seconds');
        $response->setExpires($date);

        //var_dump( get_class_methods('Symfony\Component\HttpFoundation\Response'));die;

        $response->headers->addCacheControlDirective('must-revalidate', false);
        return $response;

    }
}
