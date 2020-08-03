function copyLogLink() {
    /* Get the text field */
    var copyText = document.getElementById("buttonToCopy");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");
}