function terms_changed(termsCheckBox) {
    if (termsCheckBox.checked) {
        document.getElementById("submit_button").disabled = false;
    } else {
        document.getElementById("submit_button").disabled = true;
    }

    if (termsCheckBox.checked) {
        document.getElementById("submit_button-register").disabled = false;
    } else {
        document.getElementById("submit_button-register").disabled = true;
    }
}
