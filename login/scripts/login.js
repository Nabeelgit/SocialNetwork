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
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const warning = document.querySelector('p.warning');
    const form = document.querySelector('.forms .inputs');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        const values = {
            email: email.value.trim(),
            password: password.value.trim()
        };
        if(values.email !== '' && values.password !== ''){
            sendRequest('./scripts/login.php', 'email='+encodeURIComponent(values.email)+'&password='+encodeURIComponent(values.password), function(res){
                if(res == 1){
                    warning.style.display = 'block';
                    warning.innerText = 'Incorrect username or password';
                } else {
                    warning.style.display = 'none';
                    warning.innerText = '';
                    form.submit();
                }
            })
        }
    });
})