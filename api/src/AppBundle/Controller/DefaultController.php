<?php

namespace AppBundle\Controller;

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

    public function indexAction(Request $request)
    {
        $dataRecup = file_get_contents("php://input");
        $data = json_decode($dataRecup);

        $_POST['login'] = $data->login;
        $_POST['password'] = $data->password;
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $result = array($login, $password);

            return new JsonResponse($result);
        }
        else
        {
            return new JsonResponse(array("pas poste" => "rien arrive"));
        }

    }
//        $test = array('login'=> 'admin', 'password' => "admin");
//        return new JsonResponse($test);
}
