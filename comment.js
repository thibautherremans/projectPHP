let btns = document.querySelectorAll(".btnAddComment");

    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {

            let postId = this.dataset.postid;
            let text = document.querySelector(".commentText_" + postId).value;

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
                    let commentlist = document.querySelector(".commentList_" + postId);
                            commentlist.appendChild(newComment);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }

