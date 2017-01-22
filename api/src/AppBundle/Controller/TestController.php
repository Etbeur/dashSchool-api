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

    public function defaultAction(Request $request)
    {
        return new Response("Bienvenue");
    }


    /**
     * @Route("/testLiaison", name="testTableDeLiaison")
     */

    public function testAction(Request $request)
    {
//      On créé un nouveau Student
        $student = new Student();
        $student->setFirstname("paul");
        $student->setLastname("dupont");
        $student->setBirthDate(new \DateTime(1995 - 07 - 20));
        $student->setAddress("8Rue du commandant Charcot");
        $student->setPhone("060610630606");
        $student->setEmail("paula.dupont@gmail.com");
//      On récupère dans la DB les données que l'on veut
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
//      On ajoute au nouveau student les compétences recupérées dans la DB
        $student->addSkill($skillStudent);
//      On envoie les données à la DB
        $this->getDoctrine()->getEntityManager()->persist($student);
        $this->getDoctrine()->getEntityManager()->flush();
        return new Response("Test OK");
    }

    /**
     * @Route("/testLog", name="loginPage")
     */

    public function testLoginAction(Request $request)
    {
//      Récupération des données correspondant au login de connexion si correspondance
        $identifiants = $this->getDoctrine()
            ->getRepository('AppBundle:user')
            ->findAll();
        /* @var $identifiant user */
//      Si identifiants n'existent pas dans la table
        if (!$identifiants) {
            throw $this->createNotFoundException(
                'No login found for ' . $identifiants
            );
        }
//      On crée un tableau pour stocker les infos de la table
        $infosUser = [];
        foreach ($identifiants as $identifiant) {
            $infosUser = [
                'login' => $identifiant->getLogin(),
                'id' => $identifiant->getId(),
                'firstname' => $identifiant->getFirstname(),
                'lastname' => $identifiant->getLastname()
            ];
        }
//      Vu twig pour test
        return $this->render('default/test.html.twig', [
            'name' => new JsonResponse($infosUser)
        ]);
    }
//        $test = array('login'=> 'admin', 'password' => "admin");
//        return new JsonResponse($test);

    /**
     * @Route("/student/{id}", name="student", defaults={"id"=null})
     */
    public function formAction(Request $request)
    {
///        On récupère le GET envoyé dans l'url
        $id = $request->get('id');

        if ($id != null) {
//              On récupère le repository Student
            $dataStudent = $this->getDoctrine()
                ->getRepository('AppBundle:Student')
                ->findOneBy(array('id' => $id));

//              On récupère les skills associés à l'étudiant
            $infoSkill = $dataStudent->getSkills();

//            Création d'un tableau dans lequel on mettra chaque compétence au fur et à mesure
            $totalSkills = [];
            for($i = 0; $i < count($infoSkill); $i ++){
                $oneSkill = $infoSkill[$i]->getName();
                array_push($totalSkills, $oneSkill);
            }

//            On crée la fiche élève avec tous les renseignements le concernant
            $infoStudent =
                [
                    'firstname' => $dataStudent->getFirstname(),
                    'lastname' => $dataStudent->getLastname(),
                    'birthDate' => $dataStudent->getBirthDate(),
                    'address' => $dataStudent->getAddress(),
                    'phone' => $dataStudent->getPhone(),
                    'email' => $dataStudent->getEmail(),
                    'emergencyContact' => $dataStudent->getEmergencyContact(),
                    'github' => $dataStudent->getGithub(),
                    'linkedIn' => $dataStudent->getLinkedIn(),
                    'personalProject' => $dataStudent->getPersonalProject(),
                    'photo' => $dataStudent->getPhoto(),
                    'skills' => $totalSkills
                ];

            //     Vu twig pour test
            return $this->render('default/test.html.twig', [
                'name' => new JsonResponse($infoStudent)
            ]);

        }else{
            return new Response('erreur');
        }
    }

    /**
     * @Route("/listingtest", name="listingtest")
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

//      On prend les infos récupérées de la DB pour les séparer élève par élève
        foreach ($dataStudent as $student) {

//          On récupère dans la table de liaison les "skill" associées à l'élève en cours et on les push dans un tab pour pouvoir les renvoyer en jSON au front
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
//        On renvoie les données sous forme de JSON pour qu'elles soient récupérées par le front
        return new JsonResponse($infoStudent);
    }


}