<!DOCTYPE php>
<php lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stamps Collection</title>
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
    <style>
      .category-dropdown {
        width: 200px;
        height: 40px;
        background-color: #83d5f6;
        color: white;
        border: none;
        outline: none;
        font-size: 24px;
        font-weight: bold;
      }

      .category-dropdown option {
        background-color: #aad5e6;
        color: white;
        font-size: 18px;
      }

      .category-dropdown option:checked {
        background-color: #83d5f6;
      }

      .filters {
        display: flex;
        gap: 20px;
        margin-top: 20px;
        margin-left: 20px;
      }

      .styled-checkbox {
        width: 40px;
        height: 40px;
        appearance: none;
        border: 2px solid #83d5f6;
        border-radius: 4px;
        cursor: pointer;
      }

      .styled-checkbox:checked {
        background-color: #83d5f6;
        border-color: #83d5f6;
      }

      .checkbox-container {
        display: flex;
        flex-wrap: wrap;
        gap: 38px;
        justify-content: flex-end;
        align-items: center;
      }

      .checkbox-container label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #83d5f6;
      }

      .checkbox-container h2 {
        margin: 0;
        font-size: 24px;
      }

      .filters-hr {
        border: none;
        border-top: 2px solid #83d5f6;
        margin-top: 15px;
        margin-bottom: 20px;
      }

      .collection_container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        padding-left: 20px;
      }

      .collection_box_primary {
        background-color: #F6F6F4;
        padding: 20px;
        width: 260px;
        text-align: center;
        border-radius: 10px;
      }

      .collection_image {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 180px;
      }

      .collection_text {
        text-align: center;
        line-height: 1.5;
        margin-top: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      }

      .collection_text h1 {
        font-weight: 900;
      }

      .collection_text a {
        text-decoration: none;
        color: #8d7ab1;
      }

      .icon-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 10px;
      }

      .icon-container img {
        width: 40px;
        height: 40px;
        cursor: pointer;
      }

      .dashboard a {
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
      }
    </style>
