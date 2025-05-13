document.querySelector(".more").addEventListener("click", function () {
  const dropdown = document.getElementById("more-categories");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
});
