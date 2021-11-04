// edit taps on pen link
const edit = tapActions[1];
const tapEdit = document.getElementById('tap_popup_tap');
const formEdit = {
    form: document.getElementById('edit_notetap_form'),
    id: document.getElementById('edit_id'),
    title: document.getElementById('edit_title'),
    content: document.getElementById('edit_content'),
    submit: document.getElementById('edit_notetap_form_submit'),
};

const editNoti = {
    ele: document.getElementById("edit_tap_noti"),
    success: '<span class="process_tap_success">Changes Published 👋</span>',
    fail: '<span class="process_tap_error">☝️ Make sure title and content fields are not empty</span>'
};

edit.addEventListener("click", showForm);
edit.addEventListener("click", formValues);

function showForm() {
    tapEdit.style.display = "none";
    formEdit.form.style.display = "block";
    formEdit.title.focus();
}

function formValues() {
    formEdit.title.value = tapTitle.innerText;
    formEdit.content.value = tapContent.innerText;
    formEdit.id.value = tapId.innerText;
}


formEdit.submit.addEventListener('click', hideForm);

function hideForm() {
    tapEdit.style.display = "block";
    formEdit.form.style.display = "none";
}

// AJAX submit edit request
formEdit.submit.addEventListener('click', () => {
    const editRequest = new XMLHttpRequest();

    editRequest.onload = () => {
        let responseObject = null;

        // parse JSON respons from 'process_edittap.php'
        try {
            responseObject = JSON.parse(editRequest.responseText);
        } catch (e) {
            alert('Error processing your request, try again later!');
        }

        if (responseObject) {
            handleResponse(responseObject);
        }
    };

    const requestData = `id=${formEdit.id.value}&title=${formEdit.title.value}&content=${formEdit.content.value}`;

    editRequest.open('post', 'process_edittap.php');
    editRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    editRequest.send(requestData);
});

// handle JSON data
function handleResponse (responseObject) {
    if (responseObject.status) {

        // editted tap new content
        tapTitle.innerText = responseObject.title;
        tempT.innerText = responseObject.title;
        tapContent.innerText = responseObject.content;
        tempC.innerText = responseObject.content;

        // success notification
        editNoti.ele.innerHTML = editNoti.success;

        // clear notification
        setTimeout(function(){ 
            editNoti.ele.innerHTML = ''; 
        }, 5000);

    } else {
        // failed notification (typically empty fields)
        editNoti.ele.innerHTML = editNoti.fail;

        // clear notification
        setTimeout(function(){ 
            editNoti.ele.innerHTML = ''; 
        }, 5000);
    }
}




