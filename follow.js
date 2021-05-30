document.querySelector(".btnFollow").addEventListener("click", ()=>{
    let followerId = document.querySelector(".btnFollow").dataset.userid;

    const formData = new FormData();

    formData.append('followerId', followerId);

    fetch('ajax/follow.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
            document.querySelector(".btnFollow").value = "unfollow";
        })
        .catch(error => {
            console.error('Error:', error);
        });
});