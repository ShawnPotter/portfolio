let submit = document.getElementById("contactForm");
submit.onsubmit=validate;

let meetType = document.getElementById("meetType")

$(function (){
    $("#addToList").on("click", function(){
        let checkbox = $("#addToList");
        let formatOption = document.getElementById("mailFormat");
        if(checkbox.is(":checked")){
            formatOption.classList.remove("d-none");
        } else if (!checkbox.is(":checked") && !formatOption.classList.contains("d-none")){
            formatOption.classList.add("d-none");
        }
    });
    $("#meetType").change(function(){

        let otherDescription = $("#otherDescription");
        if($(this).val() === "other"){
            otherDescription.removeClass("d-none");
            otherDescription.focus();
        } else if (!(otherDescription.hasClass("d-none"))){
            otherDescription.addClass("d-none");
        }
    });
});

//let title = document.getElementById("title");
let email = document.getElementById("email");
let isValid = true;


function checkFirstName(){
    let fname= document.getElementById("fName").value;
    if (fname===""){
        document.getElementById("fNameRequired").classList.remove("d-none");
        isValid =  false;
    }
    return isValid;
}

function checkLastName(){
    let lname= document.getElementById("lName").value;
    if (lname===""){
        document.getElementById("lNameRequired").classList.remove("d-none");
        isValid =  false;
    }
    return isValid;

}

function checkSocial() {
    let social = document.getElementById("linkedIn").value;
    if (social !== '') {
        if ((!social.includes("https://www.linkedin.com/in/")) &&
            (!social.includes("http://www.linkedin.com/in/")) ){
            document.getElementById("invalidURL").classList.remove("d-none");
            isValid = false;

        }
    }
    return isValid;
}

function checkEmail(){

    let pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    if( email.value !== ""){
        if (!(pattern.test(String(email.value).toLowerCase()))) {
            document.getElementById("invalidEmail").classList.remove("d-none");
            isValid =  false;
        }
    }
    return isValid;


}

function checkMeetType(){
    let meetOption = document.getElementById("meetType").value;
    if(meetOption === ""){
        document.getElementById("meetOptionRequired").classList.remove("d-none");
        isValid =  false;
    }
    return isValid;
}

function checkMailingList(){
    let list = document.getElementById("addToList"); //add to mailing list
    if (list.checked && email.value === ""){
        document.getElementById("emailRequiredForList").classList.remove("d-none");
        document.getElementById("emailEmpty").classList.remove("d-none");
        isValid = false;

    }
    return isValid;
}

function clearErrors(){
    let errors = document.getElementsByClassName("text-danger");
    for (let i=0; i<errors.length; i++){
        errors[i].classList.add("d-none");
    }
    return isValid;
}

function validate(){
    isValid = true;
    clearErrors();

    checkFirstName();
    console.log("First Name is: " + isValid); //debug

    checkLastName();
    console.log("Last Name is: " + isValid); //debug

    checkSocial();
    console.log("Social is: " + isValid); //debug

    checkEmail();
    console.log("Email is: " + isValid); //debug

    checkMeetType();
    console.log("Meet Option is: " + isValid); //debug

    checkMailingList();
    console.log("Mailing List is: " + isValid); //debug

    return isValid;
}