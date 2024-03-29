function selectAccount(accountId, accountName, currencySymbol, balance) {
    // Update the name of the selected account in the h3 element
    document.getElementById('accountName').innerHTML = `<h3>${accountName}</h3>`;
    document.getElementById('bankNamePlaceholder').innerText = `Total Balance of ${accountName}`;
    // Update the account balance with currency symbol
    document.getElementById('accountBalance').innerHTML = `<h3>${currencySymbol} ${balance}</h3>`;

    
    // Make an AJAX request to fetch additional data for the selected account
    // You can use JavaScript fetch API or any other library like Axios
    
    // For example:
    fetch('/get-account-details/' + accountId)
        .then(response => response.json())
        .then(data => {
            // Do something with the data, such as updating other elements on the page
            console.log(data);
        })
        .catch(error => console.error('Error:', error));
}

