// remove taps dynamic link
const trash = tapActions[0];

trash.addEventListener("click", trashTap);

function trashTap() {
    location.href = "process_deletetap.php?trash=" + tapId.innerText;
}