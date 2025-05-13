<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Collections</title>
    <link rel="stylesheet" href="../css/test.css" />
    <link rel="stylesheet" href="../css/myCollections.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    />
  </head>
  <body>
    <header>
      <div>
        <a href="../index.php"
          ><img class="logo" src="../Images/Logo.png" alt="logo" 
        /></a>
      </div>
      <div class="nav-search">
        <select class="select-search">
          <option>All</option>
          <option>All Categories</option>
        </select>
        <input type="text" placeholder="Search" class="search-input" />
        <div class="search-icon">
          <span class="material-symbols-outlined">search</span>
        </div>
      </div>
    </header>

    <nav class="dashboard">
      <ul>
        <li>
          <a class="miniatures" href="../pages/miniatures.php">Miniatures</a>
        </li>
        <li class="divider">|</li>
        <li><a class="stamps" href="../pages/stamps.php">Stamps</a></li>
        <li class="divider">|</li>
        <li><a class="coins" href="../pages/coins.php">Coins</a></li>
        <li class="divider">|</li>
        <li><a class="comics" href="../pages/comics.php">Comics</a></li>
        <li class="divider">|</li>
        <li><a class="cards" href="../pages/cards.php">Cards</a></li>
        <li class="divider">|</li>
        <li><a class="events" href="../pages/events.php">Events</a></li>
        <li class="divider">|</li>
        <li>
          <a class="collections active" href="../pages/MyCollections.php"
            >My Collections</a
          >
        </li>
        <li class="divider">|</li>
        <li class="more">
          <span class="menu hamburger material-symbols-outlined">menu</span>
          More
        </li>
      </ul>
    </nav>

    <div class="more-categories" id="more-categories">
      <ul>
        <li><a href="../pages/category1.php">Category 1</a></li>
        <li><a href="../pages/category2.php">Category 2</a></li>
        <li><a href="../pages/category3.php">Category 3</a></li>
        <li><a href="../pages/category4.php">Category 4</a></li>
      </ul>
    </div>

    <main>
      <h1 class="page-title">My Collections</h1>
      <section class="collections-container">
        <a href="../pages/oneOfMyCollection.php">
          <div class="collection-box">
            <img
              src="../Images/trains/choochootrain.png"
              alt="ChooChoo Train"
            />
          </div>
          <p class="collection-description">ChooChoo Trains</p>
        </a>

        <div
          class="add-new"
          onclick="window.location.href='../pages/MyCollectionsPages/AddCollection.php'"
        >
          <img src="../Images/icons/plus.png" alt="Add Collection" />
        </div>
      </section>
    </main>
  </body>
</php>
<script src="../js/mainPage.js"></script>
