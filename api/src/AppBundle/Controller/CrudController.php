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


class CrudController extends Controller
{
    /**
     * @Route("/student/add", name="addStudent")
     * Création d'un Student
     */
    public function addStudentAction(Request $request)
    {
        //        Récupération du Json envoyé par le formulaire, decode pour pouvoir le lire
        $dataForm = file_get_contents("php://input");
        $data = json_decode($dataForm);

        //        On récupère l'Entity manager
        $em = $this->getDoctrine()->getManager();

        //        On associe chaque variable aux données envoyées par le form
        function missingInput($input)
        {
            new JsonResponse("Le champ " . $input . " est manquant");
        }

        $firstname = (isset($data->firstname)) ? $data->firstname : missingInput('firstname');
        $lastname = (isset($data->lastname)) ? $data->lastname : missingInput('lastname');;
        $gender = (isset($data->gender)) ? $data->gender : missingInput('gender');;
        $birthDate = (isset($data->birthDate)) ? $data->birthDate : missingInput('birthDate');;
        $address = (isset($data->address)) ? $data->address : missingInput('address');;
        $phone = (isset($data->phone)) ? $data->phone : missingInput('phone');;
        $email = (isset($data->email)) ? $data->email : missingInput('email');;
        $emergencyContact = (isset($data->emergencyContact)) ? $data->emergencyContact : null;
        $github = (isset($data->github)) ? $data->github : null;
        $linkedIn = (isset($data->linkedin)) ? $data->linkedin : null;
        $personalProject = (isset($data->personalProject)) ? $data->personalProject : null;
        $photo = (isset($data->photo)) ? $data->photo : null;
        $newSkills = (isset($data->skills)) ? $data->skills : null;

        //      On cree un nouvel eleve
        $student = new Student();
        $student->setFirstname($firstname);
        $student->setLastname($lastname);
        $student->setGender($gender);
        $student->setBirthDate(new \DateTime($birthDate));
        $student->setAddress($address);
        $student->setPhone($phone);
        $student->setEmail($email);
        $student->setEmergencyContact($emergencyContact);
        $student->setGithub($github);
        $student->setLinkedIn($linkedIn);
        $student->setPersonalProject($personalProject);
        $student->setPhoto($photo);

        //        Pour chaque id de competence récupéré, on va chercher la compétence dans la table skill et on l'ajoute à l'eleve
        foreach ($newSkills as $skillStudent) {
            $skill = $em->getRepository('AppBundle:Skill')->findOneBy(array('id' => $skillStudent));
            $student->addSkill($skill);
        }

        //        On ajoute à la DB
        $em->persist($student);
        $em->flush();

        //        Une fois l'ajout effectué on renvoie si c'est ok ou pas
        return $student ? new JsonResponse(array("Response" => "true")) : new JsonResponse(array("Response" => "false"));
    }

    /**
     * @Route("/student/delete/{id}" , name="deleteStudent")
     * Suppression d'un student
     */
    public function delStudentAction(Request $request)
    {
        //        On recupère l'id
        $id = $request->get('id');

        //        On crée l'entity manager
        $em = $this->getDoctrine()->getManager();

        //        On récupère l'éleve correspondant à l'id
        $studentDelete = $em->getRepository('AppBundle:Student')->findOneBy(array('id' => $id));

        //        On efface la ligne correspondant à l'id
        $em->remove($studentDelete);
        $em->flush();

        //        Une fois effacement terminé, on verifie si $studentDelete existe encore ou pas dans l'em
        return ($em->contains($studentDelete)) ? new JsonResponse(array('response' => "student not delete")) : new JsonResponse(array('response' => "student delete"));
    }
}