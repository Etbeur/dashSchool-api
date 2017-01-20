<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\user;

use AppBundle\Entity\Skill;
use AppBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class ListingController extends Controller
{


    /**
     * @Route("/listing", name="listing")
     *
     */

    public function listingAction(Request $request)
    {

//        Récupération du listing des élèves

        $dataStudent = $this->getDoctrine()
            ->getRepository('AppBundle:Student')
            ->findAll();



        $infoStudent = [];
        foreach ($dataStudent as $student) {

//          Pour chaque élève on récupère les infos et on les push dans le tableau qui sera envoyé en JSON

            $infoStudent[] = [
                'id' => $student->getId(),
                'firstname' => $student->getFirstname(),
                'lastname' => $student->getLastname(),
                'birthDate' => $student->getBirthDate(),
                'Address' => $student->getAddress(),
                'Phone' => $student->getPhone(),
                'EMail' => $student->getEmail(),
                'EmergencyContect' => $student->getEmergencyContact(),
                'Github' => $student->getGithub(),
                'LinkedIn' => $student->getLinkedIn(),
                'PersonalProject' => $student->getPersonalProject(),
                'photo' => $student->getPhoto()
                ];
        }
//        On renvoie le tableau JSON pour le front
        
        return new JsonResponse($infoStudent);


    }
}