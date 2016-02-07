<?php

namespace RMP\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use RMP\UserBundle\Entity\User;
use RMP\UserBundle\Form\UserType;


class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository('RMPUserBundle:User')->findAll();
        
     /*   $res = 'Lista de Usuarios: <br />';
        
        foreach ($users as $user)
        {
            $res .= 'Usuario: ' . $user->getUsername() . ' - Email: ' . $user->getEmail() . '<br />';
        }
        
        return new Response($res);
      * 
      */
        return $this->render('RMPUserBundle:User:index.html.twig', array('users' => $users));
    }

    // Esta función nos valdrá para renderizar nuestro formulario
    public function addAction() 
    {
        // Creamos una instancia del objeto User
        $user = new User();
        //LLamamos a un método llamado 
       // $form = $this->createForm($user);
        $form = $this->createCreateForm($user);
        
       // renderizamos a nuestra vista lo que va a contener el formulario
       // donde: 
       //render() es el método que va a renderizar, y para ello tenemos que colocar:
       //RMPUserBundle -> es el nombre del Bundle
       //User-> el directorio
       //add.html.twig-> acción o vista a la que vamos a renderizar.
       // Después mediante un arreglo vamos a enviar lo que va a tener nuestro formulario, que lo desarrollaremos con el método createView(), el cual contendrá nuestro formulario.
      return $this->render('RMPUserBundle:User:add.html.twig', array('form' => $form->createView()));

    }
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(UserType::class, $entity, array(
                'action' => $this->generateUrl('emm_user_create'),
                'method' => 'POST'
            ));

        return $form;
    } 
    public function createAction(Request $request)
    {
        
        $user = new User();
        //LLamamos a un método llamado 
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        

            return $this->redirectToRoute('emm_user_index');
        }

       return $this->render('RMPUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }
 
    
   /* public function pruebaAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository('RMPUserBundle:User')->findAll();
        
        return $this->render('RMPUserBundle:User:create.html.twig', array('users' => $users));
    }
    */
/*
    public function addAction()
    {
        $user = new User();
        $form = $this->createCreateForm($user);
        
        return $this->render('RMPUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }
    
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
                'action' => $this->generateUrl('emm_user_create'),
                'method' => 'POST'
            ));
        
        return $form;
    }
    
    public function createAction(Request $request)
    {   
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
        
        if($form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('emm_user_index');              
        }
        
        return $this->render('RMPUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }
*/
    public function formularioAction(){
        //Creamos el formulario
        // Creamos una instancia del objeto User
        $user = new User();
        //LLamamos a un método llamado 
        $form = $this->createForm(UserType::class,$user);
        
        // Creamos la vista
        return $this->render('RMPUserBundle:User:form.html.twig', array('form' => $form->createView()));

    }
    
}