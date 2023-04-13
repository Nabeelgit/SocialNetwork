function sendRequest(to, body){
    const xml = new XMLHttpRequest();
    xml.open('POST', to, true);
    xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xml.send(body)
}
const dir = window.location.origin + '/SocialNetwork/';
document.addEventListener('DOMContentLoaded', function(){
    sendRequest(dir+'resources/status_updater.php', 'update=online');
})
window.addEventListener('beforeunload', function(){
    sendRequest(dir+'resources/status_updater.php', 'update=offline');
})