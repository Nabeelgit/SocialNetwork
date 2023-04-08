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
    function removeNote(){
        this.remove();
        sendRequest('./scripts/notes.php', `remove=1&note=${encodeURIComponent(this.innerText.trim())}&email=${email}`, function(res){
            if(res != 1){
                alert(res)
            }
        })
    }
    const notes = document.querySelectorAll('.note');
    notes.forEach((note) => {
        note.addEventListener('click', removeNote);
    });
    const email = document.getElementById('email').value;
    const notes_div = document.querySelector('.notes');
    const note_writer = document.querySelector('.note_writer');
    const note_input = document.getElementById('note_input');
    note_writer.addEventListener('submit', function(e){
        e.preventDefault();
        let text = note_input.value.trim();
        if(text !== ''){
            let div = document.createElement('div');
            div.setAttribute('class', 'note');
            div.innerText = text;
            div.addEventListener('click', removeNote)
            notes_div.append(div);
            note_input.value = '';
            sendRequest('./scripts/notes.php', `add=1&note=${encodeURIComponent(text)}&email=${email}`, function(res){
                if(res != 1){
                    alert(res)
                }
            })
        }
    })
})