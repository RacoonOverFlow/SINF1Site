<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events</title>
    <link rel="stylesheet" href="../css/events.css" />

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
        <li><a class="cards" href="../pages/cards.php">Cards</a></li>
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
          <option value="card-tournaments">Card Tournaments</option>
          <option value="meet-and-greets">Meet and Greets</option>
          <option value="watch-parties">Watch Parties</option>
          <option value="release-beta-testing">Release Beta Testing</option>
          <option value="ashton-halling">Ashton Halling</option>
        </select>
      </div>
      <div class="checkbox-container" id="checkbox-container">
        <label><input type="checkbox" class="styled-checkbox" /> 1v1</label>
        <label><input type="checkbox" class="styled-checkbox" /> 2v2</label>
        <label
          ><input type="checkbox" class="styled-checkbox" /> Presential</label
        >
        <label><input type="checkbox" class="styled-checkbox" /> Online</label>
        <label
          ><input type="checkbox" class="styled-checkbox" /> Base Cards</label
        >
      </div>
    </section>
    <hr class="filters-hr" />

    <section class="collection_container">
      <div class="collection_box_primary">
        <div class="collection_image">
          <img
            src="../Images/events/ppltourn.png"
            alt="Pokemon 8 PP Tournament"
            style="max-width: 100%; max-height: 100%"
          />
        </div>
        <div class="collection_text">
          <a href="#pptourn.php"><h1>Pokemon 8 PP Tournament</h1></a>
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

      <!-- New Pokemon 1v1 Porto Event -->
      <div class="collection_box_primary">
        <div class="collection_image">
          <img
            src="../Images/events/1v1.png"
            alt="Pokemon 1v1 Porto"
            style="max-width: 100%; max-height: 100%"
          />
        </div>
        <div class="collection_text">
          <a href="#pokemon_1v1_porto.php"><h1>Pokemon 1v1 Porto</h1></a>
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
