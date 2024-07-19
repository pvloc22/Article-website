var xmlHttp;
function CreateXMLHttpRequest() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        return new XMLHttpRequest()
    }
    else if (window.ActiveXObject) {
        // code for IE6, IE5
        return new ActiveXObject("Microsoft.XMLHTTP")
    }
}

function searchPaper(curentPage = 1) {
    xmlHttp = CreateXMLHttpRequest();

    xmlHttp.onreadystatechange = showResult;

    var keyword = document.getElementById('keyword').value;
    var serverURL = 'index.php?action=search&q=' + encodeURI(keyword) + "&page=" + curentPage +"&t=" + (new Date()).getTime();

    //var serverURL = 'AJAX.php?q=' + keyword	+ "&t=" + (new Date()).getTime();

    xmlHttp.open("get", serverURL, true);

    xmlHttp.send(null);
}

function filter() {
    xmlHttp = CreateXMLHttpRequest();

    xmlHttp.onreadystatechange = showResult;

    var keyword = document.getElementById('keyword').value;
    var serverURL = 'index.php?action=search&q=' + encodeURI(keyword) + "&t=" + (new Date()).getTime();

    //var serverURL = 'AJAX.php?q=' + keyword	+ "&t=" + (new Date()).getTime();

    xmlHttp.open("get", serverURL, true);

    xmlHttp.send(null);
}
//search
function showResult(curentPage = 1) {

    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        var kq = xmlHttp.responseText;
        // Lấy phần tử main
        var mainElement = document.querySelector("main");

        // Xóa tất cả các phần tử con của main
        while (mainElement.firstChild) {
            mainElement.removeChild(mainElement.firstChild);
        }
        console.log(kq);
        var showBodyDiv = document.createElement("div");
        showBodyDiv.id = "showBody"

        showBodyDiv.innerHTML = kq;
        document.querySelector("main").appendChild(showBodyDiv);
        // change css
        document.getElementById('css-decorate').href = "view/css/search.css";
    }
}
