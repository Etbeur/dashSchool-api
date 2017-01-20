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
        // On récupère l'EntityManager
        $em = $this->getDoctrine()
            ->getManager();


//        Récupération du listing des élèves

        $dataStudent = $this->getDoctrine()
            ->getRepository('AppBundle:Student')
            ->findAll();



        $infoStudent = [];

        foreach ($dataStudent as $student) {

//          Pour chaque élève on récupère les infos et on les push dans le tableau qui sera envoyé en JSON

            $infoSkill = $student->getSkills();

            foreach ($infoSkill as $skills){
                $test = $skills->getName();
//                dump($test);
            }



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
                'skill'=>$test
            ];

        }

        //      Vu twig pour test
        return $this->render('default/test.html.twig', [
            'name' => new JsonResponse($infoStudent)
        ]);


    }
}