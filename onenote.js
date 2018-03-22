var postLinks = function () {
    var postContainers = document.getElementsByClassName('post-link');

    for (var i = 0; i < postContainers.length; i++){
        var postContainer = postContainers[i];
        postContainer.onclick = function(){
            var postUrl = this.getAttribute('data-url');
            window.location = postUrl;
        }

        postContainer.addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode === 13) {
                postUrl = this.getAttribute('data-url');
                window.location = postUrl;
            }
        });
    }
}

window.onload = function() {
    new postLinks;
}
