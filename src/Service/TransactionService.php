<?php

namespace App\Service;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;

class TransactionService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTransactionsByAccountId(int $accountId): array
    {
        $repository = $this->entityManager->getRepository(Transaction::class);
        return $repository->createQueryBuilder('t')
            ->where('t.fromaccount = :accountId OR t.toaccount = :accountId')
            ->setParameter('accountId', $accountId)
            ->getQuery()
            ->getResult();
    }

    
    public function getAllTransactionsByWalletId(int $walletId): array
    {
        $transactions = $this->entityManager
            ->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->join('t.fromaccount', 'fromAccount')
            ->join('t.toaccount', 'toAccount')
            ->where('fromAccount.idwallet = :walletId OR toAccount.idwallet = :walletId')
            ->setParameter('walletId', $walletId)
            ->getQuery()
            ->getResult();

        return $transactions;
    }


}
