<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;
use App\Form\UserFormType;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_discuss")
     */
    public function index(UserRepository $userRepo,EntityManagerInterface $em,Request $request,FlashyNotifier $flashy): Response
    {
        $user = $this->getUser();
    	$listeUsers = $userRepo->findAllUser($user->getId());
    	//$text = "Welcome ".$user->getPseudo()." !";
    	//$flashy->info($text, 'http://your-awesome-link.com');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listeUsers' => $listeUsers
        ]);
    }

    /**
     *@Route("/home/{id<[0-9]+>}",name="app_discuss_user")
     */
    public function discussByUser(User $dest, MessageRepository $messRepo):Response
    {
    	$user = $this->getUser();
    	$messages = $messRepo->findAllDiscuss($user->getId(),$dest->getId());

 
    	$datas = [];
    	foreach ($messages as $key => $message) {
    		$datas[$key]['contenu_message'] = $message->getContenu();
    		$datas[$key]['emmeteur'] = $message->getEmmeteur()->getPseudo();
    		$datas[$key]['date'] = $message->getCreatedAt();
    	}

    	return new JsonResponse($datas);
    }

    /**
     *@Route("/home/send",name="app_send")
     */
    public function sendMessage(EntityManagerInterface $em,Request $request,UserRepository $userRepo):Response
    {
    	$data = json_decode($request->getContent(), true);

    	$userDest = $userRepo->findOneBy([
            'id' => $data['recipient']
          ]
    	);
    	//Creation de l'objet Message qui sera enregistre dans la base de donnees
    	$message = new Message();
    	$message->setEmmeteur($this->getUser());
    	$message->setRecepteur($userDest);
    	$message->setContenu($data['message']);

    	//Save to db
    	$em->persist($message);
    	$em->flush();

    	$data['date'] = $message->getCreatedAt();


    	return new JsonResponse($data);

    }

    /**
     *@Route("/home/edit_user",name="app_edit_user")
     */
     public function edit_user(Request $request,EntityManagerInterface $em,FlashyNotifier $flashy):Response
    {
        $user=$this->getUser();
        $form=$this->createForm(UserFormType::class,$user,[]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $flashy->success('Mise a jour effectue avec succes !','Mise a jour effectue avec succes !');


            return $this->redirectToRoute('app_edit_user');
        }

          return $this->render('home/edit_user.html.twig',[
                                'monForm' => $form->createView()
                            ]);
    }

}
