/*
    * This file contains all the basic functions
    * which are required while working on TECHNICAL QUIZZES.
*/

// To Show and Hide the basic menu 
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function showAndHide(showParam, hideParam)
{
    //Hiding un-neccessary objects
    var hide = document.getElementById('I-details');
    if(hide != null)
    {
        hide.style.display = "none"; 
    }
    
    hide = document.getElementById(hideParam);
    if(hide != null)
    {
        hide.style.display = "none"; 
    }
    else
    {
        alert("Can't perform this action.");
        return false;
    }

    //Displaying required objects
    show = document.getElementById(showParam);
    if(show != null)
    {
        let value = show.style.display;
        if(value == "" || value == "none")
        {
            value = "block";
        }
        else
        {
            value = "none";
        }
        show.style.display = value; 
    }
    else
    {
        alert("Can't perform this action.");
        return false;
    }
    return true;
}

// To show the menu options useful for user
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function showUserDetails()
{
    //Hiding un-neccessary objects
    var menu = document.getElementById('I-menu');
    var categories = document.getElementById('I-categories');
    if(menu == null || categories == null)
    {
        return false;
    }
    menu.style.display = "none";
    categories.style.display = "none";

    //Displaying required objects
    details = document.getElementById('I-details');
    if(details == null)
    {
        return false;
    }
    var status = details.style.display;
    if(status == "block")
    {
        details.style.display = "none";
    }
    else
    {
        details.style.display = "block";
    }
    return true;
}

// To Validate username that has been Entered as input
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function validateUserName(name, correct, incorrect, nameError)
{
    // Fetching all required objects
    var username = document.getElementById(name);
    var userIconCorrect = document.getElementById(correct);
    var userIconInCorrect = document.getElementById(incorrect);
    var usernameError = document.getElementById(nameError);
    if(username == null || userIconCorrect == null || userIconInCorrect == null || usernameError == null)
    {
        return false;
    }

    // Initialization
    usernameError.style.display = "none";
    var name = username.value;
    username.style.border = "0.4rem solid red";
    userIconCorrect.style.display = "none";
    userIconInCorrect.style.display = "inline";

    // Validating for different scenarios
    if(name == "")
    {
        usernameError.style.display = "block";
        usernameError.innerHTML = "<p style='color:red; font-weight:400'>This field is required.</p>";
        return false;
    }
    else if(name.length >= 50)
    {
        usernameError.style.display = "block";
        usernameError.innerHTML = "<p style='color:red; font-weight:400'>Name too long.</p>";
        return false;
    }
    else if(!((name[0] >= 'a' && name[0] <= 'z') || (name[0] >= 'A' && name[0] <= 'Z')))
    {
        usernameError.style.display = "block";
        usernameError.innerHTML = "<p style='color:red;font-weight:600'>Invalid Name.</p>";
        return false;
    }
    else if(name.length < 4)
    {
        usernameError.style.display = "block";
        usernameError.innerHTML = "<p style='color:red;font-weight:600'>Name too short.</p>";
        return false;
    }
    var index = 1;
    while(index < name.length)
    {
        if(!(name[index] >= 'a' && name[index] <= 'z') && !(name[index] >= 'A' && name[index] <= 'Z') && !(name[index] >= '0' && name[index] <= '9') && name[index] != '_')
        {
            usernameError.style.display = "block";
            usernameError.innerHTML = "<p style='color:red;font-weight:600'>Invalid Symbol (" + name[index] + ")</p>";
            return false;
        }
        index++;
    }

    // Verified successfully
    userIconInCorrect.style.display = "none";
    username.style.border = "0.4rem solid green";
    userIconCorrect.style.display = "inline";
    return true;
}

// To Validate password that has been Entered as input
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function validatePassword()
{  
    // Fetching all required objects
    var password = document.getElementById('password');
    var passIconCorrect = document.getElementById('correctPassword');
    var passIconInCorrect = document.getElementById('incorrectPassword');
    var passwordError = document.getElementById('passwordError');
    if(password == null || passIconCorrect == null || passIconInCorrect == null || passwordError == null)
    {
        return false;
    }

    // Initailization
    passwordError.style.display = "none";
    var pass = password.value;
    password.style.border = "0.4rem solid red";
    passIconCorrect.style.display = "none";
    passIconInCorrect.style.display = "inline";

    // Validating for different Scenarios
    if(pass == "")
    {
        passwordError.style.display = "block";
        passwordError.innerHTML = "<p style='color:red; font-weight:400'>This field is required.</p>";
        return false;
    }
    if(pass.length >= 20)
    {
        passwordError.style.display = "block";
        passwordError.innerHTML = "<p style='color:red; font-weight:400'>Password is too long.</p>";
        return false;
    }
    if(pass.length < 8)
    {
        passwordError.style.display = "block";
        passwordError.innerHTML = "<p style='color:red; font-weight:400'>Password is too short.</p>";
        return false;
    }
    var index = 0;
    flagSym = false;
    flagAlpha = false;
    flagDigit = false;
    while(index < pass.length)
    {
        if((pass[index] >= 'a' && pass[index] <= 'z') || (pass[index] >= 'A' && pass[index] <= 'Z'))
        {
            flagAlpha = true;
        }
        else if(pass[index] >= '0' && pass[index] <= '9')
        {
            flagDigit = true;
        }
        else
        {
            flagSym = true;
        }
        index++;
    }
    if(flagAlpha != true || flagDigit != true || flagSym != true)
    {
        passwordError.style.display = "block";
        passwordError.innerHTML = "<p style='color:red; font-weight:400'>Weak Password</p>";
        return false;
    }

    // Verified successfully
    passIconInCorrect.style.display = "none";
    password.style.border = "0.4rem solid green";
    passIconCorrect.style.display = "inline";   
    return true;
}

