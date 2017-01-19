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

//      On attribue le login et le password récupéré au $_POST pour faire les vérifications
        $_POST['login'] = $data->login;
        $_POST['password'] = $data->password;

//      Si les valeurs existent
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

//          Récupération des données correspondants au login de connexion si correspondance
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
            $false = array('aucune reponse possible' => 'data non valide');
            return new JsonResponse($false);
        }
    }
}