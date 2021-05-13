let likeBtns = document.querySelectorAll("#btnLike");
for(let i= 0; i<likeBtns.length; i++){
    likeBtns[i].addEventListener("click", function (a){

        a.preventDefault();
        let postId = this.dataset.postid;

        const formData = new FormData();

        formData.append('postId', postId);

        fetch('ajax/like.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
                document.querySelector(".btnLike_" + postId).value = "unlike";
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
}
