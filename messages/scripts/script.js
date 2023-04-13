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
    const my_email = document.getElementById('my_email').value;
    const my_name = document.getElementById('my_name').value;
    const message_box = document.querySelector('.message_box');
    const header_info_name = document.querySelector('#header_info .person_name');
    const recipient_info = {};
    const messages_div = document.querySelector('.messages');
    function loadMessages(){
        sendRequest('./scripts/getMessages.php', `email=${my_email}&recipient=${recipient_info['email']}`, function(res){
            messages_div.innerHTML = res;
        });
    }
    let messages_load_interval = null;
    let newMessage = document.getElementById('recipient_email');
    if(newMessage !== null){
        recipient_info['email'] = newMessage.value;
        recipient_info['name'] = header_info_name.innerText;
        loadMessages();
        window.history.pushState({}, document.title, window.location.pathname);
    }
    const header_info_status = document.querySelector('#header_info .activity_circle');
    const people = document.querySelectorAll('.person');
    for(let i = 0; i < people.length; i++){
        let person = people[i];
        person.addEventListener('click', function(){
            message_box.classList.remove('invisible');
            recipient_info['email'] = person.querySelector('.person_info .person_email').innerText;
            recipient_info['name'] = person.querySelector('.person_info .person_name').innerText;
            header_info_name.innerText = recipient_info['name'];
            sendRequest('./scripts/getStatus.php', `email=${recipient_info['email']}`, function(res){
                let color = '#f31919';
                if(res === 'online'){
                    color = '#20bf20';
                }
                header_info_status.style.backgroundColor = color;
            })
            loadMessages();
            if(messages_load_interval === null){
                messages_load_interval = setInterval(loadMessages, 500)
            }
        })
    }
    const message_form = document.querySelector('.message_sender');
    const message_input = document.querySelector('.message_input')
    message_form.addEventListener('submit', function(e){
        e.preventDefault();
        let text = message_input.value.trim();
        if(text !== ''){
            let date = getFormattedDate();
            sendRequest('./scripts/message.php', `message=${encodeURIComponent(text)}&my_email=${my_email}&recipient=${recipient_info['email']}&recipient_name=${recipient_info['name']}&my_name=${my_name}&time=${date}`, function(res){
                if(res != 1){
                    alert(res)
                } else {
                    message_input.value = '';
                    loadMessages();
                }
            })
        }
    })
})