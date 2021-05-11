let likeBtns = document.querySelectorAll("#btnLike");
for(let i= 0; i<likeBtns.length; i++){
    likeBtns[i].addEventListener("click", function (){

        let postId = this.dataset.postid;
        let val = document.querySelector(".btnLike_" + postId).value;

        const formData = new FormData();
        formData.append('postId', postId);

        if(val === "like"){
            fetch('ajax/like.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    document.querySelector(".btnLike_" + postId).value = "unlike";
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }else if(val === "unlike"){
            fetch('ajax/unlike.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    document.querySelector(".btnLike_" + postId).value = "like";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}
