document.addEventListener('DOMContentLoaded', function () {
    fetchItemsData().then(items => {
        setupEventListeners();
        generateItemElements(items);
    }).catch(error => {
        console.error('Error fetching items:', error);
    });
});

async function fetchItemsData() {
    const response = await fetch('getItems.php'); // Adjust path as necessary
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return await response.json();
}

function setupEventListeners() {
    const basketButton = document.getElementById('basket-button');
    const closeButton = document.getElementById('close-button');
    const form = document.getElementById('checkout-form');

    basketButton.addEventListener('click', toggleBasket);
    closeButton.addEventListener('click', toggleBasket);

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            submitForm();
        });
    }
}

function generateItemElements(items) {
    const itemGrid = document.getElementById('item-grid');
    itemGrid.innerHTML = ''; // Clear existing items

    items.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('item');
        if (!item.instock) {
            itemElement.classList.add('out-of-stock');
        }

        const stockAmountHTML = item.showstockamount ? `<p class="stock-amount" style="color: red;">Only ${item.stockamount} Left in Stock!</p>` : '';
        const instockHTML = item.instock ? `<input type="number" min="0" max="${item.limit}" value="0" class="quantity-input" data-item-name="${item.name}">` : '<p>Out of Stock</p>';

        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <h2>${item.name}</h2>
            <p class="price">Price: ${item.price} ${item.currency}</p>
            ${instockHTML}
            ${stockAmountHTML}
        `;

        itemGrid.appendChild(itemElement);
    });

    // Now that items are generated, set up the basket update listeners
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', () => updateBasket(items));
    });

    // Initial basket update with fetched items
    updateBasket(items);
}

function toggleBasket() {
    const basket = document.getElementById('basket');
    const overlay = document.querySelector('.overlay');

    basket.style.display = basket.style.display === 'block' ? 'none' : 'block';
    overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function updateBasket(items) {
    const basketItemsElement = document.getElementById('basket-items');
    const basketTotalElement = document.getElementById('basket-total');
    let totalPrice = 0;
    let itemDetails = []; // Array to store details of items for the itemsField

    basketItemsElement.innerHTML = ''; // Clear existing basket items

    document.querySelectorAll('.quantity-input').forEach(input => {
        const itemName = input.dataset.itemName;
        const item = items.find(item => item.name === itemName);
        const quantity = parseInt(input.value, 10) || 0;

        if (quantity > 0) {
            const listItem = document.createElement('li');
            listItem.textContent = `${item.name} x ${quantity}`;
            basketItemsElement.appendChild(listItem);

            totalPrice += item.price * quantity;
            itemDetails.push(`${item.name} (${quantity})`); // Add item detail for itemsField
        }
    });

    basketTotalElement.textContent = `Total Price: ${totalPrice} Diamonds`;

    // Update the priceToPayInput and itemsField to reflect changes
    const priceToPayInput = document.getElementById('price-to-pay');
    const itemsField = document.getElementById('basket-items-field');

    if (priceToPayInput) {
        //priceToPayInput.value = totalPrice; // Assuming you want to display the total price
        priceToPayInput.value = `${totalPrice} Diamonds`;
    }

    if (itemsField) {
        itemsField.value = itemDetails.join(', '); // Comma-separated list of items and their quantities
    }
}

function submitForm() {
    var minecraftUsername = document.getElementById('minecraft-username').value;
    var discordUsername = document.getElementById('discord-username').value;
    var itemCoordsLocation = document.getElementById('item-coords-location').value;
    var itemPlanetLocation = document.getElementById('item-planet-location').value;
    var priceToPay = document.getElementById('price-to-pay').value;
    var additionalInformation = document.getElementById('additional-information').value;
    var itemsField = document.getElementById('basket-items').textContent;

    var payload = {
        content: `-----\nNew Purchase!\nMinecraft Username: ${minecraftUsername}\nDiscord Username: ${discordUsername}\nCoords: ${itemCoordsLocation}\nPlanet: ${itemPlanetLocation}\nPrice: ${priceToPay} Diamonds\nItems: ${itemsField}\nAdditional Information: ${additionalInformation}`
    };

    var webhookUrl = 'https://discord.com/api/webhooks/1117130766413996103/WU74ngWkKCejLJDO5VciiYzjAS8QXxUTeONukPl-K53Ed5X8U6Zsbu7nvkBtqKOOPFu0'; // Add discord webhook link here
    var request = new XMLHttpRequest();
    request.open('POST', webhookUrl);
    request.setRequestHeader('Content-type', 'application/json');
    request.send(JSON.stringify(payload));

    alert('Purchase Successful!');
}