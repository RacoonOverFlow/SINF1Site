<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cards</title>
    <link rel="stylesheet" href="../css/singleItem.css" />

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

    <section class="box_container_primary">
      <div class="title-inside" id="card_title">Charizard V Shiny - Normal Edition</div>
      <img
        src="../Images/cards/pokemon/charizardVShiny.png"
        alt="Charizard V Shiny"
      />
      <div class="details" id="card-details">
          <p>Rarity: <span id="rarity-value" style="color: #ee8130;">Rare</span></p>
          <p>Release: <span id="release-value" style="color: #94cfde;">November 12, 2021</span></p>
          <p>Set: <span id="set-value" style="color: #94cfde;">Champion's Path</span></p>
          <p>Card: <span id="cardnum-value" style="color: #94cfde;">#SV107/SV122</span></p>
          <p>Weight: <span id="weight-value" style="color: #94cfde;">1.6g</span></p>
          <button id="edit-btn">Edit</button>
      </div>
    </section>
<script>
function formatDateEU(dateStr) {
  // Accepts 'YYYY-MM-DD' or 'YYYY-MM-DDTHH:MM:SS' or 'DD/MM/YYYY'
  if (!dateStr) return '';
  // If already in DD/MM/YYYY, return as is
  if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return dateStr;
  const d = new Date(dateStr);
  if (isNaN(d.getTime())) return dateStr;
  const day = String(d.getDate()).padStart(2, '0');
  const month = String(d.getMonth() + 1).padStart(2, '0');
  const year = d.getFullYear();
  return `${day}/${month}/${year}`;
}

function renderDetails(data) {
  const details = document.getElementById('card-details');
  // Set color based on rarity
  let rarityColor = '##ee8130'; // default
  if (data.rarity === 'Common') rarityColor = '#a8a77a';
  else if (data.rarity === 'Uncommon') rarityColor = '#7ac74c';
  else if (data.rarity === 'Rare') rarityColor = '#ee8130';
  details.innerHTML = `
  <p>Rarity: <span id="rarity-value" style="color: ${rarityColor};">${data.rarity}</span></p>
  <p>Release: <span id="release-value" style="color: #94cfde;">${formatDateEU(data.release)}</span></p>
  <p>Set: <span id="set-value" style="color: #94cfde;">${data.set}</span></p>
  <p>Card: <span id="cardnum-value" style="color: #94cfde;">${data.cardnum}</span></p>
  <p>Weight: <span id="weight-value" style="color: #94cfde;">${data.weight}</span></p>
  `;
  // Re-add the Edit button
  if (!document.getElementById('edit-btn')) {
    const editBtn = document.createElement('button');
    editBtn.id = 'edit-btn';
    editBtn.textContent = 'Edit';
    details.appendChild(editBtn);
    editBtn.addEventListener('click', () => startEdit(data));
  }
}

function startEdit(data) {
  const details = document.getElementById('card-details');
  // Convert release to YYYY-MM-DD for date input
  let releaseValue = data.release;
  const dateObj = new Date(releaseValue);
  if (!isNaN(dateObj.getTime())) {
    releaseValue = dateObj.toISOString().slice(0, 10);
  }
  // Dropdown for rarity
  const rarityOptions = ['Common', 'Uncommon', 'Rare'];
  let raritySelect = `<select id="rarity-input">`;
  rarityOptions.forEach(opt => {
    raritySelect += `<option value="${opt}"${data.rarity === opt ? ' selected' : ''}>${opt}</option>`;
  });
  raritySelect += `</select>`;

  details.innerHTML = `
    <p>Rarity: ${raritySelect}</p>
    <p>Release: <input id="release-input" type="date" value="${releaseValue}" /></p>
    <p>Set: <input id="set-input" value="${data.set}" /></p>
    <p>Card: <input id="cardnum-input" value="${data.cardnum}" /></p>
    <p>Weight: <input id="weight-input" value="${data.weight}" /></p>
    <button id="save-btn">Save</button>
    <button id="cancel-btn">Cancel</button>
  `;
  document.getElementById('save-btn').onclick = function() {
    let weightValue = document.getElementById('weight-input').value.trim();
    weightValue = weightValue.replace(/\s*(?!kg$|g$)[a-zA-Z]+$/i, '');
    if (!/(kg|g)$/i.test(weightValue)) {
      weightValue += 'g';
    }

    // Validate release date
    const releaseInput = document.getElementById('release-input').value.trim();
    const releaseDate = new Date(releaseInput);
    const today = new Date();
    today.setHours(0,0,0,0);

    if (!releaseInput || releaseDate > today) {
      alert('Release date cannot be in the future.');
      return;
    }

    const newData = {
      rarity: document.getElementById('rarity-input').value,
      release: releaseInput,
      set: document.getElementById('set-input').value,
      cardnum: document.getElementById('cardnum-input').value,
      weight: weightValue
    };
    renderDetails(newData);
  };
  document.getElementById('cancel-btn').onclick = function() {
    renderDetails(data);
  };
}

// Initial data from the page
const initialData = {
  rarity: document.getElementById('rarity-value').textContent,
  release: document.getElementById('release-value').textContent,
  set: document.getElementById('set-value').textContent,
  cardnum: document.getElementById('cardnum-value').textContent,
  weight: document.getElementById('weight-value').textContent
};

document.getElementById('edit-btn').addEventListener('click', () => startEdit(initialData));
</script>
</body>
</php>
<script src="../js/mainPage.js"></script>
