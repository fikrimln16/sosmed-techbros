const textarea = document.querySelector("textarea");

textarea.addEventListener("keyup", (e) => {
    textarea.style.height = `auto`;
    let scheight = e.target.scrollHeight;
    textarea.style.height = `${scheight}px`;
});

const area = document.getElementById("commentTextarea");
const counter = document.getElementById("charCounter");
const submit_btn = document.getElementById("submit-button");

area.addEventListener("input", function () {
    const remainingChars = 480 - area.value.length;
    counter.textContent = remainingChars;

    if (remainingChars < 0) {
        submit_btn.disabled = true;
    } else {
        submit_btn.disabled = false;
    }
});

const postTextArea = document.getElementById("postTextArea");
const postCharCounter = document.getElementById("postCharCounter");
const postSubmitButton = document.getElementById("postSubmitButton");

postTextArea.addEventListener("input", function () {
    const remainingChars = 480 - postTextArea.value.length;
    postCharCounter.textContent = remainingChars;

    if (remainingChars < 0) {
        postSubmitButton.disabled = true;
    } else {
        postSubmitButton.disabled = false;
    }
});
