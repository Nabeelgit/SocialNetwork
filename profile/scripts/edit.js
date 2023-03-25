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
    // get default values
    let def_vals = {};
    const def_info_divs = document.querySelectorAll('#def_info .info');
    for(let i = 0; i < def_info_divs.length; i++){
        let div = def_info_divs[i];
        if(div.id){
            let this_id = div.id.split('_def')[0];
            def_vals[this_id] = div.innerText;
        }
    }
    // add birthday seperately
    def_vals['birthday'] = document.querySelector('.birthdayDef').getAttribute('value');
    const edit_div = document.querySelector('.edit-div');
    const edit_div_infos = document.querySelectorAll('.edit-div .info');
    let edit_vals = {};
    document.getElementById('editable').addEventListener('click', function(){
        edit_div.style.display = 'block';
        for(let i = 0; i < edit_div_infos.length; i++){
            let item = edit_div_infos[i].children[0];
            let event_type = 'input'
            if(item.tagName === 'SELECT'){
                event_type = 'change';
            }
            item.addEventListener(event_type, function(){
                let this_id = item.id.split('_edit')[0];
                edit_vals[this_id] = item.value;
            })
        }
    });
    const email = document.querySelector('.emailInfo').innerText;
    document.getElementById('save-edit').addEventListener('click', function(){
        let keys = Object.keys(edit_vals);
        if(keys.length !== 0){
            let req_str = 'email='+encodeURIComponent(email);
            for(let i = 0; i < keys.length; i++){
                let key = keys[i];
                let val = edit_vals[key];
                req_str += `&${key}=${encodeURIComponent(val)}`;
            }
            sendRequest('./scripts/edit.php', req_str, function(res){
                if(res == 1){
                    window.location.reload();
                } else {
                    alert('An error occured... Please try again later')
                }
            })
        } else {
            edit_div.style.display = 'none';
        }
    })
    document.getElementById('close-edit').addEventListener('click', function(){
        edit_div.style.display = 'none';
    })
})