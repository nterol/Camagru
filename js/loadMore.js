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
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.res)
    }
}
