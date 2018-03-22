var postLinks = function () {
    var postContainers = document.getElementsByClassName('post-link');
    for (var i = 0; i < postContainers.length; i++){
        var postContainer = postContainers[i];
        var postUrl = postContainer.getAttribute('data-url');
        postContainer.onclick = function(){
            window.location = postUrl;
        }

        postContainer.addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode === 13) {
                window.location = postUrl;
            }
        });
    }
}

window.onload = function() {
    new postLinks;
}
