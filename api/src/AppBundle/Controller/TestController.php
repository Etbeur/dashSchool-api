<?php
namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\user;
use AppBundle\Entity\Skill;
use AppBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class TestController extends Controller
{
    /**
     * @Route("/testForm", name="testForm")
     */
    public function testForm (Request $request){
        $form = $this->createFormBuilder()



            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('gender', TextType::class)
            ->add('birthDate', BirthdayType::class)
            ->add('address', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', TextType::class)
            ->add('emergencyContact', TextType::class, ['required' => false])
            ->add('github', TextType::class, ['required' => false])
            ->add('linkedIn', TextType::class, ['required' => false])
            ->add('personalProject', TextType::class, ['required' => false])
            ->add('photo', TextType::class, ['required' => false])
            ->add('php', CheckboxType::class , ['required' => false])
            ->add('html', CheckboxType::class,['required' => false] )
            ->add('javascript', CheckboxType::class,['required' => false] )
            ->add('angular2', CheckboxType::class,['required' => false] )
            ->add('testId', TextType::class)
            ->add('valider', SubmitType::class)

            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            $firstname = $form["firstname"]->getData();
            $lastname = $form["lastname"]->getData();
            $gender = $form["gender"]->getData();
            $birthDate = $form["birthDate"]->getData();
            $address = $form["address"]->getData();
            $phone = $form["phone"]->getData();
            $email = $form["email"]->getData();
            $emergencyContact = $form["emergencyContact"]->getData();
            $github = $form["github"]->getData();
            $linkedIn = $form["linkedIn"]->getData();
            $personalProject = $form["personalProject"]->getData();
            $photo = $form["photo"]->getData();
            $idTest = $form["testId"]->getData();
            //        On récupère l'Entity manager
            $em = $this->getDoctrine()->getManager();
            $skill = $em->getRepository('AppBundle:Skill')->findOneBy(array('id'=>$idTest));


            dump($task);


            //      On cree un nouvel eleve
            $student = new Student();
            $student->setFirstname($firstname);
            $student->setLastname($lastname);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setAddress($address);
            $student->setPhone($phone);
            $student->setEmail($email);
            $student->setEmergencyContact($emergencyContact);
            $student->setGithub($github);
            $student->setLinkedIn($linkedIn);
            $student->setPersonalProject($personalProject);
            $student->setPhoto($photo);
            $student->addSkill($skill);
//            foreach ($newSkills as $skillStudent){
//                $student->addSkill($skillStudent);
//            }



            $em->persist($student);
            $em->flush();
        }
        return $this ->render('default/test.html.twig', [
        'formTest'=>$form->createView(),
        ]);
}

    /**
     * @Route("/testDelete/{id}", name="testDelete")
     */
    public function testDelete (Request $request){

        $id = $request->get('id');
        //        On crée l'entity manager
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->findOneBy(array('id'=>$id));
        //        On efface la ligne correspondant à l'id
        $em->remove($student);
        $em->flush();

        return new Response('ok bobby');


    }




}