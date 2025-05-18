<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event</title>
    <link rel="stylesheet" href="../css/singleItem.css" />
    <link rel="stylesheet" href="../css/test.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  </head>
  <body>
    <header>
      <div>
        <a href="../index.php"><img class="logo" src="../Images/Logo.png" alt="logo" /></a>
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
        <li class="more">
          <span class="menu hamburger material-symbols-outlined">menu</span>
          More
        </li>
      </ul>
    </nav>

    <section class="box_container_primary">
      <div class="title-inside" id="event_title">Pokémon 1v1 Tournament - Porto</div>
      <img src="../Images/events/1v1.png" alt="Pokémon 1v1 in Porto" />
      <div class="details" id="event-details">
        <p>Category: <span id="category-value" style="color: #ee8130;">Trading</span></p>
        <p>Date: <span id="date-value" style="color: #94cfde;">18/06/2025</span></p>
        <p>Location: <span id="location-value" style="color: #94cfde;">Porto, Portugal</span></p>
        <p>Description: <span id="description-value" style="color: #94cfde;">1v1 battles using custom Pokémon decks. Prizes for top 3.</span></p>
        <button id="edit-btn">Edit</button>
      </div>
    </section>

<script>
function formatDateEU(dateStr) {
  if (!dateStr) return '';
  if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return dateStr;
  const d = new Date(dateStr);
  if (isNaN(d.getTime())) return dateStr;
  const day = String(d.getDate()).padStart(2, '0');
  const month = String(d.getMonth() + 1).padStart(2, '0');
  const year = d.getFullYear();
  return `${day}/${month}/${year}`;
}

function renderDetails(data) {
  const details = document.getElementById('event-details');
  let catColor = '#ee8130';
  details.innerHTML = `
    <p>Category: <span id="category-value" style="color: ${catColor};">${data.category}</span></p>
    <p>Date: <span id="date-value" style="color: #94cfde;">${formatDateEU(data.date)}</span></p>
    <p>Location: <span id="location-value" style="color: #94cfde;">${data.location}</span></p>
    <p>Description: <span id="description-value" style="color: #94cfde;">${data.description}</span></p>
  `;
  if (!document.getElementById('edit-btn')) {
    const editBtn = document.createElement('button');
    editBtn.id = 'edit-btn';
    editBtn.textContent = 'Edit';
    details.appendChild(editBtn);
    editBtn.addEventListener('click', () => startEdit(data));
  }
}

function startEdit(data) {
  const details = document.getElementById('event-details');
  const catOptions = ['Trading', 'Meetup', 'Auction', 'Workshop', 'Showcase', 'Tournament', 'Guest talk', 'Appraisal', 'Other'];
  let catSelect = `<select id="category-input">`;
  catOptions.forEach(opt => {
    catSelect += `<option value="${opt}"${data.category === opt ? ' selected' : ''}>${opt}</option>`;
  });
  catSelect += `</select>`;

  let dateValue = data.date;
  const dateObj = new Date(dateValue);
  if (!isNaN(dateObj.getTime())) {
    dateValue = dateObj.toISOString().slice(0, 10);
  }

  details.innerHTML = `
    <p>Category: ${catSelect}</p>
    <p>Date: <input id="date-input" type="date" value="${dateValue}" /></p>
    <p>Location: <input id="location-input" value="${data.location}" /></p>
    <p>Description: <textarea id="description-input">${data.description}</textarea></p>
    <button id="save-btn">Save</button>
    <button id="cancel-btn">Cancel</button>
  `;
  document.getElementById('save-btn').onclick = function() {
    const dateInput = document.getElementById('date-input').value.trim();
    const dateObj = new Date(dateInput);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    if (!dateInput || dateObj < today) {
      alert('Date must be in the future.');
      return;
    }
    const newData = {
      category: document.getElementById('category-input').value,
      date: dateInput,
      location: document.getElementById('location-input').value,
      description: document.getElementById('description-input').value
    };
    renderDetails(newData);
  };
  document.getElementById('cancel-btn').onclick = function() {
    renderDetails(data);
  };
}

const initialData = {
  category: document.getElementById('category-value').textContent,
  date: document.getElementById('date-value').textContent,
  location: document.getElementById('location-value').textContent,
  description: document.getElementById('description-value').textContent
};

document.getElementById('edit-btn').addEventListener('click', () => startEdit(initialData));
</script>
<script src="../js/mainPage.js"></script>
</body>
</php>