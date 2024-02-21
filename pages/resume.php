<?php 
include_once("../components/head.php");
include_once("../components/header.php");
?>
<div class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="max-w-md w-full bg-white p-8 rounded-md shadow-md">
        <h1 class="text-2xl font-bold mb-6">Запрос на написание резюме</h1>
        <form action="../controller/resume_request.php" method="POST">
            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700">Ваше имя:</label>
                <input type="text" id="user_name" name="user_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>
            <div class="mb-4">
                <label for="user_experience" class="block text-sm font-medium text-gray-700">Ваш опыт работы:</label>
                <textarea id="user_experience" name="user_experience" required rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Запросить написание резюме</button>
            </div>
        </form>
    </div>
</div>