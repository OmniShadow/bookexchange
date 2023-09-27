

document.getElementById("confirm-search-input").addEventListener("click", testAPI);

function testAPI() {

    fetch('api.php/book/1', {
        method: "POST",
        body: JSON.stringify({
            userId: 1,
            description: 'la mia descrizione',
        }),
    }).then((response) => response.json()).then(responseData => {
        console.log(responseData.status);
    });

}