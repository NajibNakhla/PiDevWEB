let selectedAccountId; 

function selectAccount(accountId, accountName, currencySymbol, balance) {
   
    document.getElementById('accountName').innerHTML = `<h3>${accountName}</h3>`;
    document.getElementById('bankNamePlaceholder').innerText = `Total Balance of ${accountName}`;
 
    document.getElementById('accountBalance').innerHTML = `<h3>${currencySymbol} ${balance}</h3>`;
    
 



    fetch('/accounts/get-transactions/' + accountId)
        .then(response => response.json())
        .then(transactions => {
            // Update the transaction table with fetched transactions
            updateTransactionTable(transactions);
        })
        .catch(error => console.error('Error fetching transactions:', error));
}


function confirmDelete(accountId) {
    if (confirm("Are you sure you want to delete this account?")) {
        // If user confirms deletion, redirect to the delete account route
        window.location.href = '/account/delete/' + accountId;
    } else {
        // If user cancels deletion, do nothing
        return false;
    }
}

const categoryIcons = {
    'Beauty': 'bg-teal-500 fi fi-rr-barber-shop',
    'Budget': 'bg-emerald-500 fi fi-rr-bank',
    'Food': 'bg-teal-500 fi fi-rr-canned-food',
    'Bills & Fees': 'bg-blue-500 fi fi-rr-receipt',
    'Car': 'bg-cyan-500 fi fi-rr-car-side',
    'Entertainment': 'bg-cyan-500 fi fi-rr-car-side',

 
};

const defaultIcon = 'fi fi-rr-question';

function updateTransactionTable(transactions) {
    const transactionTableBody = document.querySelector('.transaction-table tbody');
    transactionTableBody.innerHTML = ''; 

    transactions.forEach(transaction => {

        const iconClass = categoryIcons[transaction.category] || defaultIcon;
        const row = `
            <tr>
            <td>
               <span class="table-category-icon">
                 <i class="${iconClass}"></i>
                 ${transaction.category}
               </span>
            </td>
                <td>${transaction.date}</td>
                <td>${transaction.description}</td>
                <td>${transaction.type}</td>
                <td>  ${transaction.currency_symbol}  ${transaction.amount}</td>        
            </tr>
        `;
        transactionTableBody.insertAdjacentHTML('beforeend', row);
    });



}





//transactions page : 
function fetchTransactions() {



    // Get the selected account ID or 'all' value
    const accountId = document.getElementById('selectedAccount').value;

    console.log(accountId);
    selectedAccountId = accountId; 

    let url;
    if (accountId === 'all') {
        // If 'All Accounts' option is selected, fetch all transactions
        url = '/get-transactions/all';
    } else {
        // If an account ID is selected, fetch transactions for that account
        url = `/get-transactions/account/${accountId}`;
    }
    
    // Make an AJAX request to fetch transactions
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Call a function to update the transaction table with the fetched data
            updateTransactionTable2(data);
            updateDefaultAccountNamePlace(accountId);
        })
        .catch(error => console.error('Error:', error));
}

function updateDefaultAccountNamePlace(accountId) {
    // Make an AJAX request to fetch account details
    fetch(`/get-account-details/${accountId}`)
        .then(response => response.json())
        .then(account => {
            // Update the default account name place with the fetched account name
            const defaultAccountNamePlace = document.getElementById('defaultAccountNamePlace');
            defaultAccountNamePlace.innerHTML = `Balance: ${account.nameaccount} <h4 class="text-success">${account.currency_symbol} ${account.balance}</h4>`;
        })
        .catch(error => console.error('Error fetching account details:', error));
}







    // Function to update transaction history table with fetched data
    function updateTransactionTable2(transactions) {
        const transactionTableBody = document.querySelector('.transaction-table tbody');
      transactionTableBody.innerHTML = ''; 
 

        // Populate table with fetched data
        transactions.forEach(transaction => {
            const iconClass = categoryIcons[transaction.category] || defaultIcon;
            const row = `
                <tr>
                <td>
                <span class="table-category-icon">
                  <i class="${iconClass}"></i>
                  ${transaction.category}
                </span>
             </td>
                    <td>${transaction.date}</td>
                    <td>${transaction.type}</td>
                    <td>${transaction.description}</td>
                    <td>  ${transaction.currency_symbol}  ${transaction.amount}</td> 
                    <td>${transaction.fromaccount}</td>
                    <td>${transaction.toaccount}</td>
                    <td>${transaction.payee}</td>
                </tr>
            `;
            transactionTableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    //transaction modal 
    function showIncomeForm(selectedAccountId) {
        // Logic to show the income transaction form
        const url = `/transaction/add/income/${selectedAccountId}`;
    
        // Redirect the user to the add income form page
        window.location.href = url;
    }
    
    
    
    
    
    function showExpenseForm(selectedAccountId) {
        const url = `/transaction/add/expense/${selectedAccountId}`;
    
        // Redirect the user to the add income form page
        window.location.href = url;
    }
    
    function showTransferForm(selectedAccountId) {
        const url = `/transaction/add/transfer/${selectedAccountId}`;
    
        // Redirect the user to the add income form page
        window.location.href = url;
    }

    function openTransactionModal() {
      
        console.log('Selected Account ID:', selectedAccountId);
        
        // Set the account ID as a parameter when opening the modal
        const modal = new bootstrap.Modal(document.getElementById('transactionTypeModal'));
        modal.show();
        // Add the account ID as a data attribute to the modal
        document.getElementById('transactionTypeModal').setAttribute('data-account-id', selectedAccountId);
    
       
            showIncomeForm(selectedAccountId);
        
    
        
        showExpenseForm(selectedAccountId);
        
    
      
        showTransferForm(selectedAccountId);
        
    }


