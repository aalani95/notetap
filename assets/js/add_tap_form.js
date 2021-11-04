// add notetap form js
const form = document.getElementById("notetap_form"); // form
const addTitle = document.getElementById("add_title"); // tap title field
const taAddContent = document.getElementById("add_content"); // content textarea
const formToggle = document.getElementById("add_tap_toggle"); // form toggle reveal
const publishButton = document.getElementById("notetap_form_submit"); // "Publish Tap" button

// form textarea and footer toggle
url = new URL(window.location.href);
if (url.searchParams.get('results')) {
    toggleReveal();
}

addTitle.addEventListener("click", toggleReveal);

function toggleReveal() {
    formToggle.style.display = "block";
    addTitle.style.boxShadow = "none";
    addTitle.placeholder = "Title"
}

// textarea height auto grow
taAddContent.setAttribute("style", "height:" + (taAddContent.scrollHeight) + "px;overflow-y:hidden;");
taAddContent.addEventListener("input", OnInput, false);

function OnInput() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
}

// submit form on button click
publishButton.addEventListener("click", function () {
    form.submit();
});