</head>  
    <body>
      <header>
        <div>
          <a href="../index.html"
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
            <a class="miniatures" href="pages/miniatures.php">Miniatures</a>
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
          <li><a class="events" href="pages/events.php">Events</a></li>
          <li class="divider">|</li>
          <li>
            <a class="collections" href="pages/collections.php"
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
      <section class="filters">
        <div>
          <select id="category-select" class="category-dropdown">
            <option value="all" disabled selected>Category</option>
            <option value="all">All</option>
            <option value="Animals">Animals</option>
            <option value="Cities">Cities</option>
            <option value="Famous Spots">Famous Spots</option>
            <option value="Travel">Travel</option>
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
  
      <section class="stamps-section">
        
    <section class="collection_container">
      <div class="collection_box_primary">
        <div class="collection_image">
          <img src="C:\Users\viole\Pictures\games\stamps_Travel.jpg" alt="Could not find image" style="max-width: 100%; max-height: 100%;">
        </div>
        <div class="collection_text">
          <a href="#stamp.html"><h1>Green Travel</h1>
          <h1>Travel Edition</h1></a>
        </div>
        <div class="icon-container">
          <a href="#favorite"><img src="../Images/icons/favorite.png" alt="Favorite Icon"></a>
          <a href="#search"><img src="../Images/icons/search.png" alt="Search Icon"></a>
          <a href="#photos"><img src="../Images/icons/photos.png" alt="Photos Icon"></a>
          <a href="#more"><img src="../Images/icons/more.png" alt="More Icon"></a>
        </div>
      </div>
     <section>
      
      <section class="collection_container">
        <div class="collection_box_primary">
          <div class="collection_image">
            <img src="C:\Users\viole\Pictures\games\stamps_express_delivered.jpg" alt="Could not find image" style="max-width: 100%; max-height: 100%;">
          </div>
          <div class="collection_text">
            <a href="#stamp.html"><h1>Green Travel</h1>
            <h1>Travel Edition</h1></a>
          </div>
          <div class="icon-container">
            <a href="#favorite"><img src="../Images/icons/favorite.png" alt="Favorite Icon"></a>
            <a href="#search"><img src="../Images/icons/search.png" alt="Search Icon"></a>
            <a href="#photos"><img src="../Images/icons/photos.png" alt="Photos Icon"></a>
            <a href="#more"><img src="../Images/icons/more.png" alt="More Icon"></a>
          </div>
        </div>
        </section>

        <script>
          const subcategoryOptions = {
            Animals: ["All", "Pandas", "Shrimps", "Mew"],
            Cities: ["London", "Portugal", "New York"],
            Travel: ["Airport", "Planes", "Trains", "Cars"],
            Famous_spots: ["Eiffel Tower", "Statue of Liberty", "Big Ben"],
            all: ["Pandas","Shrimps","Mew","London","Portugal","New York","Airport","Planes","Trains",
              "Cars","Eiffel Tower","Statue of Liberty","Big Ben",],
          };
    
          const categoryCheckboxes = {
            Animals: [ "Shiny", "GX", "V", "VStar", "Holo", "Fossil"],
            Cities: ["Rookie", "Champion", "Ultimate", "Mega"],
            Travel: ["Common", "Rare", "Legendary"],
            Famous_spots: ["Fusion", "Synchro", "XYZ", "Pendulum"],
            All: ["Shikai", "Bankai", "Hollow"],
          };
    
          function updateCardsVisibility() {
            const category = document.getElementById("category-select").value;
            const subcategory = document.getElementById("subcategory-select").value;
            const selectedCheckboxes = Array.from(
              document.querySelectorAll(".styled-checkbox:checked")
            ).map((checkbox) => checkbox.nextElementSibling.textContent);
    
            const showFavoritesOnly = document.getElementById("favorite-filter").checked;
    
            const cards = document.querySelectorAll(".collection_box_primary");
    
            cards.forEach((card) => {
            const cardName = card.querySelector(".collection_text h1").textContent.toLowerCase();
              const isFavorite = card.querySelector("img[alt='Favorite Icon']").src.includes("favorite2.png");
    
            const cardCategory = cardName.includes("mew") || cardName.includes("charizard") ? "pokemon" : "";
              const cardSubcategory = cardName.includes("mew")
                ? "mew"
                : cardName.includes("charizard")
                ? "charizard"
                : "";
    
              const excludedCheckboxes = cardName.includes("mew")
                ? ["Shiny", "V", "EX", "GX", "VStar", "Holo", "Fossil"]
                : cardName.includes("charizard")
                ? ["EX", "GX", "VStar", "Holo", "Fossil"]
                : [];
    
            const shouldShow =
              (!showFavoritesOnly || isFavorite) &&
              (category === "all" || category === cardCategory) &&
              (subcategory === "all" || subcategory === cardSubcategory) &&
              !selectedCheckboxes.some((checkbox) => excludedCheckboxes.includes(checkbox));
    
              card.style.display = shouldShow ? "block" : "none";
            });
          }
    
          function populateSubcategoriesAndCheckboxes() {
            const category = document.getElementById("category-select").value;
            const subcategorySelect = document.getElementById("subcategory-select");
            const checkboxContainer = document.getElementById("checkbox-container");
    
            subcategorySelect.innerHTML = '<option value="all" disabled selected>Subcategory</option>';
            if (subcategoryOptions[category]) {
              subcategoryOptions[category].forEach((subcategory) => {
                const option = document.createElement("option");
                option.value = subcategory.toLowerCase();
                option.textContent = subcategory;
                subcategorySelect.appendChild(option);
              });
            }
    
            checkboxContainer.innerHTML = `
              <label>
                <input type="checkbox" id="favorite-filter" class="styled-checkbox" />
                <h2>Favorites</h2>
              </label>
            `;
    
            if (categoryCheckboxes[category]) {
              categoryCheckboxes[category].forEach((checkboxLabel) => {
                const label = document.createElement("label");
                label.innerHTML = `
                  <input type="checkbox" class="styled-checkbox" />
                  <h2>${checkboxLabel}</h2>
                `;
                checkboxContainer.appendChild(label);
              });
            }
    
            updateCardsVisibility();
          }
    
          document.getElementById("category-select").addEventListener("change", populateSubcategoriesAndCheckboxes);
          document.getElementById("subcategory-select").addEventListener("change", updateCardsVisibility);
          document.getElementById("checkbox-container").addEventListener("change", updateCardsVisibility);
          document.querySelector(".more").addEventListener("click", () => {
            const dropdown = document.getElementById("more-categories");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
          });
    
          // Add event listeners to toggle favorite button texture and
          document.querySelectorAll(".icon-container img[alt='Favorite Icon']").forEach((favoriteIcon) => {
            favoriteIcon.addEventListener("click", () => {
              const currentSrc = favoriteIcon.src;
              favoriteIcon.src = currentSrc.includes("favorite2.png")
                ? "../Images/icons/favorite.png"
                : "../Images/icons/favorite2.png";
    
              updateCardsVisibility();
            });
          });
        </script>
    </body>
        </php>