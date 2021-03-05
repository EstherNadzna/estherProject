<?php

namespace App\Controller;

use App\Entity\AccountUser;
use App\Form\AccountUserType;
use App\Form\RoleUserType;
use App\Repository\AccountUserRepository;
use App\Repository\RoleUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account/user")
 */
class AccountUserController extends AbstractController
{
    /**
     * @Route("/index", name="account_user_index", methods={"GET"})
     */
    public function index(AccountUserRepository $accountUserRepository): Response
    {
        return $this->render('account_user/index.html.twig', [
            'account_users' => $accountUserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="account_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accountUser = new AccountUser();
        $form = $this->createForm(AccountUserType::class, $accountUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accountUser);
            $entityManager->flush();

            return $this->redirectToRoute('account_user_index');
        }

        return $this->render('account_user/new.html.twig', [
            'account_user' => $accountUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="account_user_show", methods={"GET"})
     */
    public function show(AccountUser $accountUser): Response
    {
        return $this->render('account_user/show.html.twig', [
            'account_user' => $accountUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="account_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AccountUser $accountUser ,RoleUserRepository $roleUserRepository  ): Response
    {
        $form = $this->createForm(RoleUserType::class, $accountUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idRole = $form->get('roleU')->getData()->getId();
            $role = $roleUserRepository->find($idRole);
            $accountUser->addRole($role);

            $this->em->flush();
            $this->addflash('success','role ajouter');
            return $this->redirectToRoute('account_user_index');
        }

        return $this->render('account_user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="account_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AccountUser $accountUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accountUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accountUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account_user_index');
    }
}