// To Validate email address that has been Entered as input
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function validateEmail()
{
    // Fetching all required objects
    var emailId = document.getElementById('emailId');
    var emailIconCorrect = document.getElementById('correctEmail');
    var emailIconInCorrect = document.getElementById('incorrectEmail');
    var emailError = document.getElementById('emailError');
    if(emailId == null || emailIconCorrect == null || emailIconInCorrect == null || emailError == null)
    {
        return false;
    }

    // Initialization
    emailError.style.display = "none";
    emailIconCorrect.style.display = "none";
    var email = emailId.value;
    emailIconInCorrect.style.display = "inline";
    emailId.style.border = "0.4rem solid red";

    // Validating for different Scenarios
    if(email == "")
    {
        emailError.style.display = "block";
        emailError.innerHTML = "<p style='color:red; font-weight:400'>This field is required.</p>";
        return false;
    }
    else if(email.lenght >= 90)
    {
        emailError.style.display = "block";
        emailError.innerHTML = "<p style='color:red; font-weight:400'>Email too long.</p>";
        return false;
    }
    else if(email.length <= 12 || !email.endsWith("@gmail.com"))
    {
        emailError.style.display = "block";
        emailError.innerHTML = "<p style='color:red; font-weight:400'>Invalid email</p>";
        return false;
    }

    // Verified successfully
    emailIconInCorrect.style.display = "none";
    emailId.style.borderColor = "green";
    emailIconCorrect.style.display = "inline";
    return true;
}

// To validate new password and confirm password both are same
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function validate()
{
    validatePassword();

    // Fetching all objects
    var Password = document.getElementById('password');
    var newPassword = document.getElementById('new_password');
    var correctPassword = document.getElementById('correctNewPass');
    var incorrectPassword = document.getElementById('incorrectNewPass');
    var passwordError = document.getElementById('newPasswordError');
    if(Password == null || newPassword == null && correctPassword == null && incorrectPassword == null || passwordError == null)
    {
        return false;
    }

    // Matching .....
    var newPass = newPassword.value;
    var Pass = Password.value;
    if(newPass != Pass)
    {
        newPassword.style.border = "0.4rem solid red";
        incorrectPassword.style.display = "inline";
        correctPassword.style.display = "none";
        passwordError.style.display = "inline";
        passwordError.innerHTML = "<p style='color: red; font-weight: 400'>Password doesn't match</p>";
        return false;
    }

    // Matched .....
    passwordError.style.display = "none";
    newPassword.style.borderColor = "green";
    incorrectPassword.style.display = "none";
    correctPassword.style.display = "inline";
    return true;
}

// To show and hide the password
/*
    * Return value -->
            1) success --> true
            2) failure --> false
*/
function showPassword(passText, show, hide)
{
    var textEle = document.getElementById(passText);
    var showicon =  document.getElementById(show);
    var hideicon = document.getElementById(hide);
    if(textEle != null && showicon != null && hideicon != null)
    {
        var statusText = textEle.type;
        if(statusText == "password")
        {
            textEle.type = "text";
            hideicon.style.display = "none";
            showicon.style.display = "inline";
        }
        else
        {
            textEle.type = "password";
            showicon.style.display = "none";
            hideicon.style.display = "inline";
        }
        return true;
    }
    return false;
}

// To view the uploaded file 
function fileUpload()
{
    input_img = document.getElementById('image_input');
    uploaded_img = document.getElementById('image_uploaded');
    if(input_img == null || uploaded_img == null)
    {
        alert('Unknown Error Occurred');
        return;
    }
    input_img.style.display = "none";
    uploaded_img.style.display = "inline-block";
    uploaded_img.src = window.URL.createObjectURL(document.getElementById('file').files[0]);
}

// To Reset the uploaded file
function resetFile($name)
{
    input_img = document.getElementById('image_input');
    uploaded_img = document.getElementById('image_uploaded');
    if(input_img == null || uploaded_img == null)
    {
        alert('Unknown Error Occurred');
        return;
    }
    input_img.src =  '../user_profile/' + $name;
    uploaded_img.style.display = 'none';
    input_img.style.display = 'inline-block';
}

// Ask user to confirm a particular action
function confirmAction(msg, target_link)
{
    if(confirm(msg))
    {
        window.location.href = target_link;
    }
}

// To change the background images 
function changeImage()
{
    var itr = 0;
    var bg = document.getElementsByClassName('bg');
    if(bg == null)
    {
        return;
    }
    bg[0].style.display = "none";
    bg[1].style.display = "none";
    bg[2].style.display = "none";
    bg[3].style.display = "none";

    if(sessionStorage.getItem('itr'))
    {
        itr = Number(sessionStorage.getItem('itr')) + 1;
        if(itr >= 4)
        {
            itr = 0;
        }
        sessionStorage.setItem('itr', itr);
    }
    else
    {
        sessionStorage.setItem('itr', 0);
    }
    bg[itr].style.display = "block";
}