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
     * @Route("/login", name="login")
     * Permet de se connecter avec login et password contenus dans la DB
     */
    public function loginAction(Request $request)
    {
        //        Récupération du Json envoyé par le formulaire, decode pour pouvoir le lire
        $dataForm = file_get_contents("php://input");
        $data = json_decode($dataForm);

        //        On attribue le login et le password récupéré en vérifiant leur existance
        if (isset($data->login) && isset($data->password)) {
            $login = $data->login;
            $password = $data->password;

            //            Récupération dans la DB des données de connexion
            $identifiants = $this->getDoctrine()
                ->getRepository('AppBundle:user')
                ->findAll();

            /* @var $identifiant user */
            //            Si identifiants n'existe pas dans la table
            if (!$identifiants) {
                throw $this->createNotFoundException(
                    'No login found for ' . $identifiants
                );
            }

            //            On crée un tableau pour stocker les infos de la table
            $infosUser = [];
            foreach ($identifiants as $identifiant) {
                if ($identifiant->getLogin() == $login & $identifiant->getPassword() == $password) {
                    $infosUser = [
                        'login' => $identifiant->getLogin(),
                        'id' => $identifiant->getId(),
                        'firstname' => $identifiant->getFirstname(),
                        'lastname' => $identifiant->getlastname()
                    ];
                } else {
                    $false = array
                    (
                        'responseServer' => "utilisateur non reconnu",
                    );
                    return new JsonResponse($false);
                }
            }
            return new JsonResponse($infosUser);
        } else {
            $false = array('Response' => 'data non valide');
            return new JsonResponse($false);
        }
    }


    /**
     * @Route("/listing", name="listing")
     *
     */
    public function listingAction(Request $request)
    {
        //        Récuperation de toutes les infos de la table "skill"
        $dataSkill = $this->getDoctrine()
            ->getRepository('AppBundle:Skill')
            ->findAll();

        //        Récupération des compétences
        $allSkills = [];
        foreach ($dataSkill as $skill) {
            //            On définit les données que l'on va renvoyer en JSON au front
            $allSkills[] = [
                'id' => $skill->getId(),
                'name' => $skill->getName(),
            ];
        }

        //        Récuperation de toutes les infos de la table "student"
        $dataStudent = $this->getDoctrine()
            ->getRepository('AppBundle:Student')
            ->findAll();

        //        Récupération des infos pour chaque élève

        //      On créé un tab vide dans lequel sera pushé chaque élève
        $infoStudent = [];

        //      On prend les infos récupérées de la DB pour les séparer élève par élève
        //        On renvoie les données sous forme de JSON pour qu'elles soient récupérées par le front
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
                'gender' => $student->getGender(),
                'birthDate' => $student->getBirthDate(),
                'address' => $student->getAddress(),
                'phone' => $student->getPhone(),
                'email' => $student->getEmail(),
                'emergencyContact' => $student->getEmergencyContact(),
                'github' => $student->getGithub(),
                'linkedIn' => $student->getLinkedIn(),
                'personalProject' => $student->getPersonalProject(),
                'photo' => $student->getPhoto(),
                'skills' => $skills,
                'availableSkills' => $allSkills
            ];
        }
        return new JsonResponse($infoStudent);

    }


    /**
     * @Route("listing/detailStudent/{id}", name="listing/detailStudent", defaults = {"id" = null})
     */
    public function formAction(Request $request)
    {
        //        On récupère le GET envoyé dans l'url
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
            for ($i = 0; $i < count($infoSkill); $i++) {
                $oneSkill = $infoSkill[$i]->getName();
                array_push($totalSkills, $oneSkill);
            }

            //            On crée la fiche élève avec tous les renseignements le concernant
            $infoStudent =
                [
                    'id' => $dataStudent->getId(),
                    'firstname' => $dataStudent->getFirstname(),
                    'lastname' => $dataStudent->getLastname(),
                    'gender' => $dataStudent->getGender(),
                    'birthDate' => $dataStudent->getBirthDate(),
                    'address' => $dataStudent->getAddress(),
                    'phone' => $dataStudent->getPhone(),
                    'email' => $dataStudent->getEmail(),
                    'emergencyContact' => $dataStudent->getEmergencyContact(),
                    'github' => $dataStudent->getGithub(),
                    'linkedIn' => $dataStudent->getLinkedIn(),
                    'personalProject' => $dataStudent->getPersonalProject(),
                    'photo' => $dataStudent->getPhoto(),
                    //                    On ajoute le tableau des compétences à la fiche de l'élève
                    'skills' => $totalSkills
                ];
            //            On retourne sous forme de JSON le tableau avec toutes les informations
            return new JsonResponse($infoStudent);
        } else {
            $false = array('Response' => 'Pas deleve selectionne');
            return new JsonResponse($false);
        }
    }
}