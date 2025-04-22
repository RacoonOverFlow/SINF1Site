const subcategoryOptions = {
  pokemon: ["All", "Pikachu", "Charizard", "Bulbasaur", "Mew"],
  digimon: ["Agumon", "Gabumon", "Patamon"],
  invisimals: ["Tiger Shark", "Fire Fox", "Shadow"],
  yugioh: ["Blue-Eyes White Dragon", "Dark Magician", "Exodia"],
  bankai: ["Ichigo", "Rukia", "Renji"],
  all: [
    "All",
    "Pikachu",
    "Charizard",
    "Bulbasaur",
    "Mew",
    "Agumon",
    "Gabumon",
    "Patamon",
    "Tiger Shark",
    "Fire Fox",
    "Shadow",
    "Blue-Eyes White Dragon",
    "Dark Magician",
    "Exodia",
    "Ichigo",
    "Rukia",
    "Renji",
  ],
};

const categoryCheckboxes = {
  pokemon: ["EX", "Shiny", "GX", "V", "VStar", "Holo", "Fossil"],
  digimon: ["Rookie", "Champion", "Ultimate", "Mega"],
  invisimals: ["Common", "Rare", "Legendary"],
  yugioh: ["Fusion", "Synchro", "XYZ", "Pendulum"],
  bankai: ["Shikai", "Bankai", "Hollow"],
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
    const cardName = card
      .querySelector(".collection_text h1")
      .textContent.toLowerCase();
    const isFavorite = card
      .querySelector("img[alt='Favorite Icon']")
      .src.includes("favorite2.png");

    const cardCategory =
      cardName.includes("mew") || cardName.includes("charizard")
        ? "pokemon"
        : "";
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
      !selectedCheckboxes.some((checkbox) =>
        excludedCheckboxes.includes(checkbox)
      );

    card.style.display = shouldShow ? "block" : "none";
  });
}

function populateSubcategoriesAndCheckboxes() {
  const category = document.getElementById("category-select").value;
  const subcategorySelect = document.getElementById("subcategory-select");
  const checkboxContainer = document.getElementById("checkbox-container");

  subcategorySelect.innerHTML =
    '<option value="all" disabled selected>Subcategory</option>';
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

document
  .getElementById("category-select")
  .addEventListener("change", populateSubcategoriesAndCheckboxes);
document
  .getElementById("subcategory-select")
  .addEventListener("change", updateCardsVisibility);
document
  .getElementById("checkbox-container")
  .addEventListener("change", updateCardsVisibility);
document.querySelector(".more").addEventListener("click", () => {
  const dropdown = document.getElementById("more-categories");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
});

// Add event listeners to toggle favorite button texture
document
  .querySelectorAll(".icon-container img[alt='Favorite Icon']")
  .forEach((favoriteIcon) => {
    favoriteIcon.addEventListener("click", () => {
      const currentSrc = favoriteIcon.src;
      favoriteIcon.src = currentSrc.includes("favorite2.png")
        ? "../Images/icons/favorite.png"
        : "../Images/icons/favorite2.png";

      updateCardsVisibility();
    });
  });
