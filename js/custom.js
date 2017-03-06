function checkEmail() {
    var email = document.getElementById("email");
    var email2 = document.getElementById("email2");
    var submit = document.getElementById("submit");
    var group = document.getElementById("wrongEmailControl");
    
    var checkForPass = document.getElementById("passFeedback");
    
    if(email2.value != email.value){
        submit.setAttribute('disabled', 'disabled');
        group.setAttribute("class", "form-group form-inline has-danger");
        email2.setAttribute("class", "form-control form-control-danger");
        $("#email2Feedback").remove();
        $("<div id=\"email2Feedback\" class=\"form-control-feedback\">Podane emaile nie są takie same!</div>").insertAfter("#email2");
    }
    else{
        if(checkForPass == null)
            submit.removeAttribute('disabled');
        group.setAttribute("class", "form-group form-inline");
        email2.setAttribute("class", "form-control");
        $("#email2Feedback").remove();
    }
}

function checkPass(){
    var pass = document.getElementById("password");
    var passHelp = document.getElementById("passwordHelpInline");
    var passGroup = document.getElementById("passControl");
    var submit = document.getElementById("submit");
    
    var checkForEmail = document.getElementById("email2Feedback");
    
    if(pass.value.length < 7 || pass.value.length > 20){
        submit.setAttribute('disabled', 'disabled');
        pass.setAttribute("class", "form-control form-control-warning");
        $("#passFeedback").remove();
        $("<div id=\"passFeedback\" class=\"form-control-feedback\">Błędna długość hasła!</div>").insertAfter("#password");
        passGroup.setAttribute("class", "form-group form-inline has-warning");
    }
    else{
        pass.setAttribute("class", "form-control");
        $("#passFeedback").remove();
        passGroup.setAttribute("class", "form-group form-inline");
        if(checkForEmail == null)
            submit.removeAttribute('disabled');
    }
}

$( "#clear" ).click(function() {
    var email = document.getElementById("email");
    var email2 = document.getElementById("email2");
    var submit = document.getElementById("submit");
    var group = document.getElementById("wrongEmailControl");
    var pass = document.getElementById("password");
    var passHelp = document.getElementById("passwordHelpInline");
    var passGroup = document.getElementById("passControl");
    var submit = document.getElementById("submit");

    submit.removeAttribute('disabled');
    group.setAttribute("class", "form-group form-inline");
    email2.setAttribute("class", "form-control");
    $("#email2Feedback").remove();
    pass.setAttribute("class", "form-control");
    $("#passFeedback").remove();
    passGroup.setAttribute("class", "form-group form-inline");
});

function remove_user(obj) {
    document.getElementById("confirmModalBody").innerHTML = '<p class="text-center">Czy na pewno chcesz usunąć użytwkonika <span id="user-name-remove" class="text-danger font-weight-bold"></span>?</p>';
    document.getElementById("confirmModalForm").innerHTML = '<input id="userToRemove" name="userToRemove" value="" type="hidden"><button type="submit" name="removeUser" class="btn btn-danger">Usuń</button>';
    document.getElementById("user-name-remove").innerHTML = $(obj).attr("value");
    document.getElementById("userToRemove").value = $(obj).attr("value");
}

function activate_user(obj){
    document.getElementById("confirmModalBody").innerHTML = '<p class="text-center">Czy na pewno chcesz aktywować użytwkonika <span id="user-name-activate" class="text-success font-weight-bold"></span>?</p>';
    document.getElementById("confirmModalForm").innerHTML = '<input id="userToActivate" name="userToActivate" value="" type="hidden"><button type="submit" name="activateUser" class="btn btn-success">Aktywuj</button>';
    document.getElementById("user-name-activate").innerHTML = $(obj).attr("value");
    document.getElementById("userToActivate").value = $(obj).attr("value");
}