<?php

namespace App\Controller;
use App\Repository\AccountRepository;
use App\Repository\WalletRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Account;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\TransactionService;
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
    public function manage(UserRepository $userRepository,AccountRepository $accountRepository, WalletRepository $walletRepository): Response
    {
         // Fetch the logged-in user
         $userid=2;
         // $user = $userRepository->find(2);
          
          // Fetch the idWallet of the logged-in user
          $idWallet = $walletRepository->getIdWalletByUserID($userid);
  
          
          $defaultBankName = '';
  
          // Fetch the accounts associated with the retrieved idWallet
          $accounts = $accountRepository->findAccountsByWalletId($idWallet);
        
        return $this->render('accounts/account-manager.html.twig', [
            'accounts' => $accounts,
            'wallet' => $idWallet
        ]);
    }



    #[Route('/accounts/delete/{id}', name: 'delete_account')]
    public function deleteAccount(int $id, AccountRepository $accountRepository, WalletRepository $walletRepository, EntityManagerInterface $entityManager): Response
    {
        $account = $accountRepository->find($id);
    
        if (!$account) {
            throw $this->createNotFoundException('Account not found');
        }
    
        // Retrieve the associated wallet
        $wallet = $account->getIdWallet();
    
        // Subtract the account balance from the wallet total balance
        $wallet->setTotalbalance($wallet->getTotalbalance() - $account->getBalance());
    
        // Retrieve related transactions (both from and to account)
        $transactions = $entityManager->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->where('t.fromaccount = :idaccount OR t.toaccount = :idaccount')
            ->setParameter('idaccount', $id)
            ->getQuery()
            ->getResult();
    
        // Delete the related transactions
        foreach ($transactions as $transaction) {
            $entityManager->remove($transaction);
        }
    
        // Flush the changes to delete the transactions
        $entityManager->flush();
    
        // Now, delete the account
        $entityManager->remove($account);
        $entityManager->flush();
    
        $this->addFlash('success', 'Account and related transactions deleted successfully!');
    
        return $this->redirectToRoute('account_manager');
    }


    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    #[Route('/accounts/get-transactions/{accountId}', name: 'get_transactions')]
    public function getTransactions(int $accountId): JsonResponse
    {
        $transactions = $this->transactionService->getTransactionsByAccountId($accountId);

        $serializedTransactions = [];
        foreach ($transactions as $transaction) {
            $serializedTransactions[] = [
                'category' => $transaction->getIdCategory()->getName(),
                'date' => $transaction->getDate()->format('Y-m-d'),
                'description' => $transaction->getDescription(),
                'type' => $transaction->getType(),
                'amount' => $transaction->getAmount(),
                'currency_symbol' => $transaction->getToAccount()->getIdWallet()->getCurrencySymbol(),
            ];
        }

        return new JsonResponse($serializedTransactions);
    }



}
