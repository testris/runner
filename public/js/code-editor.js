$(document).ready(function() {
    var config = {
        lineNumbers: true,
        matchBrackets: true,
        styleActiveLine: true,
        mode: "xml"
    };

    var inputs = document.getElementsByClassName("code-editor");

    for (var i = 0, len = inputs.length; i < len; i++) {
        CodeMirror.fromTextArea(inputs[i], config);
    }
});