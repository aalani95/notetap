// open notetaps to pupup on click
const pressedTap = document.querySelectorAll("article.tap"); // taps
const tapPopup = document.getElementById("tap_open"); // popup container
let tempT;
let tempC;

for (let i = 0; i < pressedTap.length; i++) {
    pressedTap[i].addEventListener("click", opendTapContent);
    pressedTap[i].addEventListener("click", tempIDs);
    pressedTap[i].addEventListener("click", tapOpen);
    pressedTap[i].addEventListener("click", tapContentHeight);
}

// opened tap popup content

// tap variables
const tapId = document.getElementById("tap_popup_id"); // tap ID
const tapTitle = document.getElementById("tap_popup_title"); //title
const tapContent = document.getElementById("tap_popup_content"); // full content
const tapDate = document.getElementById("tap_popup_timestamp"); // date and time
const tapScrollOverlay = document.getElementById("tap_content_scroll"); // scroll indicator overlay

// tap variables dynamic content
function opendTapContent() {
    tapId.innerText = this.getElementsByClassName("tap_id")[0].innerText;
    tapTitle.innerText = this.getElementsByClassName("tap_title")[0].innerText;
    tapContent.innerText = this.getElementsByClassName("tap_content_full")[0].innerText;
    tapDate.innerText = this.getElementsByClassName("tap_timestamp")[0].innerText;
}

function tempIDs() {
    this.getElementsByClassName("tap_title")[0].id = "tempT";
    this.getElementsByClassName("tap_content")[0].id = "tempC";
    tempT = document.getElementById("tempT");
    tempC = document.getElementById("tempC");
}

// open tap popup
function tapOpen() {
    tapPopup.style.display = "flex";
    document.getElementsByTagName("html")[0].style.overflow = "hidden";
}

// check tapContent height - if there's a scroll then show overlay
function tapContentHeight() {
    let contentHeight = tapContent;

    if (contentHeight.scrollHeight > contentHeight.clientHeight) {
        tapScrollOverlay.style.display = "block";
    }
}

// determine if the tapContent is fully scrolled to remove scroll overlay
tapContent.addEventListener('scroll', function () {
    if (tapContent.scrollHeight - tapContent.scrollTop - tapContent.clientHeight < 1) {
        tapScrollOverlay.style.display = "none";
    }
});


// close tap popp on X click
const tapActions = document.getElementsByClassName("tap_popup_handle");

tapActions[2].addEventListener("click", tapClose);
tapActions[2].addEventListener("click", removeTempIDs);

function tapClose() {
    tapPopup.style.display = "none";
    document.getElementsByTagName("html")[0].style.overflow = "auto";

    // reset editor state changes ref: edit_tap.js
    tapEdit.style.display = "block";
    formEdit.form.style.display = "none";
}

function removeTempIDs() {
    tempT.removeAttribute("id");
    tempC.removeAttribute("id");
}