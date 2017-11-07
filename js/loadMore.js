var views = document.getElementById('views');
var loadMoreButton = document.getElementById('load-more');

var modal = document.getElementById('modal');
var imgModal = document.getElementById('img-modal');

var last = null;

function loadMore(lastIdMontage, imgPerPages) {
    if (last != null) {
        lastIdMontage = last;
    }

    var xhr = new XMLHTTPRequest();
    xhr.open("POST", "./forms/get_montage.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
            if (xhr.responseText == "KO")
                return;
        }
        var responseJSON = JSON.parse(xhr.responseText);
        last = responseJSON[responseJSON.length - 1]['id'];

        for (let i = 0; responseJSON[i]; i++) {
            var div = document.createElement("div");
            var lol = escapeHtml

            var commentToHTML = "";
            for (let j = 0; responseJSON[i]['comments'] != null && responseJSON[i]['comments'][j] != null; j++)
                commentToHTML += "<span class=\"comment\">" + escapeHtml(responseJSON[i]['comments'][j]['username'])
        }
    }
}
