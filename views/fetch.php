<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form id="sign-in-form">
    <label for="email">Username:</label>
    <input type="email" id="email" name="email" >
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" >
    <br>
    <button type="submit">Sign In</button>
</form>
<pre id="message"></pre>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('sign-in-form');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const payload = {
                email: email,
                password: password,
            };

            document.getElementById('email').value = '';
            document.getElementById('password').value = '';

            const signInUrl = 'http://localhost:8888/api/auth/login';

            try {
                const response = await fetch(signInUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    throw new Error(`Sign-in failed: Not Authorized`);
                }

                const data = await response.json();

                document.getElementById('message').innerText = JSON.stringify(data, null, 2);

                console.log(data);
            } catch (error) {
                console.error('Error during sign-in:', error);
            }
        })
    });
</script>
</body>
</html>