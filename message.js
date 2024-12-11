function showPopup(message) {
    document.getElementById("popup-message").innerText = message;
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
}

// Проверяем наличие сообщения об ошибке
<?php if (isset($_SESSION['error_message'])): ?>
    showPopup("<?php echo $_SESSION['error_message']; ?>");
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>