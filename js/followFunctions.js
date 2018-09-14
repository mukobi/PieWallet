function toggleFollow(element, id) {
    var toFollow = !element.classList.contains('unfollow');
    if(toFollow) {
        element.classList.add('unfollow');
        element.innerHTML = "Unfollow";
        var count = document.getElementById('following-count');
        if(count !== null) count.innerHTML = parseInt(count.innerHTML) + 1;
        // send follow request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "server/followCommands.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send(`action=follow&id=${id}`);
    }
    else {
        element.classList.remove('unfollow');
        element.innerHTML = "Follow";
        var count = document.getElementById('following-count');
        if(count !== null) count.innerHTML = parseInt(count.innerHTML) - 1;
        // send unfollow request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "server/followCommands.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send(`action=unfollow&id=${id}`);
    }
}