document.addEventListener('DOMContentLoaded', function(){
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
    const friend_btn = document.getElementById('friend_btn');
    const my_email = document.getElementById('my_email').value.trim();
    const profiles_email = document.getElementById('profiles_email').innerText.trim();
    const profile_name = document.getElementById('profiles_name').innerText.toLowerCase();
    friend_btn.addEventListener('click', function(){
        let text = friend_btn.innerText.trim();
        if(text === 'Unfriend'){
            sendRequest('../friends/scripts/friender.php', `remove=1&email=${my_email}&friend_email=${profiles_email}`, function(res){
                if(res != 1){
                    alert(res);
                } else {
                    friend_btn.innerText = 'Add as friend';
                }
            })
        } else {
            sendRequest('../friends/scripts/friender.php', `add=1&email=${my_email}&friend_email=${profiles_email}&friend_name=${profile_name}`, function(res){
                if(res != 1){
                    alert(res);
                } else {
                    friend_btn.innerText = 'Unfriend';
                }
            })
        }
    })
})