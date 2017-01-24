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
     * @Route("/student/update/{id}", name="updateStudent", defaults = {"id" = null})
     */
    public function editStudentAction(Request $request)
    {

        //        Récupération du Json envoyé par le formulaire, decode pour pouvoir le lire
        $dataForm = file_get_contents("php://input");
        $data = json_decode($dataForm);

        //        On récupère le GET envoyé dans l'url
        $id = $request->get('id');

        //        On récupère l'Entity manager
        $em = $this->getDoctrine()->getManager();

        //        On récupère le repository Student
        $student = $em->getRepository('AppBundle:Student')->findOneBy(array('id' => $id));

        //        On récupère les skills associés à l'étudiant
        $infoSkill = $student->getSkills();

//        //        On supprime toutes les compétences de l'eleve
//        foreach ($infoSkill as $skillDelete) {
//            $student->removeSkill($skillDelete);
//        }

        //        On définit les variables avec ce que l'on récupère du JSON'
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $gender = $data->gender;
        $birthDate = $data->birthDate;
        $address = $data->address;
        $phone = $data->phone;
        $email = $data->email;
        $emergencyContact = $data->emergencyContact;
        $github = $data->github;
        $linkedIn = $data->linkedin;
        $personalProject = $data->personalProject;
        $photo = $data->photo;
        $newSkills = $data->skills;

        //        SI les données existent et sont differentes de null, on modifie l'eleve dans la DB, sinon on ne fait rien
        if (isset($firstname) && ($firstname) != null)
            $student->setFirstname($firstname);

        if (isset($lastname) && ($lastname) != null)
            $student->setLastname($lastname);

        if (isset($gender) && ($gender) != null)
            $student->setgender($gender);

        if (isset($birthDate) && ($data->birthDate) != null)
            $student->setbirthDate(new \DateTime($birthDate));

        if (isset($address) && ($address) != null)
            $student->setaddress($address);

        if (isset($phone) && ($phone) != null)
            $student->setphone($data->phone);

        if (isset($email) && ($email) != null)
            $student->setemail($email);

        if (isset($emergencyContact) && ($emergencyContact) != null)
            $student->setemergencyContact($emergencyContact);

        if (isset($github) && ($github) != null)
            $student->setgithub($github);

        if (isset($linkedIn) && ($linkedIn) != null)
            $student->setlinkedin($linkedIn);

        if (isset($personalProject) && ($personalProject) != null)
            $student->setpersonalProject($personalProject);

        if (isset($photo) && ($photo) != null)
            $student->setphoto($photo);

//        //        Pour chaque id de competence récupéré, on va chercher la compétence dans la table skill et on l'ajoute à l'eleve
//        foreach ($newSkills as $skillStudent) {
//            $skill = $em->getRepository('AppBundle:Skill')->findOneBy(array('id' => $skillStudent));
//            $student->addSkill($skill);
//        }

        //        On met a jour dans la DB
        $em->flush();

        //        Une fois effacement terminé, on verifie si $studentDelete existe encore ou pas dans l'em
        return ($student) ? new JsonResponse(array('response' => "student update")) : new JsonResponse(array('response' => "student dead"));

    }
}
