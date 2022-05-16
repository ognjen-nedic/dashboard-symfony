<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\DeveloperRepository;
use App\Form\DeveloperType;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

// Only users from Admin class can access these routes.
// Example of Admin entity credentials: ognjen.nedic@universal.com | lawoman
#[Route('admin/')]
class AdminController extends AbstractController {
    // To avoid multiple calls to repositories in route functions as arguments, they are defined in __construct as services
    private $developer_repository;
    private $client_repository;
    private $task_repository;

    public function __construct(
        DeveloperRepository $developer_repository,
        ClientRepository $client_repository,
        TaskRepository $task_repository
    ) {
        $this->developer_repository = $developer_repository;
        $this->client_repository = $client_repository;
        $this->task_repository = $task_repository;
    }

    // Admin can see and edit both developers and clients, as well as his own profile.
    #[Route('developers/', name: 'admin_developers_view')]
    public function admin_developers_view(): Response {
        
        return $this->render('admin/developers_list.html.twig', 
        ['developers' => $this->developer_repository->findAll()]);
    }
    
    #[Route('developers/{id<\d+>}', name: 'admin_developer_details')]
    public function admin_developers_details($id, Request $request, UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger) {
        $developer = $this->developer_repository->find($id);
        $clients = $this->client_repository->findAll();
        $tasks = $developer->getTasks();

        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $developer = $form->getData();

            // Password Handle
            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $developer,
                $plainPassword
            );
            $developer->setPassword($hashedPassword);

            // Avatar picture handling
            $avatarFile = $form->get('avatar')->getData();
            if($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                try {
                    $avatarFile->move($this->getParameter('clients_avatar_directory'), $newFilename);
                } catch(FileException $e) {
                    // I don't know...
                }

                $developer->setAvatarPath('developers/'.$newFilename);
            }
            
            $this->developer_repository->add($developer);
            return $this->redirectToRoute('admin_developers_view');
        }

        if($request->request->get('filter_by_month_and_client')) {
            $tasks = $this->task_repository->filter_by_month_and_client(
                $request->request->get('month'),
                $this->client_repository->find($request->request->get('client')),
                $developer
            );
        }

        if($request->request->get('reset-page')) {
            $tasks = $developer->getTasks();
        }

        return $this->render('admin/developer_details.html.twig',
        ['developer' => $developer,
        'clients' => $clients,
        'tasks' => $tasks,
        'form' => $form->createView()]);
    }

    #[Route('clients', name: 'admin_clients_view')]
    public function admin_clients_view(Request $request, SluggerInterface $slugger): Response {
        $clients = $this->client_repository->findAll();

        $client = new Client();

        $form = $this->createForm(ClientType::class, $client, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Avatar picture handling
            $avatarFile = $form->get('avatar')->getData();
            if($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                try {
                    $avatarFile->move($this->getParameter('clients_avatar_directory'), $newFilename);
                } catch(FileException $e) {
                    // I don't know...
                }

                $client->setAvatarPath('clients/'.$newFilename);
            }

            $client = $form->getData();
            $this->client_repository->add($client, true);
            return $this->redirectToRoute('admin_clients_view');
        }

        if($request->request->get('search_client')) {
            $clients = $this->client_repository->search_client(
                $request->request->get('client_name')
            );
        }

        return $this->render('admin/clients_list.html.twig',
        ['clients' => $clients,
         'form' => $form->createView()]);
    }

    #[Route('clients/{id<\d+>}', name: 'admin_client_details')]
    public function admin_client_details($id, Request $request) {
        $client = $this->client_repository->find($id);
        $developers = $this->developer_repository->findAll();
        $tasks = $client->getTasks();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $this->client_repository->add($client, true);
            return $this->redirectToRoute('admin_clients_view');
        }

        if($request->request->get('filter_by_month_and_developer')) {
            $tasks = $this->task_repository->filter_by_month_and_developer(
                $request->request->get('month'),
                $this->developer_repository->find($request->request->get('developer')),
                $client
            );
        }

        return $this->render('admin/client_details.html.twig',
        ['client' => $client,
        'developers' => $developers,
        'tasks' => $tasks,
        'form' => $form->createView()]);
    }

    // Initially, this was new route - in current version it is just drawer on client list

    /* #[Route('clients/new', name: 'admin_add_client', methods: ['GET', 'POST', 'PUT'])]
    public function admin_add_client(Request $request) {
        $client = new Client();
        
        $form = $this->createForm(ClientType::class, $client, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $client = $form->getData();
            $this->client_repository->add($client, true);
            return $this->redirectToRoute('admin_clients_view');
        }

        return $this->render('admin/client_add.html.twig',
        ['form' => $form->createView()]);
    } */
    
    #[Route('my_profile', name: 'admin_personal_profile')]
    public function admin_personal_profile() {
        return $this->render('admin/admin_profile.html.twig');
    }

    #[Route('task/{id<\d+>}', name: 'admin_task_details')]
    public function admin_task_details($id, Request $request) {
        $task = $this->task_repository->find($id);

        return $this->render('task_details.html.twig', ['task' => $task]);
    }

    #[Route('task/{id<\d+>}/delete', name: 'admin_task_delete')]
    public function admin_task_delete($id) {
        $task = $this->task_repository->find($id);
        $this->task_repository->remove($task);

        return $this->redirectToRoute('admin_clients_view');
    }

}
