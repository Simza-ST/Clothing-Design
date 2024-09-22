const submitBtn = document.querySelector('.submit-btn'),
      phone = document.querySelector('#phone'),
      password = document.querySelector('#user-password'),
      passwordConfirm = document.querySelector('#user-password-confirm'),
      email = document.querySelector('#mail'),
      errorDisplayers = document.getElementsByClassName('error'),
      inputFields = document.querySelectorAll('input'),
      cardContainer = document.querySelector('.card-container'),
      outroOverlay = document.querySelector('.outro-overlay')

let count = 2

function onValidation(current ,messageString, booleanTest){
    let message = current
    message.textContent = messageString
    booleanTest != 0 ? ++count : count
}

for(let i=0; i<inputFields.length; i++){
    let currentInputField = inputFields[i]
    let currentErrorDisplayer = errorDisplayers[i]

    currentInputField.addEventListener('keyup', (e)=>{
        let message = currentErrorDisplayer
        e.target.value != "" ? onValidation(currentErrorDisplayer, '', 0) : onValidation(currentErrorDisplayer, '*This field is Required', 0)
    })
}

phone.addEventListener('keyup', (e)=>{
    let message = errorDisplayers[3]
    e.target.value == e.target.value.replace(/\D/g,'') ? onValidation(message, '', 1) : onValidation(message, '*Please enter valid number', 0)
})

email.addEventListener('keyup', (e)=>{
    let message = errorDisplayers[2]
    mail.value.includes('@') & mail.value.includes('.com') ? onValidation(message, '', 1) : onValidation(message, '*Please provide a valid Email', 0)
})

password.addEventListener('keyup', (e)=>{
    let message = errorDisplayers[4]
    password.value.length >= 8 ? onValidation(message, '', 1) :  onValidation(message, 'Password requires minimum 8 charecters', 0)
})

passwordConfirm.addEventListener('keyup', (e)=>{
    let message = errorDisplayers[5]
    password.value === e.target.value ? onValidation(message, '', 1) : onValidation(message, '*Password did not match', 0)
})

submitBtn.addEventListener('click', (e)=>{
    e.preventDefault()
    if(count > 5){
        cardContainer.style.display = 'none'
        outroOverlay.classList.remove('disabled')
    }
    else{
        for(let i=0; i<errorDisplayers.length; i++){
            errorDisplayers[i].textContent = '*This field is Required'
        }
    }
})

//this section is for the t-shirt preview
        function updatePreview() {
            var text = document.getElementById("designText").value;
            var color = document.getElementById("textColor").value;
            var size = document.getElementById("textSize").value;
        
            var tshirtColor = document.getElementById("tshirtColor").value;
            var preview = document.getElementById("textPreview");
            var vertical = document.getElementById("vertical").checked;

            // Apply styles to preview text
            preview.style.color = color;
            preview.style.fontSize = size + "px";
          

            // Split text into lines with maximum 24 characters each
            if (vertical) {
                var lines = [];
                for (var i = 0; i < 10; i++) {
                    lines.push(text.charAt(i));
                }
            } else {
                var lines = [];
                for (var i = 0; i < text.length; i += 20) {
                    lines.push(text.substring(i, i + 20));
                }
            }

            // Join lines with line breaks
            preview.innerHTML = lines.join("<br>");

            // Set T-shirt preview background based on selected color
            var tshirtPreview = document.querySelector('.tshirt-preview');
            switch (tshirtColor) {
                case 'white':
                    tshirtPreview.style.backgroundImage = "url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/white.png')";
                    break;
                case 'black':
                    tshirtPreview.style.backgroundImage = "url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/black.png')";
                    break;
                case 'blue':
                    tshirtPreview.style.backgroundImage = "url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/blue.png')";
                    break;
                case 'red':
                    tshirtPreview.style.backgroundImage = "url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/red.png')";
                    break;
                default:
                    tshirtPreview.style.backgroundImage = "url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/white.png')";
                    break;
            }
        }
