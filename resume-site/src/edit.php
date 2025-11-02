<?php
require_once 'db.php';

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    die("User not found");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die("User not found");
}

$stmt = $pdo->prepare("SELECT * FROM experiences WHERE user_id = ?");
$stmt->execute([$user_id]);
$experiences = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM educations WHERE user_id = ?");
$stmt->execute([$user_id]);
$educations = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM skills WHERE user_id = ?");
$stmt->execute([$user_id]);
$skills = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Resume - <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body class="edit-page">
<header>
    <h1>Edit Resume - <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?></h1>
</header>

<main>
    <section id="personal">
        <h2>Personal Information</h2>
        <form method="post" action="update_user.php">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <label>First Name: <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>"></label>
            <label>Last Name: <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>"></label>
            <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"></label>
            <label>Phone: <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>"></label>
            <label>Picture URL: <input type="text" name="picture" value="<?= htmlspecialchars($user['picture']) ?>"></label>
            <button type="submit">Update</button>
        </form>
    </section>

    <section id="experiences">
        <h2>Experiences</h2>
        <?php foreach ($experiences as $exp): ?>
            <form method="post" action="update_experience.php">
                <input type="hidden" name="id" value="<?= $exp['id'] ?>">
                <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($exp['name']) ?>"></label>
                <label>Description: <textarea name="description"><?= htmlspecialchars($exp['description']) ?></textarea></label>
                <label>Start Date: <input type="date" name="startdate" value="<?= htmlspecialchars($exp['startdate']) ?>"></label>
                <label>End Date: <input type="date" name="enddate" value="<?= htmlspecialchars($exp['enddate']) ?>"></label>
                <button type="submit">Update</button>
            </form>
            <form method="post" action="delete_experience.php">
                <input type="hidden" name="id" value="<?= $exp['id'] ?>">
                <button type="submit">Delete</button>
            </form>
        <?php endforeach; ?>
        <form method="post" action="add_experience.php">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <label>Name: <input type="text" name="name"></label>
            <label>Description: <textarea name="description"></textarea></label>
            <label>Start Date: <input type="date" name="startdate"></label>
            <label>End Date: <input type="date" name="enddate"></label>
            <button type="submit">Add</button>
        </form>
    </section>

    <section id="education">
        <h2>Education</h2>
        <?php foreach ($educations as $edu): ?>
            <form method="post" action="update_education.php">
                <input type="hidden" name="id" value="<?= $edu['id'] ?>">
                <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($edu['name']) ?>"></label>
                <label>Description: <textarea name="description"><?= htmlspecialchars($edu['description']) ?></textarea></label>
                <label>Start Date: <input type="date" name="startdate" value="<?= htmlspecialchars($edu['startdate']) ?>"></label>
                <label>End Date: <input type="date" name="enddate" value="<?= htmlspecialchars($edu['enddate']) ?>"></label>
                <button type="submit">Update</button>
            </form>
            <form method="post" action="delete_education.php">
                <input type="hidden" name="id" value="<?= $edu['id'] ?>">
                <button type="submit">Delete</button>
            </form>
        <?php endforeach; ?>
        <form method="post" action="add_education.php">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <label>Name: <input type="text" name="name"></label>
            <label>Description: <textarea name="description"></textarea></label>
            <label>Start Date: <input type="date" name="startdate"></label>
            <label>End Date: <input type="date" name="enddate"></label>
            <button type="submit">Add</button>
        </form>
    </section>

    <section id="skills">
        <h2>Skills</h2>
        <?php foreach ($skills as $skill): ?>
            <form method="post" action="update_skill.php">
                <input type="hidden" name="id" value="<?= $skill['id'] ?>">
                <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($skill['name']) ?>"></label>
                <label>Level: <input type="text" name="level" value="<?= htmlspecialchars($skill['level']) ?>"></label>
                <button type="submit">Update</button>
            </form>
            <form method="post" action="delete_skill.php">
                <input type="hidden" name="id" value="<?= $skill['id'] ?>">
                <button type="submit">Delete</button>
            </form>
        <?php endforeach; ?>
        <form method="post" action="add_skill.php">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <label>Name: <input type="text" name="name"></label>
            <label>Level: <input type="text" name="level"></label>
            <button type="submit">Add</button>
        </form>
    </section>
</main>

<footer>
    <p>© 2025 <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?> - Resume</p>
</footer>
</body>
</html>