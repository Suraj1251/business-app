// ================= REGISTER =================
const registerForm = document.getElementById("registerForm");

if (registerForm) {
    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const data = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value
        };

        try {
            const res = await fetch("http://localhost/business-app/api/register.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            alert(result.message);

            if (result.status === "success") {
                window.location.href = "login.html";
            }

        } catch (err) {
            alert("Error connecting to server");
            console.log(err);
        }
    });
}



// ================= LOGIN =================
const loginForm = document.getElementById("loginForm");

if(loginForm){
    loginForm.addEventListener("submit", async (e)=>{
        e.preventDefault();

        const data = {
            email: document.getElementById("loginEmail").value,
            password: document.getElementById("loginPassword").value
        };

        const res = await fetch("api/login.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if(result.status === "success"){
            localStorage.setItem("user", JSON.stringify(result.user));
            window.location.href = "dashboard.html";
        } else {
            alert(result.message);
        }
    });
}

