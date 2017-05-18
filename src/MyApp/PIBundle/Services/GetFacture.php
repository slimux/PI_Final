<?php
namespace MyApp\PIBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetFacture
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function facture($facture)
    {
        $html = $this->container->get('templating')->render('@MyAppUser/Default/layout/facturePDF.html.twig', array('facture'=>$facture));
        $html2pdf = $this->container->get('html2pdf_factory')->create();
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return new Response($html2pdf->Output('facture.pdf'), 200, array('Content-Type' => 'application/pdf'));
    }
}