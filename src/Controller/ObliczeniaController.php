<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObliczeniaController extends AbstractController
{
    #[Route('/', name:'homepage')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/oblicz', name:'oblicz')]
    public function oblicz(Request $request): Response
    {
        $godzinaRozpoczecia = $request->request->get('godzinaRozpoczecia');
        $godzinaZakonczenia = $request->request->get('godzinaZakonczenia');

        $godzinaRozpoczeciaParse = explode(':', $godzinaRozpoczecia);
        $godzinaZakonczeniaParse = explode(':', $godzinaZakonczenia);

        $godzinaRozpoczeciaGodziny = (int) $godzinaRozpoczeciaParse[0];
        $godzinaRozpoczeciaMinuty = isset($godzinaRozpoczeciaParse[1]) ? (int) $godzinaRozpoczeciaParse[1] : 0;
        $godzinaZakonczeniaGodziny = (int) $godzinaZakonczeniaParse[0];
        $godzinaZakonczeniaMinuty = isset($godzinaZakonczeniaParse[1]) ? (int) $godzinaZakonczeniaParse[1] : 0;

        $roznicaGodzin = $godzinaZakonczeniaGodziny - $godzinaRozpoczeciaGodziny;
        $roznicaMinut = $godzinaZakonczeniaMinuty - $godzinaRozpoczeciaMinuty;

        if($roznicaGodzin < 0){
            $roznicaGodzin += 24;
        }
        if($roznicaMinut < 0 && $roznicaGodzin == 0){
            $roznicaMinut += 60;
            $roznicaGodzin += 24;
            $roznicaGodzin--;
        }elseif($roznicaMinut < 0 && $roznicaGodzin != 0){
            $roznicaGodzin--;
            $roznicaMinut += 60;
        }
        return $this->render('index.html.twig', [
            'roznicaGodzin' => $roznicaGodzin,
            'roznicaMinut' => $roznicaMinut,
            'godzinaRozpoczecia' => $godzinaRozpoczecia,
            'godzinaZakonczenia' => $godzinaZakonczenia,
        ]);
    }
}
