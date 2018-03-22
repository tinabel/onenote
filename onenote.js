window.onload = function() {
    console.log('loaded')

    var postContainers = document.getElementsByClassName('post-link');
    console.log(postContainers);
    for (var i = 0; i < postContainers.length; i++){
        var postContainer = postContainers[i];
        var postUrl = postContainer.getAttribute('data-url');
        postContainer.onclick = function(){
            console.log(postUrl);
            window.location = postUrl;
        }

        postContainer.addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode === 13) {
                window.location = postUrl;
            }
        })
    }

}
