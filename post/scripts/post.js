document.addEventListener('DOMContentLoaded', function(){
    function getFormattedDate(){
        const now = new Date();
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const daySuffixes = ['st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th', 'th', 'st'];
        let hour = now.getHours();
        const ampm = hour >= 12 ? 'pm' : 'am';
        hour = hour % 12;
        hour = hour ? hour : 12;
        const minute = now.getMinutes();
        const month = monthNames[now.getMonth()];
        const date = now.getDate();
        const daySuffix = daySuffixes[date - 1];
        const formattedDate = `${hour}:${minute < 10 ? '0' : ''}${minute} ${ampm.toUpperCase()} ${month} ${date}${daySuffix}`;
        return formattedDate;
    }
    function sendRequest(to, body, func){
        const xml = new XMLHttpRequest();
        xml.addEventListener('readystatechange', function(){
            if(xml.status === 200 && xml.readyState === 4){
                func(xml.responseText);
            }
        })
        xml.open('POST', to, true);
        xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xml.send(body)
    }
    const post_form = document.querySelector('.post_form');
    const users_email = document.getElementById('post_information_email').value;
    const users_name = document.getElementById('post_information_name').value;
    post_form.addEventListener('submit', function(e){
        e.preventDefault();
        let text = document.querySelector('.post_input').value.trim();
        if(text !== ''){
            let date = getFormattedDate();
            sendRequest('./post/scripts/post.php', `text=${encodeURIComponent(text)}&date=${date}&name=${encodeURIComponent(users_name)}&email=${encodeURIComponent(users_email)}`, function(res){
                if(res != 1){
                    alert(res);
                } else {
                    window.location.reload();
                }
            });
        }
    })
    const like_btns = document.querySelectorAll('#like_btn');
    for(let i = 0; i < like_btns.length; i++){
        let current = like_btns[i];
        current.addEventListener('click', function(){
            const like_count = this.querySelector('.like_count');
            let count = like_count.innerText;
            count = parseInt(count);
            let post_id = like_count.id;
            let likers = this.getAttribute('value') + users_email + ',';
            sendRequest('./post/scripts/like.php', `like=${like_count}&post_id=${post_id}&likers=${likers}`, function(res){
                if(res != 1){
                    alert(res);
                } else {
                    current.querySelector('.like_status').innerText = 'Liked';
                    like_count.innerText = ++count;
                }  
            });
        }, {'once': true})
    }
})