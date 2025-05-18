<!DOCTYPE php>
<php lang="en">
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const categorySelect = document.getElementById('category-select');

      categorySelect.addEventListener('change', function () {
        const selectedCategory = this.value;
        window.location.href = window.location.pathname + '?category=' + encodeURIComponent(selectedCategory);
      });
    });
  </script>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Miniatures</title>
    <link rel="stylesheet" href="../css/mini.css" />
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
          <option value="" disabled selected>Category</option>
          <option value="">All</option>
          <option value="vehicles">Vehicles</option>
          <option value="figures">Figures</option>
          <option value="dioramas">Dioramas</option>
          </select>
      </div>
      <div class="checkbox-container" id="checkbox-container">
        </div>
    </section>
    <hr class="filters-hr" />
    <?php
      require_once '../DALs/miniaturesDAL.php';

      $dal = new DAL_Miniatures();
      $category = isset($_GET['category']) ? $_GET['category'] : '';

      $miniatures = $dal->getAllMiniatures($category);

      // Start grid container
      echo '<div class="miniature-grid">';

      foreach ($miniatures as $miniature) {
        echo '
        <div class="collection_box_primary">
          <div class="collection_image">
            <img
              src="' . htmlspecialchars($miniature["img_path"]) . '"
              alt="Image not found"
              style="max-width: 100%; max-height: 100%"
            />
          </div>
          <div class="collection_text">
            <a href="miniature_details.php?id=' . htmlspecialchars($miniature["id"]) . '">
              <h1>' . htmlspecialchars($miniature["name"]) . '</h1>
              <p>' . htmlspecialchars(substr($miniature["description"], 0, 50)) . '...</p>
            </a>
          </div>
          <div class="icon-container">
            <a href="#favorite"><img src="../Images/icons/favorite.png" alt="Favorite Icon" /></a>
            <a href="#search"><img src="../Images/icons/search.png" alt="Search Icon" /></a>
            <a href="#photos"><img src="../Images/icons/photos.png" alt="Photos Icon" /></a>
            <a href="#more"><img src="../Images/icons/more.png" alt="More Icon" /></a>
          </div>
        </div>';
      }

      // End grid container
      echo '</div>';

      $dal->closeConn();
    ?>

  </body>
</php>
<script src="../js/mainPage.js"></script>
<script src="../js/miniatures.js"></script>