let btns = document.querySelectorAll(".btnAddComment");

    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {

            let postId = this.dataset.postid;
            let text = document.querySelector(".commentText").value;

            console.log(postId);
            console.log(text);

            const formData = new FormData();

            formData.append('text', text);
            formData.append('postId', postId);

            fetch('ajax/savecomment.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    let newComment = document.createElement('li');
                    newComment.innerHTML = result.body;
                    let commentlist = document.querySelectorAll(".comment__list");
                        for(let i = 0; i<commentlist.length; i++){
                            commentlist[i].appendChild(newComment);
                            console.log(commentlist[i]);
                        }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
