<?php
namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\user;
use AppBundle\Entity\Skill;
use AppBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class TestController extends Controller
{
    /**
     * @Route("testForm/{param}", name="testForm")
     */
    public function testForm (Request $request){
        $form = $this->createFormBuilder()
//            $form->handleRequest($request)

            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('gender', TextType::class)
            ->add('birthDate', DateType::class)
            ->add('address', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', TextType::class)
            ->add('emergencyContact', TextType::class, ['required' => false])
            ->add('github', TextType::class, ['required' => false])
            ->add('linkedIn', TextType::class, ['required' => false])
            ->add('personalProject', TextType::class, ['required' => false])
            ->add('photo', TextType::class, ['required' => false])
            ->add('valider', SubmitType::class)
            ->getForm()
        ;

    return $this ->render('default/test.html.twig', [
        'name'=>$request->get('param'),
        'formTest'=>$form->createView(),
        'test'=>$request->request->all()

        ]);
}


}