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
    'Groceries': 'bg-cyan-500 fi fi-br-basket-shopping-simple',

 
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
                    <td>
                    <div class="account-actions">
                      <a href="#" onclick="showDeleteConfirmationModal(${transaction.idtransaction})">
                        <span>
                         <i class="fi fi-rr-trash delete-button"></i>
                        </span>
                      </a>



                    </div>
                </td>
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
    function showDeleteConfirmationModal(transactionId) {
        // Set the delete URL with the transaction ID and route path
        const deleteUrl = `/transaction/delete/${transactionId}`;
    
        // Set the delete URL as a data attribute on the confirmation button
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.setAttribute('data-delete-url', deleteUrl);
    
            // Show the delete confirmation modal
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        } else {
            console.error('Confirm delete button not found.');
        }
    }
    
    function deleteTransaction() {
        // Get the delete URL from the confirmation button's data attribute
        const deleteUrl = document.getElementById('confirmDeleteBtn').getAttribute('data-delete-url');
        if (deleteUrl) {
            // Redirect to the delete URL
            window.location.href = deleteUrl;
        } else {
            console.error('Delete URL not found.');
        }
    }
    
    // Call showDeleteConfirmationModal when the delete button is clicked
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        const deleteUrl = this.getAttribute('data-delete-url');
        deleteTransaction(deleteUrl);
    });
    

    //payees scripts
    function loadPayees() {
        // Make an AJAX request to fetch the payees content
        fetch('/payee')
            .then(response => response.text())
            .then(html => {
                // Update the modal body with the fetched payees content
                document.getElementById('payeeModalBody').innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching payees:', error);
            });
    }

    // Call the loadPayees function when the modal is shown
    $('#payeeModal').on('show.bs.modal', function (event) {
        loadPayees();
    });

   
    function addPayee() {
        // Get the payee name from the input field
        const payeeName = document.getElementById('payeeName').value;
    
        if (!payeeName) {
            document.getElementById('warningMessage').textContent = 'Payee name cannot be empty';
            return;
        }
    
        // Send an AJAX request to add the payee
        fetch('/payee/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ payeeName: payeeName }),
        })
        .then(response => {
            if (response.ok) {
                loadPayees();
            } else if (response.status === 400) {
                // Handle bad request (payee name already exists)
                response.text().then(errorMessage => {
                    document.getElementById('warningMessage').textContent = errorMessage;
                });
            } else {
                console.error('Failed to add payee');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    
    

    function deletePayee(payeeId) {
        // Send an AJAX request to delete the payee
        fetch(`/payee/delete/${payeeId}`, {
            method: 'DELETE',
        })
        .then(response => {
            if (response.ok) {
                // Reload the payees modal content to update the list
                loadPayees();
            } else {
                console.error('Failed to delete payee');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    // Event listener for delete buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-payee')) {
            const payeeId = event.target.dataset.payeeId;
            if (confirm('Are you sure you want to delete this payee?')) {
                deletePayee(payeeId);
            }
        }
    });
    
    


    