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
    function htmlEncode(input) {
        const textArea = document.createElement("textarea");
        textArea.innerText = input;
        return textArea.innerHTML.split("<br>").join("\n");
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
            const like_status = current.querySelector('.like_status');
            const like_count = this.querySelector('.like_count');
            let count = like_count.innerText;
            count = parseInt(count);
            let post_id = like_count.id;
            let likers = this.getAttribute('value');
            let new_stat = 'Liked';
            if(like_status.innerText === 'Liked'){
                new_stat = 'Like'
                count -= 1;
                likers = likers.split(',');
                var index = likers.indexOf(users_email);
                if (index !== -1) {
                    likers.splice(index, 1);
                }
            } else {
                count++;
                likers = likers + users_email + ',';
            }
            sendRequest('./post/scripts/like.php', `like=${count}&post_id=${post_id}&likers=${likers}`, function(res){
                if(res != 1){
                    alert(res);
                } else {
                    current.querySelector('.like_status').innerText = new_stat;
                    like_count.innerText = count;
                }  
            });
        })
    }
    const comment_btns = document.querySelectorAll('#comment_btn');
    for(let i = 0; i < comment_btns.length; i++){
        let current = comment_btns[i];
        const post_id = current.getAttribute('value');
        const parent_post = document.getElementById(post_id);
        const comment_writer = parent_post.querySelector('.comment_writer');
        current.addEventListener('click', function(){
            if(comment_writer.classList.contains('invisible')){
                comment_writer.classList.remove('invisible');
            } else {
                comment_writer.classList.add('invisible');
            }
        })
        const comment_form = parent_post.querySelector('.comment_form');
        const comments_div = parent_post.querySelector('.comments');
        const comment_text = comment_form.querySelector('.comment_text')
        comment_form.addEventListener('submit', function(e){
            e.preventDefault();
            let text = comment_text.value.trim();
            if(text !== ''){
                let date = getFormattedDate();
                sendRequest('./post/scripts/comment.php', `comment=${encodeURIComponent(text)}&post_id=${post_id}&date=${date}&name=${encodeURIComponent(users_name)}&email=${encodeURIComponent(users_email)}`, function(res){
                    if(res != 1){
                        alert(res)
                    } else {
                        let comment_str = `
                        <div class="comment">
                            <img src="./resources/default.png" width="70" height="50" class="post_profile_pic">
                            <div class="comment_main">
                                <span class="comment_name blue-text">${users_name}</span>
                                <span>${htmlEncode(text)}</span>
                                <span class="comment_date">at ${date}</span>
                            </div>
                        </div>
                        `;
                        comments_div.innerHTML = comment_str + comments_div.innerHTML;
                        comment_writer.classList.add('invisible');
                        comment_text.value = '';
                    }
                })
            } 
        })
    }
})