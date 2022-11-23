<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../lib/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <?php include('../header.php'); ?>
    </header>
    <main>
        <div class="bg"></div>
        <div class="bg bg2"></div>
        <div class="bg bg3"></div>
        <div class="relative min-h-screen flex flex-col sm:justify-center items-center">
            <div class="relative sm:max-w-sm w-full">
                <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
                <div class="card bg-green-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
                <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                    <label for="" class="block mt-3 text-lg text-gray-700 text-center font-semibold">
                        Registro
                    </label>
                    <form method="POST" class="mt-10">

                        <div>
                            <label for="user_name" class="text-gray-700 ml-2 text-sm">Porfavor introduzca un usuario<span class="text-red-400">*</span></label>
                            <input type="text" name="user_name" id="user_name" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>

                        <div class="mt-7">
                            <label for="passw" class="text-gray-700 ml-2 text-sm">Contraseña<span class="text-red-400">*</span></label>
                            <input type="password" name="passw" id="passw" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>

                        <div class="mt-7">
                            <button type="button" class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out 
                             transform hover:-translate-x hover:scale-105" onclick="registerUser()">
                                Registrarse
                            </button>
                        </div>

                        <div class="flex mt-7 items-center text-center">
                            <hr class="border-gray-300 border-1 w-full rounded-md">
                        </div>
                    </form>
                    <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <label class="mr-2">¿Ya tienes una cuenta?</label>
                            <a href="login.php" class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                Iniciar sesion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>
</html>
<script src="../lib/jquery-3.6.1.min.js"></script>
<script>
    function registerUser() {
        let user = $('#user_name').val();
        let password = $('#passw').val()

        if (!user) {
            alert('Introduzca un usuario');
        }
        if (!password) {
            alert("Introduzca la contrasenya");
        }        
        $.post('userRegister.php', {
                user: user,
                password: password
            },
            function(data) {
                alert('Se ha registrado correctamente');
                location.href = '../home.php';
            }
        );
    }
</script>