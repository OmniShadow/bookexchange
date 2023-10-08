document
  .getElementById("confirm-search-input")
  .addEventListener("click", searchBooks);
document
  .getElementById("book-search-bar")
  .addEventListener("keydown", checkEnter);

document.getElementById("manual-input").addEventListener("click", (e) => {
  placeBookForm(null);
});

document.getElementById("add-author-field").addEventListener("click", () => {
  addAuthorField();
});
document.getElementById("add-categorie-field").addEventListener("click", () => {
  addCategoriaField();
});

document
  .getElementById("book-input-form")
  .addEventListener("submit", function (event) {});

function checkEnter(event) {
  if (event.keyCode == 13) searchBooks();
  return;
}

function addAuthorField(value) {
  var authorsRow = document.getElementById("authors-row");
  var authorFieldTemplate = document
    .getElementById("author-field-template")
    .cloneNode(true);
  authorFieldTemplate.removeAttribute("hidden");
  authorFieldTemplate.removeAttribute("id");
  if (value) {
    authorFieldTemplate.querySelector("#autore").setAttribute("value", value);
    authorFieldTemplate.querySelector("#autore").setAttribute("readonly", "");
  }

  authorsRow.appendChild(authorFieldTemplate);
}

function addCategoriaField(value) {
  var authorsRow = document.getElementById("categories-row");
  var categorieFieldTemplate = document
    .getElementById("categorie-field-template")
    .cloneNode(true);
  categorieFieldTemplate.removeAttribute("hidden");
  categorieFieldTemplate.removeAttribute("id");
  if (value) {
    categorieFieldTemplate
      .querySelector("#categoria")
      .setAttribute("value", value);
    categorieFieldTemplate
      .querySelector("#categoria")
      .setAttribute("readonly", "");
  }

  authorsRow.appendChild(categorieFieldTemplate);
}

function placeBookForm(bookData) {
  document
    .getElementById("book-input-form")
    .addEventListener("submit", (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
    });
  var main = document.getElementById("main");
  var form = document.getElementById("book-form-template");
  form
    .querySelector("#userId")
    .setAttribute(
      "value",
      window.location.href.split(window.location.host)[1].split("/")[4]
    );
  form
    .querySelector("#copertina-url")
    .setAttribute(
      "value",
      "/bookexchange/imgs/bookcovers/default-book-cover.jpg"
    );
  if (bookData) {
    form
      .querySelector("#copertina-url")
      .setAttribute("value", bookData.copertina);

    form.querySelector("#titolo").setAttribute("value", bookData.titolo);
    form.querySelector("#id").setAttribute("value", bookData.id);
    form.querySelector("#editore").setAttribute("value", bookData.editore);
    form.querySelector("#anno").setAttribute("value", bookData.anno);
    form.querySelector("#lingua").setAttribute("value", bookData.lingua);

    form.querySelector("#titolo").setAttribute("readonly", "");
    form.querySelector("#id").setAttribute("readonly", "");
    form.querySelector("#editore").setAttribute("readonly", "");
    form.querySelector("#anno").setAttribute("readonly", "");
    form.querySelector("#lingua").setAttribute("readonly", "");
    form.querySelector("#copertina").setAttribute("readonly", "");
    document.getElementById("add-author-field").setAttribute("disabled", "");
    document.getElementById("add-categorie-field").setAttribute("disabled", "");

    bookData.autori.forEach((autore) => {
      addAuthorField(autore);
    });

    bookData.categorie.forEach((categoria) => {
      addCategoriaField(categoria);
    });
  }
  form.removeAttribute("hidden");
  main.innerHTML = "";
  main.appendChild(form);
  var form = document.getElementById("book-input-form");

  form.addEventListener("submit", function (event) {
    if (!form.checkValidity()) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      idInput = form.querySelector("#id");

      if (idInput !== "")
        fetch(
          "http://localhost:8080/bookexchange/api.php/book/" + idInput.value,
          {
            method: "GET",
          }
        )
          .then((response) => response.json())
          .then((jsonResponse) => {
            if (jsonResponse.length != 0)
              idInput.setCustomValidity("Inserire un id valido");
            else idInput.setCustomValidity("");
          });

      form.classList.add("was-validated");
    }
  });
}

function searchBooks() {
  query = document.getElementById("book-search-bar").value;
  if (!query) {
    return;
  }
  //limit = document.getElementById("limit-selector").value;
  limit = Number(document.getElementById("limit").value);
  filtro = document.getElementById("filtro").value;
  fetch(
    "http://localhost:8080/bookexchange/api.php/book/list?q=" +
      '"' +
      filtro +
      query +
      '"' +
      "&limit=" +
      limit,
    {
      method: "GET",
    }
  )
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
        bookElement.setAttribute("id", book.id);
        bookElement
          .querySelector("#img")
          .setAttribute(
            "src",
            Object.hasOwn(book.volumeInfo, "imageLinks")
              ? book.volumeInfo.imageLinks.thumbnail
              : "default-book-cover.jpg"
          );

        bookElement.querySelector("#title").innerText = book.volumeInfo.title;
        bookElement.querySelector("#autori").innerText =
          book.volumeInfo.authors;
        bookElement.querySelector("#categorie").innerText = Object.hasOwn(
          book.volumeInfo,
          "categories"
        )
          ? book.volumeInfo.categories
          : "";
        bookElement.querySelector("#editore").innerText =
          book.volumeInfo.publisher;
        bookElement.querySelector("#anno").innerText =
          book.volumeInfo.publishedDate;
        bookElement.querySelector("#lingua").innerText =
          book.volumeInfo.language;

        bookElement.removeAttribute("hidden");

        var bookData = {
          id: book.id,
          titolo: book.volumeInfo.title,
          editore: book.volumeInfo.publisher,
          copertina: Object.hasOwn(book.volumeInfo, "imageLinks")
            ? book.volumeInfo.imageLinks.thumbnail
            : "/bookexchange/imgs/bookcovers/default-book-cover.jpg",
          anno: book.volumeInfo.publishedDate,
          lingua: book.volumeInfo.language,
          autori: Object.hasOwn(book.volumeInfo, "authors")
            ? book.volumeInfo.authors
            : [],
          categorie: Object.hasOwn(book.volumeInfo, "categories")
            ? book.volumeInfo.categories
            : [],
        };

        bookElement.addEventListener("click", (e) => {
          placeBookForm(bookData);
        });

        bookList.appendChild(bookElement);
      });
    });
}
