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


class TestController extends Controller
{

    /**
     * @Route("/", name="homepage")
     *
     */

    public function defaultAction (Request $request) {
        return new Response("Bienvenue");
    }



    /**
     * @Route("/testLiaison", name="testTableDeLiaison")
     */

    public function testAction(Request $request) {

//        On créé un nouveau Student

        $student = new Student();
        $student->setFirstname("paul");
        $student->setLastname("dupont");
        $student->setBirthDate(new \DateTime(1995-07-20));
        $student->setAddress("8Rue du commandant Charcot");
        $student->setPhone("060610630606");
        $student->setEmail("paula.dupont@gmail.com");

//        On récupère dans la DB les données que l'on veut

        $skillStudent = $this->getDoctrine()
            ->getRepository('AppBundle:Skill')
            ->findBy(
                array('name' => "Python"),
                array("name" => "Django"),
                array("name" => "Drupal"),
                array("name" => "HTML5"),
                array("name" => "CSS3"),
                array("name" => "MySQL"),
                array("name" => "Developpement Back-End"),
                array("name" => "Javascript")
            );

        dump($skillStudent);

//        On ajoute au nouveau student les compétences recupérées dans la DB
        $student->addSkill($skillStudent);

//       On envoie les données à la DB
        $this->getDoctrine()->getEntityManager()->persist($student);
        $this->getDoctrine()->getEntityManager()->flush();


        return new Response("Test OK");

    }



    /**
     * @Route("/testLog", name="loginPage")
     */

    public function testLoginAction(Request $request)
    {

//          Récupération des données correspondant au login de connexion si correspondance
        $identifiants = $this->getDoctrine()
            ->getRepository('AppBundle:user')
            ->findAll();
        /* @var $identifiant user */

//          Si identifiants n'existent pas dans la table
        if (!$identifiants) {
            throw $this->createNotFoundException(
                'No login found for ' . $identifiants
            );
        }

//          On crée un tableau pour stocker les infos de la table
        $infosUser = [];
        foreach ($identifiants as $identifiant) {
            $infosUser = [
                'login' => $identifiant->getLogin(),
                'id' => $identifiant->getId(),
                'firstname' => $identifiant->getFirstname(),
                'lastname' => $identifiant->getLastname()
            ];
        }

//          Vu twig pour test
        return $this->render('default/test.html.twig', [
            'name' => new JsonResponse($infosUser)
        ]);

    }
//        $test = array('login'=> 'admin', 'password' => "admin");
//        return new JsonResponse($test);



}
