const m_strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const m_strLowerCase = "abcdefghijklmnopqrstuvwxyz";
const m_strNumber = "0123456789";
const m_strCharacters = "!@#$%^&*?_~";
const regexMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
const regexAlpha = /^[A-Za-z]+$/;
const regexAlphaSpace = /^[A-Za-z ]+$/;
const regexPhone = /^[789]\d{9}$/;
const regexLandline = /\d{5}([- ]*)\d{6}/;

function passStrength(password) {
    document.querySelector("#pass1str").style.display = "block";
    document.querySelector("#pass1msg").style.display = "block";
    runPassword(document.querySelector("#" + password).value);
}

const loginFormValidator = function(event) {
    if (!new RegExp(/^[A-Za-z0-9_]*$/).test(document.getElementById("username").value)) {
        toast("Invalid username..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
};

const adminLoginFormValidator = function(event) {
    if (!regexMail.test(document.getElementById("emailid").value)) {
        toast("Invalid email..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
};

const issueBookFormValidator = function(event) {
    let userId = document.getElementById('userId').value;
    let bookId = document.getElementById('bookId').value;
    if (isNaN(userId) && parseInt(userId) < 0) {
        toast("Please enter the User Name..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (isNaN(bookId) && parseInt(bookId) < 0) {
        toast("Please enter the ISBN..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById('user-condition').value == '0') {
        toast("This user can't lend a book ..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById('book-condition').value == '0') {
        toast("This book is not available to lend ..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
}

const bookFormValidator = function(event) {
    if ((document.getElementById("price").value) <= 0) {
        toast("Invalid price..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if ((document.getElementById("stack").value) <= 0) {
        toast("Invalid stack..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!new RegExp(/^[1-9]{1}[0-9,]*$/).test(document.getElementById("selected-author").value)) {
        toast("Please select Authors..!" + document.getElementById("selected-author").value, 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!new RegExp(/^[1-9]{1}[0-9,]*$/).test(document.getElementById("selected-category").value)) {
        toast("Please select categories..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("bookname").value == '') {
        toast("Please enter the book name..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("location").value == '') {
        toast("Please enter the book location..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("publication").value == '') {
        toast("Please enter the publication name..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("isbn").value == '') {
        toast("Please enter the ISBN..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!isbnValidator(document.getElementById("isbn").value)) {
        toast("Invalid ISBN..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("stack").value == '') {
        toast("Please enter the stack..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("description").value == '') {
        toast("Please enter the book's description..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("price").value == '') {
        toast("Please enter the book price..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("coverPic").value == '') {
        toast("Please select cover picture..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
};

const configValidator = function(event) {
    if (!isNaN(document.getElementById("maxbookLend").value) && parseInt(document.getElementById("maxbookLend").value) > 0) {
        toast("Invalid maximum book lend count..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!isNaN(document.getElementById("maxLendDays").value) && parseInt(document.getElementById("maxLendDays").value) > 0) {
        toast("Invalid maximum lend days..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!isNaN(document.getElementById("maxBookRequest").value) && parseInt(document.getElementById("maxBookRequest").value) > 0) {
        toast("Invalid maximum book request count..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!isNaN(document.getElementById("fineAmtPerDay").value) && parseInt(document.getElementById("fineAmtPerDay").value) > 0) {
        toast("Invalid fine amount..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
}

const cmsValidator = function(event) {
    if ((document.getElementById("aboutus").value) == '') {
        toast("Please enter aboutus contentens..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if ((document.getElementById("address").value) == '') {
        toast("Please enter the address..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if ((document.getElementById("mission").value) == '') {
        toast("Please enter the mission contents..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!regexMail.test(document.getElementById("emailid").value)) {
        toast("Please enter valid email id..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!regexLandline.test(document.getElementById("mobile").value)) {
        toast("Please enter valid phone number..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    }
}


const editBookFormValidator = function(event) {
    if ((document.getElementById("price").value) <= 0) {
        toast("Invalid price..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if ((document.getElementById("stack").value) <= 0) {
        toast("Invalid stack..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!new RegExp(/^[1-9]{1}[0-9,]*$/).test(document.getElementById("selected-author").value)) {
        toast("Please select Authors..!" + document.getElementById("selected-author").value, 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!new RegExp(/^[1-9]{1}[0-9,]*$/).test(document.getElementById("selected-category").value)) {
        toast("Please select categories..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("bookname").value == '') {
        toast("Please enter the book name..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("location").value == '') {
        toast("Please enter the book location..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("publication").value == '') {
        toast("Please enter the publication name..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("isbn").value == '') {
        toast("Please enter the ISBN..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!isbnValidator(document.getElementById("isbn").value)) {
        toast("Invalid ISBN..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("stack").value == '') {
        toast("Please enter the stack..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("description").value == '') {
        toast("Please enter the book's description..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (document.getElementById("price").value == '') {
        toast("Please enter the book price..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    }
};

const nameValidator = function(event) {
    form = new FormData(event.target);
    if (!regexAlphaSpace.test(form.get('name'))) {
        toast("Invalid name..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    }
}

const usernameValidator = function(event) {
    form = new FormData(event.target);
    if (!new RegExp(/^[A-Za-z0-9_]*$/).test(form.get('username'))) {
        toast("Invalid username..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    }
}

const registrationFormValidator = function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    if (!regexAlphaSpace.test(document.getElementById("fullname").value)) {
        toast("Invalid Name..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!new RegExp(/^[A-Za-z0-9_]*$/).test(document.getElementById("username").value)) {
        toast("Invalid username..!", 'danger', 'Invalid Input');
        event.preventDefault();
        return false;
    } else if (password.length < 6) {
        toast("Password is too short.. It should be six character long..!", 'danger', "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!regexMail.test(document.getElementById("emailid").value)) {
        toast("Invalid email..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (!regexPhone.test(document.getElementById("mobile").value)) {
        toast("Invalid mobile..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (password != confirmPassword) {
        toast("Please confirm your password..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (checkPassword(password) <= 50) {
        toast("Please select a strong Password..!", "danger", "Warning");
        event.preventDefault();
        return false;
    } else if (document.getElementById('vercode').value == '') {
        toast("Please enter captcha..!", "danger", "Input Required");
        event.preventDefault();
        return false;
    }
    return true;

}

// const categoryValidator = function(event) {
//     if (!regexAlphaSpace.test(document.getElementById("catname").value)) {
//         toast("Invalid Category Name..!", "danger", "Invalid Input");
//         event.preventDefault();
//         return false;
//     }
// }

const authorValidator = function(event) {
    if (!regexAlphaSpace.test(document.getElementById("autname").value)) {
        toast("Invalid Author Name..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    }
}

const editProfileValidator = function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    if (!regexAlphaSpace.test(document.getElementById("fullname").value)) {
        toast("Invalid Name..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (password.length < 6 && password != '') {
        toast("Password is too short.. It should be six character long..!", 'danger', 'Note');
        event.preventDefault();
        return false;
    } else if (!regexMail.test(document.getElementById("emailid").value)) {
        toast("Invalid email..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (password != confirmPassword) {
        toast("Please confirm your password..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (checkPassword(password) <= 50 && password != '') {
        toast("Please select a strong password..!", "danger", "Note");
        event.preventDefault();
        return false;
    } else if (!regexPhone.test(document.getElementById("mobile").value)) {
        toast("Invalid mobile..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    }
    // console.log 
    return true;
    // if(!validation){
    // event.preventDefault();
    // }
}


const createUserFormValidator = function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    if (!regexAlphaSpace.test(document.getElementById("fullname").value)) {
        toast("Invalid Name..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (password.length < 6) {
        toast("Password is too short.. It should be six character long..!", 'danger', 'Note');
        event.preventDefault();
        return false;
    } else if (document.getElementById('role').value == '') {
        toast("Please select the user role..!", 'danger', 'Note');
        event.preventDefault();
        return false;
    } else if (!regexMail.test(document.getElementById("email").value)) {
        toast("Invalid email..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (password != confirmPassword) {
        toast("Please confirm your password..!", "danger", "Invalid Input");
        event.preventDefault();
        return false;
    } else if (checkPassword(password) <= 50 && password != '') {
        toast("Please select a strong password..!", "danger", "Warning");
        event.preventDefault();
        return false;
    }
    // console.log 
    return true;
    // if(!validation){
    // event.preventDefault();
    // }
}

function checkUserName(event, span_id) {
    let username = event.target.value;
    fetch("user-management/users/user-name/" + username, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == false) {
                document.getElementById(span_id).innerHTML = "";
            } else {
                document.getElementById(span_id).innerHTML = "User name is not available";
            }
        });
}

function checkEmail(event, span_id) {
    let email = event.target.value;
    if (!regexMail.test(email)) {
        return;
    }
    fetch("user-management/users/email/" + email, { headers: { response: "application/json" } })
        .then(response => { return response.json() })
        .then(data => {
            if (data.result == false) {
                document.getElementById(span_id).innerHTML = "";
            } else {
                document.getElementById(span_id).innerHTML = "Email id is already registered";
            }
        });
}

const isbnValidator = function(isbn) {
    let sum = 0,
        digit;
    let n = isbn.length;
    if (n != 10) {
        return false;
    }
    for (let i = 0; i < 9; i++) {
        if (isNaN(isbn[i])) {
            return false;
        }
        digit = parseInt(isbn[i]);
        sum += (digit * (10 - i));
    }
    last = isbn[9];
    if (last != 'X' && (isNaN(last))) {
        return false;
    }
    sum += ((last == 'X') ? 10 : (parseInt(last)));
    return (sum % 11 == 0);
}

function checkPassword(strPassword) {
    // Reset combination count
    var nScore = 0;
    // Password length
    // -- length Less than 4 characters
    if (strPassword.length < 5) {
        nScore += 5;
    }
    // -- length 5 to 7 characters
    else if (strPassword.length > 4 && strPassword.length < 8) {
        nScore += 10;
    }
    // -- length 8 or more
    else if (strPassword.length > 7) {
        nScore += 25;
    }
    var nUpperCount = countContain(strPassword, m_strUpperCase);
    var nLowerCount = countContain(strPassword, m_strLowerCase);
    var nLowerUpperCount = nUpperCount + nLowerCount;
    // -- Letters are all lower case
    if (nUpperCount == 0 && nLowerCount != 0) {
        nScore += 10;
    }
    // -- Letters are upper case and lower case
    else if (nUpperCount != 0 && nLowerCount != 0) {
        nScore += 20;
    }
    // Numbers
    var nNumberCount = countContain(strPassword, m_strNumber);
    // -- 1 number
    if (nNumberCount == 1) {
        nScore += 10;
    }
    // -- 3 or more numbers
    if (nNumberCount >= 3) {
        nScore += 20;
    }
    // Characters
    var nCharacterCount = countContain(strPassword, m_strCharacters);
    // -- 1 character
    if (nCharacterCount == 1) {
        nScore += 10;
    }
    // -- More than 1 character
    if (nCharacterCount > 1) {
        nScore += 25;
    }
    // Bonus
    // -- Letters and numbers
    if (nNumberCount != 0 && nLowerUpperCount != 0) {
        nScore += 2;
    }
    // -- Letters, numbers, and characters
    if (nNumberCount != 0 && nLowerUpperCount != 0 && nCharacterCount != 0) {
        nScore += 3;
    }
    // -- Mixed case letters, numbers, and characters
    if (nNumberCount != 0 && nUpperCount != 0 && nLowerCount != 0 && nCharacterCount != 0) {
        nScore += 5;
    }
    return nScore;
}

function runPassword(str) {
    var nScore = checkPassword(str);
    var color = 'black';
    var txt = '';
    if (nScore >= 90) {
        var txt = "Very Secure";
        var color = "#0ca908";
    }
    // -- Secure
    else if (nScore >= 80) {
        var txt = "Secure";
        var color = "#7ff67c";
    }
    // -- Very Strong
    else if (nScore >= 80) {
        var txt = "Very Strong";
        var color = "#008000";
    }
    // -- Strong
    else if (nScore >= 60) {
        var txt = "Strong";
        var color = "#006000";
    }
    // -- Average
    else if (nScore >= 40) {
        var txt = "Average";
        var color = "#e3cb00";
    }
    // -- Weak
    else if (nScore >= 20) {
        var txt = "Weak";
        var color = "#Fe3d1a";
    }
    // -- Very Weak
    else {
        var txt = "Very Weak";
        var color = "#e71a1a";
    }
    if (str.length == 0) {
        document.querySelector("#pass1str").style.display = "none";
        document.querySelector("#pass1msg").style.display = "none";
    } else {
        document.querySelector("#pass1str").style.display = "block"
        document.querySelector("#pass1str").value = nScore;
        document.querySelector("#pass1msg").style.color = color;
        document.querySelector("#pass1msg").innerHTML = txt;
    }
}

function countContain(strPassword, strCheck) {
    var nCount = 0;
    for (i = 0; i < strPassword.length; i++) {
        if (strCheck.indexOf(strPassword.charAt(i)) > -1) {
            nCount++;
        }
    }
    return nCount;
}

function checkConfirm(ele1, ele2, target) {
    if (document.querySelector("#" + ele1).value != document.querySelector("#" + ele2).value)
        document.querySelector("#" + target).innerHTML = "Passwords mismatch...!";
    else
        document.querySelector("#" + target).innerHTML = "";
}

function changePreview(event) {
    let ele = event.target.parentElement;
    let reader = new FileReader();
    if (event.target.value != "") {
        extension = event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.') + 1).toLowerCase();
        if (extension != "png" && extension != "jpg" && extension != "jpeg") {
            alert("Please upload a image file..");
            event.target.value = "";
        } else {
            reader.onload = function() {
                preview = document.createElement("img");
                preview.src = reader.result;
                preview.className = "file-preview";
                preview.id = "file-preview";
                oldEle = document.getElementById('file-preview');
                if (oldEle != null && ele.contains(oldEle)) {
                    oldEle.remove();
                }
                ele.appendChild(preview);
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    }
}

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}