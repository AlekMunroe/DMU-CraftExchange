var items = [
  { name: 'Nether Star', price: 15, currency: 'Diamonds', image: 'img/items/NetherStar.webp', limit: 1, instock: true, stockamount: 1, showstockamount: true },
  { name: 'Wither Skeleton Skull', price: 6, currency: 'Diamonds', image: 'img/items/WitherSkeletonSkull.webp', limit: 3, instock: true, stockamount: 3, showstockamount: true },
  { name: 'Rail', price: 7, currency: 'Iron', image: 'img/items/Rail.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false},
  { name: '5 Gold Ingots', price: 2, currency: 'Iron', image: 'img/items/GoldIngot.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: 'Redstone Block', price: 1, currency: 'Iron', image: 'img/items/RedstoneBlock.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: 'Lapis Block', price: 3, currency: 'Iron', image: 'img/items/LapisBlock.webp', limit: 25, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Honey', price: 4, currency: 'Iron', image: 'img/items/Honey.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '12 Slime', price: 7, currency: 'Iron', image: 'img/items/Slime.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: '3 Blaze Rod', price: 1, currency: 'Diamonds', image: 'img/items/BlazeRod.webp', limit: 5, instock: true, stockamount: 64, showstockamount: false },
  { name: '2 Crystaline', price: 6, currency: 'Iron', image: 'img/items/Crystaline.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: '5 Magma Cream', price: 10, currency: 'Iron', image: 'img/items/MagmaCream.webp', limit: 5, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Bones', price: 2, currency: 'Iron', image: 'img/items/Bone.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Concrete Powder (White)', price: 15, currency: 'Iron', image: 'img/items/ConcretePowderWhite.webp', limit: 15, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Concrete Powder (Colour)', price: 17, currency: 'Iron', image: 'img/items/ConcretePowderBlue.webp', limit: 15, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Bricks', price: 8, currency: 'Iron', image: 'img/items/Bricks.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Dirt', price: 2, currency: 'Iron', image: 'img/items/Dirt.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Gravel', price: 2, currency: 'Iron', image: 'img/items/Gravel.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Sand', price: 2, currency: 'Iron', image: 'img/items/Sand.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '12 Flint', price: 2, currency: 'Iron', image: 'img/items/Flint.webp', limit: 32, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Cobblestone', price: 5, currency: 'Iron', image: 'img/items/Cobblestone.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Stone', price: 8, currency: 'Iron', image: 'img/items/Stone.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Stone Brick', price: 10, currency: 'Iron', image: 'img/items/StoneBrick.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Granite', price: 1, currency: 'Iron', image: 'img/items/Granite.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Diorite', price: 1, currency: 'Iron', image: 'img/items/Diorite.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Andesite', price: 1, currency: 'Iron', image: 'img/items/Andesite.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: 'Glowstone', price: 10, currency: 'Iron', image: 'img/items/Glowstone.webp', limit: 25, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Arrows', price: 2, currency: 'Iron', image: 'img/items/Arrow.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Dalek Mutant', price: 1, currency: 'Iron', image: 'img/items/DalekMutant.png', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Leather', price: 2, currency: 'Iron', image: 'img/items/Leather.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '20 Rotten Flesh', price: 1, currency: 'Iron', image: 'img/items/RottenFlesh.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Raw Porkchop', price: 3, currency: 'Iron', image: 'img/items/RawPorkchop.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Cooked Porkchop', price: 6, currency: 'Iron', image: 'img/items/CookedPorkchop.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Mutton', price: 5, currency: 'Iron', image: 'img/items/Mutton.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Cooked Mutton', price: 8, currency: 'Iron', image: 'img/items/CookedMutton.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Raw Chicken', price: 3, currency: 'Iron', image: 'img/items/RawChicken.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Cooked Chicken', price: 6, currency: 'Iron', image: 'img/items/CookedChicken.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Raw Beef', price: 3, currency: 'Iron', image: 'img/items/RawBeef.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Cooked Beef', price: 6, currency: 'Iron', image: 'img/items/CookedBeef.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '5 Apples', price: 1, currency: 'Iron', image: 'img/items/Apple.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '10 Sweet Berries', price: 1, currency: 'Iron', image: 'img/items/SweetBerries.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Wheat', price: 2, currency: 'Iron', image: 'img/items/Wheat.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Seeds', price: 3, currency: 'Iron', image: 'img/items/Seeds.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '64 Sugar', price: 2, currency: 'Iron', image: 'img/items/Sugar.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  { name: '32 Sugar Cane', price: 3, currency: 'Iron', image: 'img/items/SugarCane.webp', limit: 64, instock: true, stockamount: 64, showstockamount: false },
  // Add more items here as needed
];

var basketItemsData = {};

function toggleBasket() {
  var basket = document.getElementById('basket');
  var overlay = document.querySelector('.overlay');
  var body = document.querySelector('body');

  if (basket.style.display === 'none') {
    basket.style.display = 'block';
    overlay.style.display = 'block';
    body.classList.add('basket-open');
  } else {
    basket.style.display = 'none';
    overlay.style.display = 'none';
    body.classList.remove('basket-open');
  }
}

function updateBasket() {
  var basketItems = document.getElementById('basket-items');
  var basketTotal = document.getElementById('basket-total');
  var priceToPayInput = document.getElementById('price-to-pay');
  var itemsField = document.getElementById('basket-items-field');

  if (itemsField) {
    basketItems.innerHTML = '';

    var totalPrice = 0;
    var currencyCounts = {};

    items.forEach(function (item) {
      var itemElement = document.getElementById(item.name);
      if (itemElement) {
        var quantity = parseInt(itemElement.value, 10);

        if (quantity > item.limit) {
          itemElement.value = item.limit;
          quantity = item.limit;
        }

        if (quantity > 0) {
          var listItem = document.createElement('li');
          listItem.textContent = item.name + ' (' + quantity + ')';
          basketItems.appendChild(listItem);

          totalPrice += item.price * quantity;

          if (currencyCounts[item.currency]) {
            currencyCounts[item.currency] += item.price * quantity;
          } else {
            currencyCounts[item.currency] = item.price * quantity;
          }
        }

        // Update basket items data
        basketItemsData[item.name] = quantity;
      }
    });

    basketTotal.textContent = 'Total: ' + formatPrice(totalPrice, currencyCounts);
    priceToPayInput.value = formatPrice(totalPrice, currencyCounts);
    itemsField.value = formatBasketItems(basketItemsData);
  }
}

function formatPrice(price, currencyCounts) {
  var formattedPrice = '';
  var currencies = [];

  for (var currency in currencyCounts) {
    var count = currencyCounts[currency];
    currencies.push(count + ' ' + currency);
  }

  if (price !== 0) {
    formattedPrice = 'Total: ' + currencies.join(', ');
  }

  return formattedPrice;
}

function formatBasketItems(basketItemsData) {
  var formattedItems = [];

  for (var itemName in basketItemsData) {
    var quantity = basketItemsData[itemName];
    if (quantity > 0) {
      formattedItems.push(itemName + ' (' + quantity + ')');
    }
  }

  return formattedItems.join(', ');
}

function generateItemElements() {
  var itemGrid = document.getElementById('item-grid');

  items.forEach(function (item) {
    var itemElement = document.createElement('div');
    itemElement.classList.add('item');

    if (!item.instock) {
      itemElement.classList.add('out-of-stock');
    }

    var stockAmountHTML = '';
    if (item.showstockamount && typeof item.stockamount === 'number') {
      stockAmountHTML = `<p class="stock-amount" style="color: red;">Only ${item.stockamount} Left in Stock!</p>
`;
    }

    itemElement.innerHTML = `
      <img src="${item.image}" alt="${item.name}">
      <h2>${item.name}</h2>
      <p class="price">Price: ${item.price} ${item.currency}</p>
      ${item.instock ? `<input type="number" min="0" max="${item.limit}" value="0" class="quantity-input" id="${item.name}">` : ''}
      ${!item.instock ? `<div class="out-of-stock-label">Out of Stock</div>` : ''}
      ${stockAmountHTML}
    `;

    var quantityInput = itemElement.querySelector('.quantity-input');
    if (quantityInput) {
      quantityInput.addEventListener('input', function () {
        updateBasket();
      });
    }

    itemGrid.appendChild(itemElement);
  });
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
    content: `-----\nNew Purchase!\nMinecraft Username: ${minecraftUsername}\nDiscord Username: ${discordUsername}\nCoords: ${itemCoordsLocation}\nPlanet: ${itemPlanetLocation}\nPrice: ${priceToPay}\nItems: ${itemsField}\nAdditional Information: ${additionalInformation}`
  };

  var webhookUrl = ''; // Add discord webhook link here
  var request = new XMLHttpRequest();
  request.open('POST', webhookUrl);
  request.setRequestHeader('Content-type', 'application/json');
  request.send(JSON.stringify(payload));

  alert('Purchase Successful!');
}


window.addEventListener('DOMContentLoaded', function () {
  var basketButton = document.getElementById('basket-button');
  var closeButton = document.getElementById('close-button');

  if (basketButton && closeButton) {
    basketButton.addEventListener('click', toggleBasket);
    closeButton.addEventListener('click', toggleBasket);
  }

  generateItemElements();
  updateBasket(); // Update the basket initially

  var form = document.getElementById('checkout-form');
  if (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      submitForm();
    });
  }
});
