<?php


function validateUser($name, $email, $image)
{
    if (empty($name) || empty($email) || empty($image)) {
        return "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email address.";
    }
    return "";
}

function uploadImage($image)
{
    if ($image["error"] !== UPLOAD_ERR_OK) {
        return false;
    }
    $imageInfo = getimagesize($image["tmp_name"]);
    if ($imageInfo === false) {
        return false;
    }
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }
    $fileName = uniqid() . "_" . basename($image["name"]);
    $filePath = UPLOAD_DIR . $fileName;
    if (move_uploaded_file($image["tmp_name"], $filePath)) {
        return $filePath;
    }
    return false;
}


function saveUser($userData)
{
    $users = [];
    if (file_exists(DATABASE_FILE)) {
        $json = file_get_contents(DATABASE_FILE);
        $data = json_decode($json, true);
        if (is_array($data)) {
            if (isset($data["email"])) {
                $users[] = $data;
            } else {
                $users = $data;
            }
        }
    }
    $users[] = $userData;
    $json = json_encode($users, JSON_PRETTY_PRINT);
    return file_put_contents(DATABASE_FILE, $json, LOCK_EX) !== false;
}


function getUser()
{
    if (!file_exists(DATABASE_FILE)) {
        return [];
    }
    $json = file_get_contents(DATABASE_FILE);
    $users = json_decode($json, true);
    if (!is_array($users)) {
        return [];
    }
    if (isset($users["email"])) {
        return [$users];
    }
    return $users;
}



// Email regex
function isValidEmail($email)
{
    return preg_match(
        '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
        $email
    ) === 1;
}

function isValidMobile($mobile)
{
    return preg_match('/^\d{14}$/', $mobile) === 1;
}

function isValidFullName($fullName)
{
    $parts = preg_split('/\s+/', trim($fullName));
    if (count($parts) !== 4) {
        return false;
    }
    foreach ($parts as $p) {
        if (!preg_match('/^[A-Za-z\x{0621}-\x{064A}]{2,}$/u', $p)) {
            return false;
        }
    }
    return true;
}

function isValidPassword($password)
{
    return preg_match(
        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])\S{8,}$/',
        $password
    ) === 1;
}

function isValidDob($day, $month, $year)
{
    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        return "Invalid date.";
    }
    $dob   = new DateTime("$year-$month-$day");
    $today = new DateTime();
    if ($dob > $today) {
        return "Date of birth cannot be in the future.";
    }
    $age = $today->diff($dob)->y;
    if ($age < 16) {
        return "You must be at least 16 years old.";
    }
    return "";
}

function validateSignup($data, $files)
{
    if (
        empty($data['email'])    || empty($data['mobile'])   ||
        empty($data['full_name'])|| empty($data['password']) ||
        empty($data['confirm'])  || empty($data['day'])      ||
        empty($data['month'])    || empty($data['year'])
    ) {
        return "All fields are required.";
    }

    if (!isValidEmail($data['email'])) {
        return "Invalid email format.";
    }
    if (!isValidMobile($data['mobile'])) {
        return "Mobile must be exactly 14 digits.";
    }
    if (!isValidFullName($data['full_name'])) {
        return "Full name must contain 4 parts (first, middle, last, family).";
    }
    if (!isValidPassword($data['password'])) {
        return "Password must be ≥8 chars with upper, lower, number, special char, and no spaces.";
    }
    if ($data['password'] !== $data['confirm']) {
        return "Passwords do not match.";
    }
    $dobErr = isValidDob($data['day'], $data['month'], $data['year']);
    if ($dobErr) {
        return $dobErr;
    }
    if (empty($files['name'])) {
        return "Profile image is required.";
    }

    foreach (getUser() as $u) {
        if (isset($u['email']) && strcasecmp($u['email'], $data['email']) === 0) {
            return "Email already registered.";
        }
    }

    return "";
}

function updateUser($oldEmail, $newData)
{
    $users = getUser();
    foreach ($users as $i => $u) {
        if (isset($u['email']) && strcasecmp($u['email'], $oldEmail) === 0) {
            $users[$i] = array_merge($u, $newData);
            return file_put_contents(
                DATABASE_FILE,
                json_encode($users, JSON_PRETTY_PRINT),
                LOCK_EX
            ) !== false;
        }
    }
    return false;
}

function deleteUser($email)
{
    $users = getUser();
    $users = array_values(array_filter($users, function ($u) use ($email) {
        return !(isset($u['email']) && strcasecmp($u['email'], $email) === 0);
    }));
    return file_put_contents(
        DATABASE_FILE,
        json_encode($users, JSON_PRETTY_PRINT),
        LOCK_EX
    ) !== false;
}