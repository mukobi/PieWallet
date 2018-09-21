function toggleFollow(element, id) {
    var toFollow = !element.classList.contains('unfollow');
    if(toFollow) {
        element.classList.add('unfollow');
        element.innerHTML = "Unfollow";
        var count = document.getElementById('follow-count');
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
        var count = document.getElementById('follow-count');
        if(count !== null) count.innerHTML = parseInt(count.innerHTML) - 1;
        // send unfollow request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "server/followCommands.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send(`action=unfollow&id=${id}`);
    }
}

function getFollowsHTML(type, id, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() { 
        if (xhttp.readyState == 4 && xhttp.status == 200)
            callback(xhttp.responseText);
    }
    xhttp.open("GET", `server/getFollowsHTML.php?type=${type}&id=${id}`, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(null);
}

