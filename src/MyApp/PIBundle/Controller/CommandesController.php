<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\PIBundle\Entity\Commandes;
use MyApp\PIBundle\Entity\Produits;
use MyApp\PIBundle\Entity\UtilisateursAdresses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swift_Message;

class CommandesController extends Controller
{
    public function facture(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
//        $generator = $this->container->get('security.secure_random');
        $session = $request->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTVA = 0;

        $facturation = $em->getRepository('MyAppPIBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('MyAppPIBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits = $em->getRepository('MyAppPIBundle:Produits')->findArray(array_keys($session->get('panier')));

        foreach($produits as $produit)
        {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = ($produit->getPrix() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $totalHT += $prixHT;

            if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
                $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT,2);
            else
                $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT,2);

            $totalTVA += round($prixTTC - $prixHT,2);

            $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                'quantite' => $panier[$produit->getId()],
                'prixHT' => round($produit->getPrix(),2),
                'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(),2));
        }

        $commande['livraison'] = array('prenom' => $livraison->getPrenom(),
            'nom' => $livraison->getNom(),
            'telephone' => $livraison->getTelephone(),
            'adresse' => $livraison->getAdresse(),
            'cp' => $livraison->getCp(),
            'ville' => $livraison->getVille(),
            'pays' => $livraison->getPays(),
            'complement' => $livraison->getComplement());

        $commande['facturation'] = array('prenom' => $facturation->getPrenom(),
            'nom' => $facturation->getNom(),
            'telephone' => $facturation->getTelephone(),
            'adresse' => $facturation->getAdresse(),
            'cp' => $facturation->getCp(),
            'ville' => $facturation->getVille(),
            'pays' => $facturation->getPays(),
            'complement' => $facturation->getComplement());

        $commande['prixHT'] = round($totalHT,2);
        $commande['prixTTC'] = round($totalHT + $totalTVA,2);

        return $commande;
    }

    public function prepareCommandeAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('MyAppPIBundle:Commandes')->find($session->get('commande'));

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture($request));

        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();

        return new Response($commande->getId());
    }



    public function validationCommandeAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('MyAppPIBundle:Commandes')->find($id);

        if (!$commande || $commande->getValider() == 1)
            throw $this->createNotFoundException('La commande n\'existe pas');

        $commande->setValider(1);
        $commande->setReference($this->container->get('setNewReference')->reference()); //Service
        $em->flush();

        $session = $request->getSession();
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');

        $message = \Swift_Message::newInstance()
                    ->setSubject('Validation de votre commande')
                    ->setFrom(array('escudotest@gmail.com' => "Tunisia Game Space"))
                    ->setTo($commande->getUtilisateur()->getEmailCanonical())
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->renderView('MyAppPIBundle:layout:validationCommande.html.twig',array('utilisateur' => $commande->getUtilisateur())));
        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès, Veuillez vérifier votre boite mail');
        return $this->redirect($this->generateUrl('factures'));
    }

//    public function prepareAction()
//    {
//        $gatewayName = 'offline';
//
//        $storage = $this->get('payum')->getStorage('MyApp\PIBundle\Entity\Payment');
//
//        $payment = $storage->create();
//        $payment->setNumber(uniqid());
//        $payment->setCurrencyCode('EUR');
//        $payment->setTotalAmount(123); // 1.23 EUR
//        $payment->setDescription('A description');
//        $payment->setClientId('anId');
//        $payment->setClientEmail('foo@example.com');
//
//        $storage->update($payment);
//
//        $captureToken = $this->get('payum')->getTokenFactory()->createCaptureToken(
//            $gatewayName,
//            $payment,
//            'done' // the route to redirect after capture
//        );
//
//        return $this->redirect($captureToken->getTargetUrl());
//    }
//
//    public function doneAction(Request $request)
//    {
//        $token = $this->get('payum')->getHttpRequestVerifier()->verify($request);
//
//        $gateway = $this->get('payum')->getGateway($token->getGatewayName());
//
//        // you can invalidate the token. The url could not be requested any more.
//        // $this->get('payum')->getHttpRequestVerifier()->invalidate($token);
//
//        // Once you have token you can get the model from the storage directly.
//        //$identity = $token->getDetails();
//        //$payment = $this->get('payum')->getStorage($identity->getClass())->find($identity);
//
//        // or Payum can fetch the model for you while executing a request (Preferred).
//        $gateway->execute($status = new GetHumanStatus($token));
//        $payment = $status->getFirstModel();
//
//        // you have order and payment status
//        // so you can do whatever you want for example you can just print status and payment details.
//
//        return new JsonResponse(array(
//            'status' => $status->getValue(),
//            'payment' => array(
//                'total_amount' => $payment->getTotalAmount(),
//                'currency_code' => $payment->getCurrencyCode(),
//                'details' => $payment->getDetails(),
//            ),
//        ));
//    }
}
