function confirmDelete() {
    return confirm("Are you sure you want to delete this blog?");
}

function validateRegistration() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}