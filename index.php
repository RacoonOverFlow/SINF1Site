<!DOCTYPE html>
<php lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>QUAG</title>
        <link rel="stylesheet" href="css/test.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
    <header>
        <div class="header-container">
            <div>
                <a href="index.php"><img class="logo" src="Images/Logo.png" alt="logo" /></a>
            </div>

            <form action="search.php" method="GET" class="nav-search">
                <select name="category" class="select-search" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="stamps">Stamps</option>
                    <option value="coins">Coins</option>
                    <option value="comics">Comics</option>
                    <option value="cards">Cards</option>
                    <option value="miniatures">Miniatures</option>
                    <option value="events">Events</option>
                </select>
                <input type="text" name="query" placeholder="Search" class="search-input" required />
                <button type="submit" class="search-icon">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>

            <div class="users">
                <div class="user-icon">
                    <a href="userPages/login.php"><span class="material-symbols-outlined">person</span></a>
                </div>
                <div class="user-name">
                    <p>Username</p>
                </div>
                <div class="logout">
                    <a href="userPages/logout.php" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </a>
                </div>
            </div>
        </div>
    </header>

    <nav class="dashboard">
        <ul>
            <li><a class="miniatures" href="pages/miniatures.php">Miniatures</a></li>
            <li class="divider">|</li>
            <li><a class="stamps" href="pages/stamps.php">Stamps</a></li>
            <li class="divider">|</li>
            <li><a class="coins" href="pages/coins.php">Coins</a></li>
            <li class="divider">|</li>
            <li><a class="comics" href="pages/comics.php">Comics</a></li>
            <li class="divider">|</li>
            <li><a class="cards" href="pages/cards.php">Cards</a></li>
            <li class="divider">|</li>
            <li><a class="events" href="pages/events.php">Events</a></li>
            <li class="divider">|</li>
            <li><a class="collections" href="pages/MyCollections.php">My Collections</a></li>
        </ul>
    </nav>

    <main>
        <section class="spring-sale">
            <div class="sale-text">
                <h1>SHINY HUNT</h1>
                <p class="sale-info">Watch party - 15/04</p>
                <button class="shop-now" onclick="window.location.href='pages/events.php';">
                    See More
                </button>
            </div>
        </section>
    </main>

    <script src="js/mainPage.js"></script>
    </body>
</php>
