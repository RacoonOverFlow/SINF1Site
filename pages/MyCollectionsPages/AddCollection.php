<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collections</title>
    <link rel="stylesheet" href="../../css/test.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <style>
        body {
            text-align: left;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        .page-title {
            text-align: center;
            color: #f28af7;
            font-size: 4em;
            font-weight: bold;
            margin-bottom: 40px;
        }
        .collections-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 150px;
            padding-left: 20px;
        }
        .collection-box {
            width: 300px;
            height: 300px;
            background-color: #fde0fe;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            padding: 25px;
            position: relative;
        }
        .add-new {
            cursor: pointer;
            width: 160px;
            height: 160px;
            background-color: #fde0fe;
            background-image: url('../../Images/icons/plus.png');
            background-size: 160px;
            background-position: center;
            background-repeat: no-repeat;
        }
        .import-existing {
            cursor: pointer;
            width: 160px;
            height: 160px;
            background-color: #fde0fe;
            background-image: url('../../Images/icons/import.png');
            background-size: 150px;
            background-position: center;
            background-repeat: no-repeat;
        }
        .collection-description {
            color: #f28af7;
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            display: block;
            word-wrap: break-word;
            white-space: normal;
            line-height: 1.4;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .previous-button-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }
        .previous-button {
            background-color: #f28af7;
            color: white;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 36px;
        }
        .previous-button:hover {
            background-color: #d88be2;
        }
        .previous-button span {
            font-size: 36px;
        }
        .my-collections-text {
            font-size: 36px;
            color: #f28af7;
            text-decoration: none;
            font-weight: 600;
        }
        .my-collections-text:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <div>
        <a href="../../index.html"><img class="logo" src="../../Images/Logo.png" alt="logo"></a>
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
        <li><a class="miniatures" href="../../pages/miniatures.html">Miniatures</a></li>
        <li class="divider">|</li>
        <li><a class="stamps" href="../../pages/stamps.html">Stamps</a></li>
        <li class="divider">|</li>
        <li><a class="coins" href="../../pages/coins.html">Coins</a></li>
        <li class="divider">|</li>
        <li><a class="comics" href="../../pages/comics.html">Comics</a></li>
        <li class="divider">|</li>
        <li><a class="cards" href="../../pages/cards.html">Cards</a></li>
        <li class="divider">|</li>
        <li><a class="events" href="../../pages/events.html">Events</a></li>
        <li class="divider">|</li>
        <li><a class="collections active" href="../../pages/MyCollections.html">My Collections</a></li>
        <li class="divider">|</li>
        <li class="more">
            <span class="menu hamburger material-symbols-outlined">menu</span>
            More
        </li>
    </ul>
</nav>

<div class="more-categories" id="more-categories">
    <ul>
        <li><a href="../../pages/category1.html">Category 1</a></li>
        <li><a href="../../pages/category2.html">Category 2</a></li>
        <li><a href="../../pages/category3.html">Category 3</a></li>
        <li><a href="../../pages/category4.html">Category 4</a></li>
    </ul>
</div>

<main>
    <div class="previous-button-container">
        <a href="../../pages/MyCollections.html" class="previous-button">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <a href="../../pages/MyCollections.html" class="my-collections-text">My Collections</a>
    </div>
    <h1 class="page-title">Adding a Collection</h1>
    <section class="collections-container">
        <div>
            <div class="collection-box">
                <div class="add-new" onclick="window.location.href='AddCollection.html'"></div>
            </div>
            <p class="collection-description">Create My Own Collection</p>
        </div>

        <div>
            <div class="collection-box">
                <div class="import-existing"></div>
            </div>
            <p class="collection-description">Import from Existing Collections</p>
        </div>
    </section>
</main>

<script>
    document.querySelector(".more").addEventListener("click", function () {
        const dropdown = document.getElementById("more-categories");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });
</script>
</body>
</php>
