function selectAccount(accountId, accountName, currencySymbol, balance) {
    // Update the name of the selected account in the h3 element
    document.getElementById('accountName').innerHTML = `<h3>${accountName}</h3>`;
    document.getElementById('bankNamePlaceholder').innerText = `Total Balance of ${accountName}`;
    // Update the account balance with currency symbol
    document.getElementById('accountBalance').innerHTML = `<h3>${currencySymbol} ${balance}</h3>`;

    
    // Make an AJAX request to fetch additional data for the selected account
    // You can use JavaScript fetch API or any other library like Axios
    
    // For example:




        fetch('/get-transactions/' + accountId)
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

function updateTransactionTable(transactions) {
    const transactionTableBody = document.querySelector('.transaction-table tbody');
    transactionTableBody.innerHTML = ''; // Clear existing table rows

    transactions.forEach(transaction => {
        const row = `
            <tr>
                <td>${transaction.category}</td>
                <td>${transaction.date}</td>
                <td>${transaction.description}</td>
                <td>${transaction.type}</td>
                <td>${transaction.amount}</td>
            </tr>
        `;
        transactionTableBody.insertAdjacentHTML('beforeend', row);
    });
}