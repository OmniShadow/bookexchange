<script>
    formData = new FormData();
    formData.append("id", <?php session_start();
    echo $_SESSION["user"]["id"];
    ?>);

 fetch("/bookexchange/api.php/user/logout", {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json()).then(responseJson => {
            console.log(responseJson);
            window.location.replace("/bookexchange/");
            
        }
        );
</script>