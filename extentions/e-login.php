 <script type="text/javascript" src="/~www33175/scripts/md5.js"></script>
        <script type="text/javascript">
            function login() {
                var loginForm = document.getElementById("loginForm");
                if (loginForm.username.value == "") {
                    alert("Παρακαλώ συμπληρώστε το όνομα χρήστη.");
                    return false;
                }
                if (loginForm.password.value == "") {
                    alert("Παρακαλώ συμπληρώστε τον κωδικό.");
                    return false;
                }
                var submitForm = document.getElementById("submitForm");
                submitForm.username.value = loginForm.username.value;
				
                submitForm.response.value = hex_md5(loginForm.challenge.value+hex_md5(loginForm.password.value));
                submitForm.submit();
            }
			</script>