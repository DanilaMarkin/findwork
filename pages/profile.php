<?php 
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../models/users.php");

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);

$profile = $auth->findProfile($_SESSION['user']);
?>
<div class="flex justify-center items-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-screen-xl flex">
        <!-- Левая секция -->
        <div class="w-1/2 p-4">
            <h1 class="text-3xl font-bold mb-4">Личный кабинет</h1>
            
            <!-- Форма для изменения фотографии -->
            <form action="../controller/editPhoto.php" method="POST" enctype="multipart/form-data" class="mb-6">
                <div class="flex items-center justify-center w-full">
                    <label for="photo" class="cursor-pointer flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-full w-20 h-20">
                        <?php if (empty($profile['img'])) {?>
                        <img src="../media/img/unknows.jpg" name="img" alt="User Photo" class="w-full h-full rounded-full object-cover">
                        <?php } else {?>
                        <img src="../upload/<?= $profile['img'] ?>" alt="User Photo" class="w-full h-full rounded-full object-cover">
                        <?php } ?>
                    </label>
                </div>
                <input type="hidden" name="login" value="<?= $profile["login"] ?>">
                <input type="file" name="photo" id="photo" class="hidden">
                <button type="submit" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-full">Изменить фото</button>
            </form>
            
            <!-- Форма для изменения данных пользователя -->
            <form action="update_profile.php" method="POST" class="mb-6">
                <label for="login" class="block text-sm font-medium text-gray-700 mb-2">Логин</label>
                <input type="text" id="login" name="login" class="border border-gray-300 rounded-md py-2 px-3 w-full mb-2" placeholder="<?= $profile["login"] ?>" disabled>
                
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Имя</label>
                <input type="text" id="name" name="name" class="border border-gray-300 rounded-md py-2 px-3 w-full mb-2" placeholder="<?= $profile["name"] ?>" disabled>
                
                <label for="surname" class="block text-sm font-medium text-gray-700 mb-2">Фамилия</label>
                <input type="text" id="surname" name="surname" class="border border-gray-300 rounded-md py-2 px-3 w-full mb-2" placeholder="<?= $profile["surname"] ?>" disabled>
                
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="border border-gray-300 rounded-md py-2 px-3 w-full mb-2" placeholder="<?= $profile["email"] ?>" disabled>
                
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Пароль</label>
                <input type="password" id="password" name="password" class="border border-gray-300 rounded-md py-2 px-3 w-full mb-2" placeholder="Введите ваш пароль">
                
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-full">Сохранить изменения</button>
            </form>
        </div>
        
        <!-- Правая секция -->
        <div class="w-1/2 p-4">
            <!-- Статистика аккаунта -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Статистика аккаунта</h2>
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-600">Откликов</p>
                        <p class="text-xl font-semibold">10</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Сообщений</p>
                        <p class="text-xl font-semibold">5</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Просмотров</p>
                        <p class="text-xl font-semibold">100</p>
                    </div>
                </div>
            </div>
    
            <!-- Раздел для написания резюме -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Резюме</h2>
                <textarea class="border border-gray-300 rounded-md py-2 px-3 w-full h-24 focus:outline-none focus:border-blue-500" placeholder="Напишите ваше резюме здесь"></textarea>
            </div>
        </div>
    </div>
</div>