<?php

namespace App\Controller;
use App\Repository\AccountRepository;
use App\Repository\WalletRepository;
use App\Repository\UserRepository;
use App\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Account;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccountsController extends AbstractController
{
    
    #[Route('/accounts', name: 'app_accounts')]
    public function index(UserRepository $userRepository,AccountRepository $accountRepository, WalletRepository $walletRepository): Response
    {
        // Fetch the logged-in user
        $userid=2;
       // $user = $userRepository->find(2);
        
        // Fetch the idWallet of the logged-in user
        $idWallet = $walletRepository->getIdWalletByUserID($userid);

        


        // Fetch the accounts associated with the retrieved idWallet
        $accounts = $accountRepository->findAccountsByWalletId($idWallet);

        return $this->render('accounts/index.html.twig', [
            'controller_name' => 'AccountsController',
            'accounts' => $accounts,
        ]);
    }


    #[Route('/accounts/add', name: 'account_add')]
    public function addAccount( WalletRepository $walletRepository,Request $request): Response
    {    
          // Fetch the logged-in user
          $userid=2;
        
          // Fetch the idWallet of the logged-in user
          $wallet = $walletRepository->getWalletByUserId($userid);
          $account = new Account(); 
          $account->setIdWallet($wallet);
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();
    
            $this->addFlash('success', 'Account added successfully!');
    
            return $this->redirectToRoute('app_accounts');
        }
    
        return $this->render('accounts/add-account.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
