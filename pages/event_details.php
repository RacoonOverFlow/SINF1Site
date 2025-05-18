<?php
require_once '../DALs/eventsDAL.php';

if (!isset($_GET['id'])) {
  die("Event ID not provided.");
}

$eventId = intval($_GET['id']);
$dal = new DAL_Events();
$event = $dal->getEventById($eventId); // You'll need to add this method

if (!$event) {
  die("Event not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($event['title']); ?></title>
  <link rel="stylesheet" href="../css/singleItem.css" />
  <link rel="stylesheet" href="../css/test.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
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
    <hr class="filters-hr" />

<section class="box_container_primary">
  <div class="image-col">
    <img src="<?php echo htmlspecialchars($event['img_path']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" />
  </div>
  <div class="details" id="event-details" data-event-id="<?php echo $eventId; ?>">
      <p>Category: <span id="category-value" style="color: #ee8130;"><?php echo htmlspecialchars($event['category']); ?></span></p>
      <p>Date: <span id="date-value" style="color: #94cfde;"><?php echo htmlspecialchars($event['date']); ?></span></p>
      <p>Location: <span id="location-value" style="color: #94cfde;"><?php echo htmlspecialchars($event['place']); ?></span></p>
      <p>Description: <span id="description-value" style="color: #94cfde;"><?php echo htmlspecialchars($event['description']); ?></span></p>
      <button id="edit-btn">Edit</button>
    </div>
  </section>

  <script src="../js/mainPage.js"></script>
  <script src="../js/eventEdit.js"></script> <!-- New JS to handle editing -->
</body>
</html>