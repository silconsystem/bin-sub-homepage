// Array to store selected items
let orderItems = [];
let orderList = document.getElementById('message');
let totalAmount = 0; // Variable to store the total amount
//let orderItems = []; // Array to store order items


async function getExchangeRate() {
  const apiKey = '2900758bfebc8333d8b18359'; // Replace with your API key
  const response = await fetch(`https://v6.exchangerate-api.com/v6/2900758bfebc8333d8b18359/latest/EUR`);
  const data = await response.json();

  console.log(data.conversion_rates.USD);

  return data.conversion_rates.USD;
}

async function convertCurrency(clickedButton) {
  // Find the parent price element of the clicked button
  let priceElement = clickedButton.previousElementSibling;

  console.log(`priceElement: ${priceElement}`);

  // Get the current currency setting from the data attribute
  let currentCurrency = priceElement.getAttribute('data-currency');

  if (currentCurrency === 'euro') {
    // Convert to Dollars
    let euroAmount = parseFloat(priceElement.querySelector('.amount').textContent.replace(',', '.'));
    let exchangeRate = await getExchangeRate();
    let dollarAmount = (euroAmount * exchangeRate).toFixed(2);

    // Update the displayed value with the $ symbol
    priceElement.innerHTML = `<b>$</b><span class="amount">${dollarAmount}</span>`;

    // Update the data attribute to indicate the currency is now in Dollars
    priceElement.setAttribute('data-currency', 'dollar');
    clickedButton.textContent = 'Convert to Euros'; // Change button text
  } else {
    // Convert back to Euros
    let dollarAmount = parseFloat(priceElement.querySelector('.amount').textContent.replace(',', '.'));
    let exchangeRate = await getExchangeRate();
    let euroAmount = (dollarAmount / exchangeRate).toFixed(2);

    // Update the displayed value with the € symbol
    priceElement.innerHTML = `<b>€</b><span class="amount">${euroAmount}</span>`;

    // Update the data attribute to indicate the currency is now in Euros
    priceElement.setAttribute('data-currency', 'euro');
    clickedButton.textContent = 'Convert to Dollars'; // Change button text
  }
}

// Function to add item to the order
function addToOrder(itemName, price) {
  console.log(itemName);
  orderItems.push({ name: itemName, price: parseFloat(price) });
  updateOrderList();
}

// Function to update the order list on the page
function updateOrderList() {
  let orders = [];
  totalAmount = 0; // Reset total amount

  orderItems.forEach((item, index) => {
    let number = index + 1;
    orders.push(`order ${number}: ${item.name} €${item.price.toFixed(2)}\n`);

    // Accumulate the price for the total amount
    totalAmount += item.price;
  });

  const messageText = orders.join('');

  // Update the message field with the ordered items and total amount
  orderList.value = `Ordered items:\n${messageText}\n------ | TOTAL: €${totalAmount.toFixed(2)}`;
}