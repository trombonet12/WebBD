<?php
session_start();
$user = $_SESSION["user"];
include('../conexion.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="stylesheet" href="../lib/app.css">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/themes/default.css">
    <script src="../tailwind.js"></script>
    <script src="../alertifyjs/alertify.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</head>

<body>
    <header>
    <div>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="../home.php" class="flex items-center">
                <img src="../img/logo.svg" class="mr-1 h-5 sm:h-5" alt="Flowbite Logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap">Tinderinfo</span>
            </a>
            <div class="flex items-center md:order-2">
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="flex items-center justify-center">
                <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                    <ul
                        class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                        <li>
                            <a href="../BD245614068P/publicacio.php"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="../BD249608499Y/missatge1.php"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0" >Mensaje</a>
                        </li>
                        <li>
                            <a href="searchUser.php"
                                class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" >Buscador</a>
                        </li>
                        <li>
                            <a href="profile.php"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Perfil</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

    </header>
    <main>
        <!-- component -->
        <div
            class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <div class="flex flex-col justify-center">
                    <input type="search" name="search_user" id="search_user" onsearch="OnSearch(this)"
                        placeholder="Buscar usuario"
                        class="pl-4 focus mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                </div>
                <div class="grid grid-cols-3 gap-3" id="show_divs">
                    <?php
                    $user_query = "SELECT * FROM usuari WHERE usuari.nomUsuari != '$user'";
                    $result = consultar("localhost", "root", "", $user_query);
                    while ($reg = mysqli_fetch_array($result)) {
                        $following = $reg['nomUsuari'];
                        $query_follow = "SELECT * FROM follow WHERE follow.nomUsuariSeguidor = '$user' AND follow.nomUsuariSeguint = '$following'";
                        $result_follow = consultar("localhost", "root", "", $query_follow);
                        $r = rand(0, 2);
                        if ($r == 0) { ?>
                    <div class="container">
                        <a href="profileUser.php?id=<?= $reg['nomUsuari'] ?>">
                            <div
                                class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-blue-50 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <?php
                            if (!empty($reg['img_profile'])) { ?>
                                    <img class="h-32 rounded-full" src=<?= $reg['img_profile'] ?> />
                                    <?php
                            } else {
                                    ?>
                                    <img class="h-32 rounded-full" src="../img/profile_picture_default.png" />
                                    <?php } ?>
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg">
                                    <?= $reg['nomUsuari'] ?>
                                </div>
                                <div class="flex flex-row justify-center items-center">
                                    <?php if (!$reg = mysqli_fetch_array($result_follow)) { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="following_buttom('<?= $user ?>', '<?= $following ?>')">Seguir</a>
                                    <?php } else { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="unfollowing_buttom('<?= $user ?>', '<?= $following ?>')">
                                        Siguiendo</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        } elseif ($r == 1) { ?>
                    <div class="container">
                        <a href="profileUser.php?id=<?= $reg['nomUsuari'] ?>">
                            <div
                                class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-pink-50 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <?php
                            if (!empty($reg['img_profile'])) { ?>
                                    <img class="h-32 rounded-full" src=<?= $reg['img_profile'] ?> />
                                    <?php
                            } else {
                                    ?>
                                    <img class="h-32 rounded-full" src="../img/profile_picture_default.png" />
                                    <?php } ?>
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg">
                                    <?= $reg['nomUsuari'] ?>
                                </div>
                                <div class="flex flex-row justify-center items-center">
                                    <?php if (!$reg = mysqli_fetch_array($result_follow)) { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="following_buttom('<?= $user ?>', '<?= $following ?>')">Seguir</a>
                                    <?php } else { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="unfollowing_buttom('<?= $user ?>', '<?= $following ?>')">
                                        Siguiendo</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } elseif ($r == 2) { ?>
                    <div class="container">
                        <a href="profileUser.php?id=<?= $reg['nomUsuari'] ?>">
                            <div
                                class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-green-50 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <?php
                            if (!empty($reg['img_profile'])) { ?>
                                    <img class="h-32 rounded-full" src=<?= $reg['img_profile'] ?> />
                                    <?php
                            } else {
                                    ?>
                                    <img class="h-32 rounded-full" src="../img/profile_picture_default.png" />
                                    <?php } ?>
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg">
                                    <?= $reg['nomUsuari'] ?>
                                </div>
                                <div class="flex flex-row justify-center items-center">
                                    <?php if (!$reg = mysqli_fetch_array($result_follow)) { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="following_buttom('<?= $user ?>', '<?= $following ?>')">Seguir</a>
                                    <?php } else { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="unfollowing_buttom('<?= $user ?>', '<?= $following ?>')">
                                        Siguiendo</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } else { ?>
                    <div class="container">
                        <a href="profileUser.php?id=<?= $reg['nomUsuari'] ?>">
                            <div
                                class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-purple-50 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <?php
                            if (!empty($reg['img_profile'])) { ?>
                                    <img class="h-32 rounded-full" src=<?= $reg['img_profile'] ?> />
                                    <?php
                            } else {
                                    ?>
                                    <img class="h-32 rounded-full" src="../img/profile_picture_default.png" />
                                    <?php } ?>
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg">
                                    <?= $reg['nomUsuari'] ?>
                                </div>
                                <div class="flex flex-row justify-center items-center">
                                    <?php if (!$reg = mysqli_fetch_array($result_follow)) { ?>
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="following_buttom('<?= $user ?>', '<?= $following ?>')">Seguir</a>
                                    <?php } else { ?>
                                    <a class=" text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2
                                        border-slate-400 rounded-full px-1 py-1 w-22 mt-5"
                                        onclick="unfollowing_buttom('<?= $user ?>', '<?= $following ?>')">
                                        Siguiendo</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>
<script src="../lib/jquery-3.6.1.min.js"></script>
<script>
    function unfollowing_buttom(user, user_following) {
        alertify.confirm("Dejar de seguir",
            "Dejar de seguir, pero si cambias de opinión tendrás que volver a enviar una solicitud para seguir a " + user_following,
            function () {
                $.post('userUnfollow.php', {
                    user: user,
                    user_follo: user_following
                }, function () {
                    location.href = "searchUser.php";
                })
            },
            function () {
            }
        );
    }
    function following_buttom(user, user_following) {
        $.post('userFollow.php', {
            user_seguint: user_following,
            user_seguidor: user
        }, function () {
            location.href = "searchUser.php";
            // let txt = $('#user_follow').val();
            // if (txt === '') {
            //     location.href = "searchUser.php;
            // }
        });
    }
    function getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    function OnSearch(input) {
        console.log(input.value);
        if (input.value == "") {
            $('#show_divs').each(function (index) {
                $(this).show();
            });
        }
    }
    $(document).ready(function () {
        $('#search_user').keyup(function () {
            var text = $(this).val();
            $('#show_divs').hide();
            $('#show_divs:contains("' + text + '")').show();
        });
    });
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
</script>