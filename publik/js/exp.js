function updateExp(action) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "profil.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };

    xhr.send("action=" + action);
}