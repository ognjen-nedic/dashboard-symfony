<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Entity\Task;
use App\Form\DeveloperType;
use App\Form\TaskType;
use App\Repository\ClientRepository;
use App\Repository\DeveloperRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

//Only users from Developer class can access these routes.
// Credentials for developer example: lizard.king@universal.com | lawoman

#[Route('developer/')]
class DeveloperController extends AbstractController {
    private $security;
    private $developer_repository;
    private $task_repository;
    private $client_repository;

    public function __construct(Security $security, DeveloperRepository $developer_repository, TaskRepository $task_repository, ClientRepository $client_repository) {
        $this->security = $security;
        $this->developer_repository = $developer_repository;
        $this->task_repository = $task_repository;
        $this->client_repository = $client_repository;
    }

    #[Route('my_profile/', name: 'developer_personal_profile')]
    public function developer_profile(Request $request, UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger): Response {
        $currentDeveloper  = $this->security->getUser();
        $clients = $this->client_repository->findAll();
        $tasks = $currentDeveloper->getTasks();
        
        if($request->request->get('filter_by_month_and_client')) {
            $tasks = $this->task_repository->filter_by_month_and_client(
                $request->request->get('month'),
                $this->client_repository->find($request->request->get('client')),
                $currentDeveloper
            );
        }

        $task = new Task;
        $newTaskForm = $this->createForm(TaskType::class, $task);

        $newTaskForm->handleRequest($request);

        if ($newTaskForm->isSubmitted() && $newTaskForm->isValid()) {
            $task = $newTaskForm->getData();
            $task->setDeveloper($currentDeveloper);
            $this->task_repository->add($task);
            return $this->redirectToRoute('developer_personal_profile');
        }

        $editDeveloperForm = $this->createForm(DeveloperType::class, $currentDeveloper);
        $editDeveloperForm->handleRequest($request);

        if ($editDeveloperForm->isSubmitted() && $editDeveloperForm->isValid()) {
            $currentDeveloper = $editDeveloperForm->getData();
            
            // Password Handle
            $plainPassword = $editDeveloperForm->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $currentDeveloper,
                $plainPassword
            );
            $currentDeveloper->setPassword($hashedPassword);

            // Avatar picture handling
            $avatarFile = $editDeveloperForm->get('avatar')->getData();
            if($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                try {
                    $avatarFile->move($this->getParameter('clients_avatar_directory'), $newFilename);
                } catch(FileException $e) {
                    // I don't know...
                }

                $currentDeveloper->setAvatarPath('developers/'.$newFilename);
            }

            
            $this->developer_repository->add($currentDeveloper);
            return $this->redirectToRoute('developer_personal_profile');
        }

        return $this->render('developer/developer_profile.html.twig', ['tasks' => $tasks,
         'clients' => $clients,
         'newTaskForm' => $newTaskForm->createView(),
         'editDeveloperForm' => $editDeveloperForm->createView()]);
    }

    #[Route('task/{id<\d+>}', name: 'developer_task_details')]
    public function admin_task_details($id, Request $request) {
        $currentDeveloper  = $this->security->getUser();
        $task = $this->task_repository->find($id);
        $editForm = $this->createForm(TaskType::class, $task);

        $editForm->handleRequest($request);

        if ( $editForm->isSubmitted() &&  $editForm->isValid()) {
            $task =  $editForm->getData();
            $task->setDeveloper($currentDeveloper);
            $this->task_repository->add($task);
            return $this->redirectToRoute('developer_personal_profile');
        }

        return $this->render('task_details.html.twig', ['task' => $task, 'editForm' => $editForm->createView()]);
    }

    #[Route('task/{id<\d+>}/delete', name: 'developer_task_delete')]
    public function admin_task_delete($id) {
        $task = $this->task_repository->find($id);
        $this->task_repository->remove($task);

        return $this->redirectToRoute('developer_personal_profile');
    }
}
