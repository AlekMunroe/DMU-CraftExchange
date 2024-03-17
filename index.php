<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico"
    <title>CraftExchange</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sql.js/1.8.0/sql-wasm.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8863715620158289"
            crossorigin="anonymous"></script>
</head>

<body>
    <div class="overlay"></div>
    <header>
        <h1 class="logo">CraftExchange</h1>
        <button id="basket-button" class="basket-icon"><i class="fa-solid fa-basket-shopping"></i></button>


    </header>

    <main>
        <h1>Welcome to the CraftExchange!</h1>

        <div class="notifications">
            <p>We're Back For DM Update 69!</p>
            <p>Stay tuned!</p>
        </div>

        <div class="grid" id="item-grid">
            <!-- Item elements will be generated here -->
        </div>
    </main>

    <div id="basket" class="basket">
        <button id="close-button">Close</button>
        <h2>Basket</h2>
        <ul id="basket-items"></ul>
        <p id="basket-total"></p>
        <form id="checkout-form">
            <label for="minecraft-username">Minecraft Username</label>
            <input type="text" id="minecraft-username" required>

            <label for="discord-username">Discord Username</label>
            <input type="text" id="discord-username" required>

            <label for="item-coords-location">Item Coords Location</label>
            <input type="text" id="item-coords-location" required>

            <label for="item-planet-location">Item Planet Location</label>
            <input type="text" id="item-planet-location" required>

            <div>
                <label for="price-to-pay">Price to Pay:</label>
                <input type="text" id="price-to-pay" readonly>
            </div>
            <div>
                <label for="basket-items-field">Items:</label>
                <input type="text" id="basket-items-field" readonly>
            </div>

            <label for="additional-information">Additional Information</label>
            <textarea id="additional-information"></textarea>

            <p style="color: red;">
                Please leave a chest at your coords and remember to leave your payment in there.
            </p>

            <input type="submit" value="Checkout">
        </form>
    </div>

    <br>><center>
        <p>More items coming soon!</p>
    </center>

    <script src="script.js"></script>
</body>

</html>