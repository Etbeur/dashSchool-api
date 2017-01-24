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

class modifyController extends Controller
{
    /**
     * @Route("/student/update/{id}", name="student", defaults = {"id" = null})
     */
    public function editStudentAction(Request $request)
    {

////        Récupération du Json envoyé par le formulaire, decode pour pouvoir le lire
//        $dataForm = file_get_contents("php://input");
//        $data = json_decode($dataForm);

//        On récupère le GET envoyé dans l'url
        $id = $request->get('id');

//        On récupère l'Entity manager
        $em = $this->getDoctrine()->getManager();

//        On récupère le repository Student
        $student = $em->getRepository('AppBundle:Student')->findOneBy(array('id' => $id));

        //              On récupère les skills associés à l'étudiant
        $infoSkill = $student->getSkills();
        dump($infoSkill);

        //            On supprimes toutes les compétences de l'eleve
        foreach ($infoSkill as $skillDelete){
            $student->removeSkill($skillDelete);
        }

        return new Response('test');


//
////        On associe chaque variable aux données envoyées par le form
//        function missingInput($input){
//            new JsonResponse("Le champ ".$input." est manquant");
//        }
//
//        $firstname = (isset($data->firstname)) ? $data->firstname : missingInput('firstname');
//        $lastname = (isset($data->lastname)) ? $data->lastname : missingInput('lastname');;
//        $gender = (isset($data->gender)) ? $data->gender : missingInput('gender');;
//        $birthDate = (isset($data->birthDate)) ? $data->birthDate : missingInput('birthDate');;
//        $address = (isset($data->address)) ? $data->address : missingInput('address');;
//        $phone = (isset($data->phone)) ? $data->phone : missingInput('phone');;
//        $email = (isset($data->email)) ? $data->email : missingInput('email');;
//        $emergencyContact = (isset($data->emergencyContact)) ? $data->emergencyContact : null;
//        $github = (isset($data->github)) ? $data->github : null;
//        $linkedIn = (isset($data->linkedin)) ? $data->linkedin : null;
//        $personalProject = (isset($data->personalProject)) ? $data->personalProject : null;
//        $photo = (isset($data->photo)) ? $data->photo : null;
////        $newSkills = (isset($data->skills)) ? $data->skills : null;
//
////      On modifie l'eleve avec les données fournies
//        $student->setFirstname($firstname);
//        $student->setLastname($lastname);
//        $student->setGender($gender);
//        $student->setBirthDate(new \DateTime($birthDate));
//        $student->setAddress($address);
//        $student->setPhone($phone);
//        $student->setEmail($email);
//        $student->setEmergencyContact($emergencyContact);
//        $student->setGithub($github);
//        $student->setLinkedIn($linkedIn);
//        $student->setPersonalProject($personalProject);
//        $student->setPhoto($photo);
//
//
////        foreach ($newSkills as $skillStudent){
////            $skill = $em->getRepository('AppBundle:Skill')->findOneBy(array('id' => $skillStudent));
////            $student->addSkill($skill);
////        }
//        $em->flush();
//
//        //        Une fois effacement terminé, on verifie si $studentDelete existe encore ou pas dans l'em
//        return ($student) ? new JsonResponse(array('response' => "student update")) : new JsonResponse(array('response' => "student delete"));

    }
}