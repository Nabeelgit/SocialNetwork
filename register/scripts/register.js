document.addEventListener('DOMContentLoaded', function(){
    function matchesConditions(password){
        return password.length > 3;
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
    // Select all inputs + option field
    const name = document.getElementById('name'); 
    const status = document.getElementById('status');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const retyped_password = document.getElementById('repassword');
    const termCheck = document.getElementById('termsCheck');
    const warning = document.querySelector('.warning');
    const form = document.getElementById('register-form');
    const inputs_to_check = [['Name', name], ['Email', email], ['Password', password], ['Retyped password', retyped_password]];
    form.addEventListener('submit', function(e){
        e.preventDefault();
        const values = {
            name: name.value.trim().toLowerCase(),
            status: status.value,
            email: email.value.trim(),
            password: password.value.trim()
        }
        let failed_tests = false;
        let i = 0;
        while(i < 1){
            for(let j = 0; j < inputs_to_check.length; j++){
                if(inputs_to_check[j][1].value.trim() === ''){
                    failed_tests = true;
                    warning.style.display = 'block';
                    warning.innerText = inputs_to_check[j][0] + ' must be filled out!';
                    break;
                } else {
                    warning.style.display = 'none';
                    warning.innerText = '';
                }
            }
            if(failed_tests) break;
            if(!matchesConditions(values.password)){
                warning.style.display = 'block';
                warning.innerText = 'Password has to be more than 3 characters!';
                failed_tests = true;
                break;
            } else {
                warning.style.display = 'none';
                warning.innerText = '';
            }
            if(!termCheck.checked){
                warning.style.display = 'block';
                warning.innerText = 'You must agree to terms and conditions!';
                failed_tests = true;
                break;
            } else {
                warning.style.display = 'none';
                warning.innerText = '';
            }
            if(values.password !== retyped_password.value.trim()){
                warning.style.display = 'block';
                warning.innerText = 'Passwords do not match';
                failed_tests = true;
                break;
            } else {
                warning.style.display = 'none';
                warning.innerText = '';
            }
            i++;
        }
        if(!failed_tests){
            // check if name and email exists in db
            let req_uri = 'email='+encodeURIComponent(values.email);
            sendRequest('./scripts/doublechecker.php', req_uri, function(res){
                if(res){
                    warning.style.display = 'block';
                    warning.innerText = 'Someone has already registered with this email!';
                    failed_tests = true;
                } else {
                    warning.style.display = 'none';
                    warning.innerText = '';
                    // store in db
                    req_uri += '&name='+encodeURIComponent(values.name)+'&status='+encodeURIComponent(values.status)+'&password='+encodeURIComponent(values.password);
                    sendRequest('./scripts/register.php', req_uri, function(res){
                        if(res !== true){
                            console.log('ok');  
                            warning.style.display = 'none';
                            warning.innerText = '';
                            form.submit();
                        } else {
                            warning.style.display = 'block';
                            warning.innerText = res;
                        }
                    });
                }
            });
        }
    })
})