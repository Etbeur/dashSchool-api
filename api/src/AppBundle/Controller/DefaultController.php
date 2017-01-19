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

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="loginPage")
     */

    public function loginAction(Request $request)
    {
//      Récupération du Json envoyé par le formulaire, decode pour pouvoir le lire
        $dataForm = file_get_contents("php://input");
        $data = json_decode($dataForm);

//      On attribut le login et le password récupérés au $_POST pour faire les vérification
        $_POST['login'] = $data->login;
        $_POST['password'] = $data->password;

//      Si les valeurs existe
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

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
                if ($identifiant->getLogin() == $login & $identifiant->getPassword() == $password)
                {
                    $infosUser = [
                        'login' => $identifiant->getLogin(),
                        'id' => $identifiant->getId(),
                        'firstname' => $identifiant->getFirstname(),
                        'lastname' => $identifiant->getlastname()
                    ];
                }
                else
                {
                    $false = array
                    (
                        'responseServer' => "utilisateur non reconnu",
                    );
                    return new JsonResponse($false);
                }
            }

            return new JsonResponse($infosUser);

//          Vu twig pour test
//            return $this->render('default/test.html.twig', [
//                'name' => new JsonResponse($infosUser)
//            ]);
        } else {
            $false = array('aucune reponse possible' => 'data non valide');
            return new JsonResponse($false);
        }
    }
//        $test = array('login'=> 'admin', 'password' => "admin");
//        return new JsonResponse($test);


    /**
     * @Route("/", name="homepage")
     */

    public function testAction(Request $request) {

        $student = new Student();
        $student->setFirstname("paul");
        $student->setLastname("dupont");
        $student->setBirthDate(new \DateTime(1995-07-20));
        $student->setAddress("8Rue du commandant Charcot");
        $student->setPhone("060610630606");
        $student->setEmail("paula.dupont@gmail.com");


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
        $student->addSkill($skillStudent);


        $this->getDoctrine()->getEntityManager()->persist($student);
        $this->getDoctrine()->getEntityManager()->flush();

        return new Response("ca a marché");

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
