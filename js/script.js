document.addEventListener("DOMContentLoaded", function(){

    const signup_form = document.getElementById('signup_form');
    const login_form = document.getElementById('login_form');
    
    //обработка отправки формы регистрации
    signup_form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const form_data = new FormData(signup_form);

        let response = await fetch("signup.php", {
            method: 'POST',
            body: form_data,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            }
        });
        let result = await response.json();

        document.getElementById("e_login_signup").innerHTML = " ";
        document.getElementById("e_password_signup").innerHTML = " ";
        document.getElementById("e_confirm_password_signup").innerHTML = " ";
        document.getElementById("e_email_signup").innerHTML = " ";
        document.getElementById("e_name_signup").innerHTML = " ";

        if(result["e_login"] != null){
            document.getElementById("e_login_signup").innerHTML = result["e_login"];
        }

        if(result["e_password"] != null){
            document.getElementById("e_password_signup").innerHTML = result["e_password"];
        }

        if(result["e_confirm_password"] != null){
            document.getElementById("e_confirm_password_signup").innerHTML = result["e_confirm_password"];
        }

        if(result["e_email"] != null){
            document.getElementById("e_email_signup").innerHTML = result["e_email"];
        }

        if(result["name"] != null){
            document.getElementById("e_name_signup").innerHTML = result["e_name"];
        }

        if(!Object.entries(result).length){
            window.location.href = "page1.php";
        }
        
    });


    //обработка отправки формы авторизации
    login_form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const form_data = new FormData(login_form);

        let response = await fetch("login.php", {
            method: 'POST',
            body: form_data,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            }
        });
        let result = await response.json();

        document.getElementById("e_login_login").innerHTML = " ";
        document.getElementById("e_password_login").innerHTML = " ";

        if(result["e_login"] != null){
            document.getElementById("e_login_login").innerHTML = result["e_login"];
        }

        if(result["e_password"] != null){
            document.getElementById("e_password_login").innerHTML = result["e_password"];
        }

        if(!Object.entries(result).length){
            window.location.href = "page1.php";
        }
        
    });
});