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
    <title><?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?> - Resume</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<header>
    <h1><?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?></h1>
    <nav>
        <a href="#personal">Personal Info</a>
        <a href="#experiences">Experiences</a>
        <a href="#education">Education</a>
        <a href="#skills">Skills</a>
    </nav>
</header>

<main>
    <section id="personal">
        <h2>Personal Information</h2>
        <p>Email: <a href="mailto:<?= htmlspecialchars($user['email']) ?>"><?= htmlspecialchars($user['email']) ?></a></p>
        <p>Phone: <?= htmlspecialchars($user['phone']) ?></p>
        <?php if (!empty($user['picture'])): ?>
            <img src="<?= htmlspecialchars($user['picture']) ?>" alt="Profile picture" style="max-width:150px;border-radius:8px;">
        <?php endif; ?>
    </section>

    <section id="experiences">
        <h2>Experiences</h2>
        <?php foreach ($experiences as $exp): ?>
            <article>
                <h3><?= htmlspecialchars($exp['name']) ?></h3>
                <p><?= htmlspecialchars($exp['description']) ?></p>
                <p><?= htmlspecialchars($exp['startdate']) ?> → <?= htmlspecialchars($exp['enddate']) ?></p>
            </article>
        <?php endforeach; ?>
    </section>

    <section id="education">
        <h2>Education</h2>
        <?php foreach ($educations as $edu): ?>
            <article>
                <h3><?= htmlspecialchars($edu['name']) ?></h3>
                <p><?= htmlspecialchars($edu['description']) ?></p>
                <p><?= htmlspecialchars($edu['startdate']) ?> → <?= htmlspecialchars($edu['enddate']) ?></p>
            </article>
        <?php endforeach; ?>
    </section>

    <section id="skills">
        <h2>Skills</h2>
        <ul>
            <?php foreach ($skills as $skill): ?>
                <li><?= htmlspecialchars($skill['name']) ?> – <?= htmlspecialchars($skill['level']) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<footer>
    <p>© 2025 <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?> - Resume</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("main section");
  sections.forEach(section => {
    const btn = document.createElement("button");
    btn.textContent = "Toggle";
    btn.style.marginBottom = "10px";
    btn.style.display = "block";
    section.insertBefore(btn, section.firstChild);
    btn.addEventListener("click", () => {
      const content = Array.from(section.children).slice(1);
      content.forEach(el => {
        el.style.display = (el.style.display === "none") ? "" : "none";
      });
    });
  });
});
</script>
</body>
</html>