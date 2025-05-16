<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cards</title>
    <link rel="stylesheet" href="../css/cards.css" />
    <link rel="stylesheet" href="../css/test.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Bangers&display=swap"
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
        <li><a class="stamps" href="pages/stamps.php">Stamps</a></li>
        <li class="divider">|</li>
        <li><a class="coins" href="pages/coins.php">Coins</a></li>
        <li class="divider">|</li>
        <li><a class="comics" href="pages/comics.php">Comics</a></li>
        <li class="divider">|</li>
        <li><a class="cards" href="pages/cards.php">Cards</a></li>
        <li class="divider">|</li>
        <li><a class="events" href="../pages/events.php">Events</a></li>
        <li class="divider">|</li>
        <li>
          <a class="collections" href="../pages/MyCollections.php"
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
        <li><a href="category1.php">Category 1</a></li>
        <li><a href="category2.php">Category 2</a></li>
        <li><a href="category3.php">Category 3</a></li>
        <li><a href="category4.php">Category 4</a></li>
      </ul>
    </div>

    <div class="more-categories" id="more-categories">
      <ul>
        <li><a href="category1.php">Category 1</a></li>
        <li><a href="category2.php">Category 2</a></li>
        <li><a href="category3.php">Category 3</a></li>
        <li><a href="category4.php">Category 4</a></li>
      </ul>
    </div>

    <section class="filters">
      <div>
        <select id="category-select" class="category-dropdown">
          <option value="all" disabled selected>Category</option>
          <option value="all">All</option>
          <option value="pokemon">Pokemon</option>
          <option value="digimon">Digimon</option>
          <option value="invisimals">Invizimals</option>
          <option value="yugioh">Yugioh</option>
          <option value="bankai">Bankai</option>
        </select>
      </div>
      <div>
        <select id="subcategory-select" class="category-dropdown">
          <option value="all" disabled selected>Subcategory</option>
        </select>
      </div>
      <div class="checkbox-container" id="checkbox-container">
        <!-- Checkboxes will be dynamically added here -->
      </div>
    </section>
    <hr class="filters-hr" />

    <section class="collection_container">
      <div class="collection_box_primary">
        <div class="collection_image">
          <img
            src=""
            alt="Could not find image"
            style="max-width: 100%; max-height: 100%"
          />
        </div>
        <div class="collection_text">
          <a href="#mew.php"
            ><h1>Mew</h1>
            <h1>Normal Edition</h1></a
          >
        </div>
        <div class="icon-container">
          <a href="#favorite"
            ><img src="../Images/icons/favorite.png" alt="Favorite Icon"
          /></a>
          <a href="#search"
            ><img src="../Images/icons/search.png" alt="Search Icon"
          /></a>
          <a href="#photos"
            ><img src="../Images/icons/photos.png" alt="Photos Icon"
          /></a>
          <a href="#more"
            ><img src="../Images/icons/more.png" alt="More Icon"
          /></a>
        </div>
      </div>

      <div class="collection_box_primary">
        <div class="collection_image">
          <img
            src="../Images/cards/pokemon/charizardVShiny.png"
            alt="Could not find image"
            style="max-width: 100%; max-height: 100%"
          />
        </div>
        <div class="collection_text">
          <a href="../pages/charizard_card.php"
            ><h1>Charizard V Shiny</h1>
            <h1>Normal Edition</h1></a>
        </div>
        <div class="icon-container">
          <a href="#favorite"
            ><img src="../Images/icons/favorite.png" alt="Favorite Icon"
          /></a>
          <a href="#search"
            ><img src="../Images/icons/search.png" alt="Search Icon"
          /></a>
          <a href="#photos"
            ><img src="../Images/icons/photos.png" alt="Photos Icon"
          /></a>
          <a href="#more"
            ><img src="../Images/icons/more.png" alt="More Icon"
          /></a>
        </div>
      </div>
    </section>
  </body>
</php>
<script src="../js/mainPage.js"></script>
<script src="../js/cards.js"></script>
