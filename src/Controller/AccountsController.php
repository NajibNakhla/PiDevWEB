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

        
        $defaultBankName = '';

        // Fetch the accounts associated with the retrieved idWallet
        $accounts = $accountRepository->findAccountsByWalletId($idWallet);

        return $this->render('accounts/index.html.twig', [
            'controller_name' => 'AccountsController',
            'accounts' => $accounts,
            'wallet' => $idWallet,
            'defaultBankName' => $defaultBankName,

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
            $newAccountBalance = $account->getBalance();
            $currentTotalBalance = $wallet->getTotalBalance();
            $newTotalBalance = $currentTotalBalance + $newAccountBalance;
            $wallet->setTotalBalance($newTotalBalance);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();
    
            $this->addFlash('success', 'Account added successfully!');
    
            return $this->redirectToRoute('account_added_success');
        }
    
        return $this->render('accounts/add-account.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/accounts/added-success', name: 'account_added_success')]
    public function accountAddedSuccess(): Response
    {
        return $this->render('accounts/account-added-succ.html.twig');
    }


    #[Route('/accounts/manage', name: 'account_manager')]
    public function manage(): Response
    {
        // Add your logic here to fetch and manage accounts
        
        return $this->render('accounts/account-manager.html.twig', [
            // Pass any necessary data to the template
        ]);
    }

}
