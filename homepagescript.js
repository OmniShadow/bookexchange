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

async function searchBooks() {
  query = document.getElementById("book-search-bar").value;
  if (!query) {
    return;
  }
  await fetch(
    "/bookexchange/api.php/book/search?q=" + query,
    {
      method: "GET",
    }
  )
    .then((response) => response.json())
    .then((books) => {
      if (books.error) {
        return;
      }
      var bookList = document.getElementById("book-search-results");
      bookList.innerHTML = "";
      books.forEach((book) => {

        let bookElement = document
          .getElementById("book-template")
          .cloneNode(true);
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

        fetch(
          "/bookexchange/api.php/book/" +
            book.libro +
            "/authors",
          {
            method: "GET",
          }
        )
          .then((response) => response.json())
          .then((getResponse) => {
            let autori = "";
            getResponse.forEach((a) => {
              autori = autori + a.autore + ", ";
            });
           
            bookElement.querySelector("#autori").innerText = autori;
          });

          fetch(
            "/bookexchange/api.php/book/" +
              book.libro +
              "/categories",
            {
              method: "GET",
            }
          )
            .then((response) => response.json())
            .then((getResponse) => {
              let categorie = "";
              getResponse.forEach((categoria) => {
                categorie = categorie + categoria.categoria + ", ";
              });
             
              bookElement.querySelector("#categorie").innerText = categorie;
            });

        bookElement.removeAttribute("hidden");

        bookList.appendChild(bookElement);
      });
    });
}
