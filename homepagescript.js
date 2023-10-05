document
  .getElementById("confirm-search-input")
  .addEventListener("click", searchBooks);
document
  .getElementById("book-search-bar")
  .addEventListener("keydown", checkEnter);

function checkEnter(event) {
  if (event.keyCode == 13) searchBooks();
  return;
}

function searchBooks() {
  console.log("search");
  query = document.getElementById("book-search-bar").value;
  if (!query) {
    console.log("empty query");
    return;
  }
  //limit = document.getElementById("limit-selector").value;
  limit = 10;
  fetch("http://localhost:8080/bookexchange/api.php/book/search?q=" + query, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((books) => {
      if (books.error) {
        //error
        return;
      }
      bookList = document.getElementById("book-search-results");
      bookList.innerHTML = "";
      books.forEach((book) => {
        bookElement = document.getElementById("book-template").cloneNode(true);
        bookElement.setAttribute("id", book.id + book.libro);
        bookElement.querySelector("#img").setAttribute("src", book.copertina);

        bookElement.querySelector("#title").innerText = book.titolo;
        bookElement.querySelector("#editore").innerText = book.editore;
        bookElement.querySelector("#anno").innerText = book.anno;
        bookElement.querySelector("#lingua").innerText = book.lingua;
        bookElement.querySelector("#descrizione").innerText = book.descrizione;
        bookElement.querySelector("#proprietario").innerText = book.username;
        bookElement
          .querySelector("#proprietario")
          .setAttribute(
            "href",
            "/bookexchange/api.php/user/" + book.proprietario + "/profile/info"
          );

        bookElement
          .querySelector("#scambio")
          .addEventListener("click", function (event) {
            window.location =
              "exchange.php?user=" + book.proprietario + "&book=" + book.libro;
          });

        bookElement.removeAttribute("hidden");

        // bookElement.addEventListener("click", (e) => {
        //   placeBookForm(bookData);
        // });

        bookList.appendChild(bookElement);
      });
    });
}
