<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{

    #[Route('/{id}', name: 'app_user_action', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        //  methode pour supprimer un utilisateur           
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        } else if ($this->isCsrfTokenValid('admin' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $user->addRole('ROLE_ADMIN');
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }

}