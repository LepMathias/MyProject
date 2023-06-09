<?php
session_start();
require './src/managers/UserManager.php';
require './src/managers/ReservationManager.php';
require './src/managers/PictureManager.php';
require './src/managers/SchedulesManager.php';
require './src/managers/SettingManager.php';
require './src/managers/MealManager.php';
require './src/managers/MenuManager.php';
require './conf/db/confDB.php';

use managers\UserManager;
use managers\ReservationManager;
use managers\PictureManager;
use managers\SchedulesManager;
use managers\SettingManager;
use managers\MealManager;
use managers\MenuManager;

try {
    $pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

    /**
     * Users gestion -> sign_up and log_in
     *              -> GuestsPage function
     */
    $userManager = new UserManager($pdo);
    if (!empty($_POST['log-in_form'])) {
        $user = $userManager->connectUser(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
    }
    if (!empty($_POST['sign-up_form'])) {
        $regStatus = $userManager->addUser(htmlspecialchars($_POST['lastname']), htmlspecialchars($_POST['firstname']),
            $_POST['birthdate'], htmlspecialchars($_POST['email']), htmlspecialchars($_POST['phoneNumber']),
            $_POST['password'], htmlspecialchars($_POST['defaultNbrGuest']), htmlspecialchars($_POST['allergies']));
    }
    if (!empty($_POST['userId'])) {
        $userManager->updateUser(htmlspecialchars($_POST['lastname']), htmlspecialchars($_POST['firstname']),
            $_POST['birthdate'], htmlspecialchars($_POST['email']), htmlspecialchars($_POST['phoneNumber']),
            $_POST['nbrOfGuest'], htmlspecialchars($_POST['allergies']), $_POST['status'], $_POST['userId']);
    }
    if (!empty($_POST['createAdmin'])) {
        $userManager->addAdmin(htmlspecialchars($_POST['adminLastname']), htmlspecialchars($_POST['adminFirstname']),
            htmlspecialchars($_POST['adminEmail']), $_POST['adminPassword']);
    }

    /**
     * Create Reservation
     */
    $reservationManager = new ReservationManager($pdo);
    if (!empty($_POST['reservation_form'])) {
        if (isset($_SESSION['id'])) {
            if ($_SESSION['status'] !== 'blackliste') {
                $reservationStatus = $reservationManager->addReservationUId($_POST['book-date'], $_POST['book-hour'],
                    $_POST['book-nbrOfGuest'], $_SESSION['id'], $_POST['book-allergies']);
            } else {
                echo "<script>alert('Un problème est survenu lors de votre réservation. Vous pouvez nous contacter par téléphone.')</script>";
            }
        } else {
            $reservationStatus = $reservationManager->addReservation($_POST['book-date'], $_POST['book-hour'],
                $_POST['book-nbrOfGuest'], $_POST['book-lastname'], $_POST['book-firstname'], $_POST['book-phoneNumber'],
                $_POST['book-allergies']);
        }
    }
    if (!empty($_POST['updReservation_form'])) {
        $reservationManager->updateReservation($_POST['date'], $_POST['hour'],
            $_POST['nbrOfGuest'], $_POST['allergies'], $_POST['updReservation_form']);
    }



    /**
     * Admin
     * Upload(create) / Read / Delete
     * pictures for carousel
     */
    $pictureManager = new PictureManager();
    if (!empty($_FILES['uploadedFile'])) {
        $pictureManager->isUploadSuccessful($_FILES['uploadedFile'], $_POST['pictureTitle']);
    }
    if (!empty($_POST['oldName'])) {
        $pictureManager->updateFile($_POST['oldName'], $_POST['newName']);
    }
    if (!empty($_POST['deleteFile'])) {
        $pictureManager->deleteFile($_POST['deleteFile']);
    }
    $allPictures = $pictureManager->getUploadedFiles();
    /**
     * Display Pictures in carousel
     */
    $firstPic = $pictureManager->getFirstPic();
    $files = $pictureManager->getRestPic();



    /**
     * Admin
     * Update Schedules
     */
    $schedulesManager = new SchedulesManager($pdo);
    $settingManager = new SettingManager($pdo);
    if (!empty($_POST['id'])) {
        $schedulesManager->updateSchedules($_POST['startDej'], $_POST['endDej'], $_POST['startDin'], $_POST['endDin'],
            $_POST['id']);
    }

    /**
     * Read / Display Schedules
     */
    $schedules = $schedulesManager->getSchedules();
    $schedulesFooter = $settingManager->getSettings('schedulesFooter');



    /**
     * Create / Read / Delete Meals
     */
    $mealManager = new MealManager($pdo);
    if (!empty($_POST['category'])){
        $mealManager->addMeal($_POST['category'], $_POST['title'], $_POST['description'], $_POST['price']);
    }
    if (isset($_GET['id'])) {
        $mealManager->deleteMeal($_GET['id']);
    }
    /*Get and display all data on Admin and Guest pages*/
    $starters = $mealManager->getMeals(1);
    $mainCourses = $mealManager->getMeals(2);
    $desserts = $mealManager->getMeals(3);



    /**
     * Create / Read / Update / Delete Menus
     */
    $menuManager = new MenuManager($pdo);
    if (!empty($_POST['menu'])) {
        $menuManager->addMenu($_POST['title'], $_POST['description'], $_POST['price'], $_POST['availability']);
    }
    if (!empty($_POST['upd_menu'])) {
        $menuManager->updateMenu($_POST['title'], $_POST['description'], $_POST['price'], $_POST['availability'], $_POST['id']);
    }
    if (isset($_GET['id'])) {
        $menuManager->deleteMenu($_GET['id']);
    }
    $menus = $menuManager->getMenus();



    /**
     * Update / Read setting -> Limit of Guest per service
     */
    if(!empty($_POST['schedulesFooter'])) {
        $value = [
            [
                "name" => "schedulesFooter",
                "content" => $_POST['schedulesFooter']
            ]
        ];
        $settingManager->updateSetting($value);
    }
    if(!empty($_POST['maxOfGuest'])){
        $value = [
            "maxOfGuest" => $_POST['maxOfGuest'],
            "schedulesGap" => $_POST['schedulesGap']
        ];
        $settingManager->updateSetting($value);
    }
    $maxOfGuest = $settingManager->getSettings('maxOfGuest');
    $schedulesGap = $settingManager->getSettings('schedulesGap');


} catch (Exception $e) {
    file_put_contents('../../conf/db/dblogs.log', $e->getMessage() .
        PHP_EOL, FILE_APPEND);
    echo "<script>alert('Une erreur s\'est produite. Contactez l\'administrateur')</script>";
}

?>