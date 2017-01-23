<?php
/**
 * Created by PhpStorm.
 * User: etbeur
 * Date: 23/01/17
 * Time: 22:36
 */

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

class DeleteController extends Controller
{
    /**
     * @Route("student/delete/{id}" , name="deleteStudent")
     */
    public function delStudentAction(Request $request)
    {
//        On recupère l'id
        $id = $request->get('id');
//        On crée l'entity manager
        $em = $this->getDoctrine()->getManager();
//        On efface la ligne correspondant à l'id
        $em->remove($id);
        $em->flush();

//        Une fois effacement terminé, on verifie si $id existe encore ou pas
        if($id == null){
            return new JsonResponse(array('effacement ok' => "eleve delete"));
        }
        else
        {
            return new JsonResponse(array('eleve present' => "effacement non valide, eleve present"));
        }



    }
}