<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\user;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class ListingController extends Controller
{

//        Récupération du listing des élèves
    /**
     * @Route("/listing", name="listing")
     *
     */

    public function listingAction(Request $request)
    {

//        Récuperation de toutes les infos de la table "student"

        $dataStudent = $this->getDoctrine()
            ->getRepository('AppBundle:Student')
            ->findAll();

//        Récupération des infos pour chaque élève -

//      On créé un tab vide dans lequel sera pushé chaque élève

        $infoStudent = [];


//      On prend les infos récupérées de ta DB pour les séparer élève par élève

        foreach ($dataStudent as $student) {

//          On récupère dans la table de liaison les "skill" associées à l'élève en cours et on les ush dans un tab pour pouvoir les renvoyer en jSON au front

            $infoSkill = $student->getSkills();
            $skills = [];
            for ($i = 0; $i < count($infoSkill); $i++) {
                $test = $infoSkill[$i]->getName();
                array_push($skills, $test);
            }

//          On définit les données que l'on va renvoyer en JSON au front

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
                'photo' => $student->getPhoto(),
                'skill' => $skills
            ];
        }

//        On renvoie les données sous forme de JSON pour qu'elel soient récupérées par le front
        return JsonResponse($infoStudent);
    }
}