<!DOCTYPE php>
<php lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stamps</title>
        <link rel="stylesheet" href="../css/stamp.css" />
        <link rel="stylesheet" href="../css/test.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category-select');
            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    const selectedCategory = this.value;
                    const params = new URLSearchParams(window.location.search);
                    if (selectedCategory) {
                        params.set('category', selectedCategory);
                    } else {
                        params.delete('category');
                    }
                    window.location.search = params.toString();
                });
            }
        });
    </script>

    <header>
        <div class="header-container">
            <div>
                <a href="../index.php"><img class="logo" src="../Images/Logo.png" alt="logo" /></a>
            </div>

            <form action="../search.php" method="GET" class="nav-search">
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
                    <a href="../userPages/login.php"><span class="material-symbols-outlined">person</span></a>
                </div>
                <div class="user-name">
                    <p>Username</p>
                </div>
                <div class="logout">
                    <button type="button" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </button>
                </div>
            </div>
        </div>
    </header>



    <nav class="dashboard">
        <ul>
            <li><a class="miniatures" href="../pages/miniatures.php">Miniatures</a></li>
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
            <li><a class="collections" href="../pages/MyCollections.php">My Collections</a></li>
            <li class="divider">|</li>
            <li><a class="upload" href="../pages/upload/csv_coins.php">CSV Upload</a></li>
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
                <option value="" disabled selected>Category</option>
                <option value="">All</option>
                <option value="postal">Postal</option>
                <option value="commemorative">Commemorative</option>
                <option value="special">Special Issues</option>
            </select>
        </div>
        <div class="checkbox-container" id="checkbox-container">
            <label>
                <input type="checkbox" id="favorite-filter" class="styled-checkbox" />
                <span>Favorites</span>
            </label>
        </div>
    </section>
    <hr class="filters-hr" />

    <?php
    require_once '../DALs/stampsDAL.php';
    $dal = new DAL_Stamps();

    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $query = isset($_GET['query']) ? $_GET['query'] : '';

    if ($query !== '') {
        $stamps = $dal->searchByName($query);
    } else {
        $stamps = $dal->getAllStamps($category);
    }

    echo '<div class="stamp-grid">';

    foreach ($stamps as $stamp) {
        echo '
        <div class="collection_box_primary">
            <div class="collection_image">
            <img
                src="' . htmlspecialchars($stamp["img_path"]) . '"
                alt="Image not found"
                style="max-width: 100%; max-height: 100%"
            />
            </div>
            <div class="collection_text">
            <a href="stamps_details.php?id=' . htmlspecialchars($stamp["id"]) . '">
                <h1>' . htmlspecialchars($stamp["name"]) . '</h1>
                <p>' . htmlspecialchars($stamp["country"]) . ', ' . htmlspecialchars($stamp["year"]) . '</p>
            </a>
            </div>
            <div class="icon-container">
            <a href="#favorite" class="favorite-btn" data-id="<?= htmlspecialchars($stamp["id"]) ?>">
                <img src="../Images/icons/favorite.png" alt="Favorite Icon" />
            </a>
            <a href="#search" class="search-category" data-category="' . htmlspecialchars($stamp["category"]) . '">
                <img src="../Images/icons/search.png" alt="Search Icon" />
            </a>
            <a href="#photos" class="photos-link" data-img="<?= htmlspecialchars($stamp["img_path"]) ?>">
                <img src="../Images/icons/photos.png" alt="Photos Icon" />
            </a>
            <a href="#more" class="more-link" data-id="<?= htmlspecialchars($stamp["id"]) ?>">
                <img src="../Images/icons/more.png" alt="More Icon" />
            </a>
            </div>
        </div>';
    }

    echo '</div>';
    $dal->closeConn();
    ?>
    </body>
</php>

<script src="../js/mainPage.js"></script>
<script src="../js/iconLogic.js"></script>
