<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MyAppPIBundle:Categories')->findAll();

        return $this->render('@MyAppPI/categories/menu.html.twig', array('categories' => $categories));
    }
}
