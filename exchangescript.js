var userBooksSelect = document.getElementById("user-book-select");
var userId = document.getElementById("user-id").innerText.replace("#", "");
var offerenteId = document
  .getElementById("offerente-id")
  .innerText.replace("#", "");
var libroOffertoId = document
  .getElementById("libro-offerto-id")
  .innerText.replace(/[^A-Z0-9]/gi, "");
console.log(libroOffertoId);
var selectedBookElement = document.getElementById("user-book-template");
var proponiScambioButton = document.getElementById("proponi-scambio");
var userBooks;
var selectedBook;

fetch("/bookexchange/api.php/user/" + userId + "/books", {
  method: "GET",
})
  .then((response) => response.json())
  .then((books) => {
    userBooks = books;
    books.forEach((book) => {
      fetch(
        "/bookexchange/api.php/book/" +
          book.id +
          "/authors",
        { method: "GET" }
      )
        .then((response) => response.json())
        .then((authors) => {
          let bookAuthors = "";
          authors.forEach((autore) => {
            bookAuthors = bookAuthors + autore.autore;
          });
          book.autori = bookAuthors;
        });
      fetch(
        "/bookexchange/api.php/book/" +
          book.id +
          "/categories",
        { method: "GET" }
      )
        .then((response) => response.json())
        .then((categories) => {
          let bookCategories = "";
          categories.forEach((categoria) => {
            bookCategories = bookCategories + categoria.categoria;
          });
          book.categorie = bookCategories;
        });
      optionElement = document.createElement("option");
      optionElement.setAttribute("value", books.indexOf(book));
      optionElement.innerText = book.titolo;
      userBooksSelect.appendChild(optionElement);
    });
  });

userBooksSelect.addEventListener("change", function (event) {
  if (event.target.value == "default") {
    selectedBookElement.setAttribute("hidden", true);
    selectedBook = null;
    return;
  }
  selectedBook = userBooks[event.target.value];
  selectedBookElement.querySelector("#titolo").innerText = selectedBook.titolo;
  selectedBookElement.querySelector("#lingua").innerText = selectedBook.lingua;
  selectedBookElement.querySelector("#editore").innerText =
    selectedBook.editore;
  selectedBookElement.querySelector("#autori").innerText = selectedBook.autori;
  selectedBookElement.querySelector("#categorie").innerText =
    selectedBook.categorie;
  selectedBookElement.querySelector("#anno").innerText = selectedBook.anno;
  selectedBookElement
    .querySelector("#copertina")
    .setAttribute("src", selectedBook.copertina);

  selectedBookElement.removeAttribute("hidden");
});

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function proponiScambio(e) {
  if (!selectedBook) return;

  let formData = new FormData();
  formData.append("offerente", offerenteId);
  formData.append("proponente", userId);
  formData.append("libroProposto", selectedBook.id);
  formData.append("libroOfferto", libroOffertoId);



  fetch("/bookexchange/api.php/exchange/create", {
    method: "POST",
    body: formData,
  })
    .then((response) => 
      response.json())
    .then((postResponse) => {
      if (postResponse["status"]) {
        proponiScambioButton.classList.remove("btn-danger");
        proponiScambioButton.classList.add("btn-success");
        proponiScambioButton.classList.add("disabled");
        proponiScambioButton.innerText = "Proposta effettuata";
        proponiScambioButton.removeEventListener("click", proponiScambio);

        sleep(2000).then(() =>
          window.location.replace("/bookexchange/home.php")
        );
      }
    });
}

proponiScambioButton.addEventListener("click", proponiScambio);
