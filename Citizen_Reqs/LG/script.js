document.addEventListener("DOMContentLoaded", () => {
    /*** SIDEBAR TOGGLE FUNCTIONALITY ***/
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("minimized"); // Minimize/expand sidebar
    });

    /*** THEME TOGGLE FUNCTIONALITY ***/
    const themeToggleBtn = document.getElementById("theme-toggle");
    const savedTheme = localStorage.getItem("theme");

    // Apply saved theme from localStorage on load
    if (savedTheme) {
        document.body.classList.add(savedTheme + "-mode");
        const icon = themeToggleBtn.querySelector("span");
        icon.textContent = savedTheme === "dark" ? "light_mode" : "dark_mode";
    }

    // Toggle theme between light and dark modes
    themeToggleBtn.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        const isDarkMode = document.body.classList.contains("dark-mode");
        const icon = themeToggleBtn.querySelector("span");
        icon.textContent = isDarkMode ? "light_mode" : "dark_mode";
        localStorage.setItem("theme", isDarkMode ? "dark" : "light");
    });

    /*** LOGIN/REGISTER FORM TOGGLE (Wrapper) ***/
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    const btnPopup = document.querySelector('.btnLogin-popup');
    const iconClose = document.querySelector('.icon-close');

    // Toggle to show registration form
    registerLink.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent page from refreshing
        wrapper.classList.add('active'); // Show registration form
    });

    // Toggle to show login form
    loginLink.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent page from refreshing
        wrapper.classList.remove('active'); // Show login form
    });

    // Open login popup
    btnPopup.addEventListener('click', () => {
        wrapper.classList.add('active-popup'); // Show login popup
    });

    // Close popup and reset to login form
    iconClose.addEventListener('click', () => {
        wrapper.classList.remove('active-popup');
        wrapper.classList.remove('active');  // Reset to login form
    });

    /*** ADMIN.php INCORRECT PASSWORD POPUP HANDLING ***/
    const passwordPopup = document.getElementById('passwordpopup');
    const popupCloseBtn = document.querySelector('#passwordpopup .popup-close');

    // Show the incorrect password popup
    function showPasswordPopup() {
        if (passwordPopup) {
            passwordPopup.style.display = 'block'; // Display incorrect password popup
        }
    }

    // Close the incorrect password popup
    function closePasswordPopup() {
        if (passwordPopup) {
            passwordPopup.style.display = 'none'; // Hide incorrect password popup
        }
    }

    // Close the incorrect password popup when the close button is clicked
    if (popupCloseBtn) {
        popupCloseBtn.addEventListener('click', closePasswordPopup);
    } else {
        console.error("Popup close button not found");
    }

    /*** DELETE USER FUNCTIONALITY ***/
    const userListTable = document.querySelector('.user-list-section table');

    if (userListTable) {
        userListTable.addEventListener('click', (event) => {
            const target = event.target;
            if (target.classList.contains('btn-delete')) {
                const email = target.closest('form').querySelector('input[name="user_email"]').value;
                if (confirm(`Are you sure you want to delete the user with email: ${email}?`)) {
                    target.closest('form').submit(); // Submit delete form
                }
            }
        });
    }

    /*** SUBMISSION FORM FUNCTIONALITY ***/
    const submissionForm = document.getElementById('submission-form'); 

    if (submissionForm) {
        submissionForm.addEventListener('submit', (event) => {
            event.preventDefault(); 
     
            const email = submissionForm.querySelector('input[name="email"]').value;
            const topic = submissionForm.querySelector('select[name="topic"]').value;
            const description = submissionForm.querySelector('textarea[name="description"]').value;
            const location = submissionForm.querySelector('input[name="location"]').value; 
     
            if (!email || !topic || !description || !location) {
                alert('Please fill in all fields.'); 
                return;
            }
     
            alert('Submission successful!');
     
            submissionForm.reset();
        });
    }

    /*** USERNAME AND EMAIL IN USE POPUP HANDLER ***/
    const usernameErrorPopup = document.getElementById('username-error-popup');
    const emailErrorPopup = document.getElementById('email-error-popup'); 
    const usernameErrorCloseBtn = document.querySelector('#username-error-popup .popup-close');
    const emailErrorCloseBtn = document.querySelector('#email-error-popup .popup-close'); 

    // Show the username error popup
    function showUsernameErrorPopup() {
        if (usernameErrorPopup) {
            usernameErrorPopup.style.display = 'block';
        }
    }

    // Show the email error popup
    function showEmailErrorPopup() {
        if (emailErrorPopup) {
            emailErrorPopup.style.display = 'block';
        }
    }

    // Close the username error popup
    function closeUsernameErrorPopup() {
        if (usernameErrorPopup) {
            usernameErrorPopup.style.display = 'none';
        }
    }

    // Close the email error popup
    function closeEmailErrorPopup() {
        if (emailErrorPopup) {
            emailErrorPopup.style.display = 'none';
        }
    }

    // Close the username error popup when the close button is clicked
    if (usernameErrorCloseBtn) {
        usernameErrorCloseBtn.addEventListener('click', closeUsernameErrorPopup);
    } else {
        console.error("Username error popup close button not found");
    }

    // Close the email error popup when the close button is clicked
    if (emailErrorCloseBtn) {
        emailErrorCloseBtn.addEventListener('click', closeEmailErrorPopup);
    } else {
        console.error("Email error popup close button not found");
    }

    window.showUsernameError = showUsernameErrorPopup;
    window.showEmailError = showEmailErrorPopup;

    /*** URL PARAMETER HANDLING ***/
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const errorType = urlParams.get('error');
            if (errorType === 'username') {
                showUsernameErrorPopup();
            } else if (errorType === 'email') {
                showEmailErrorPopup();
            }
        }
    };

    /*** PASSWORD INCORRECT AND USER NOT FOUND POPUP HANDLING ***/
    const passwordErrorPopup = document.getElementById('password-error-popup');
    const userNotFoundPopup = document.getElementById('user-not-found-popup');
    const passwordPopupCloseBtn = document.querySelector('#password-error-popup .popup-close');
    const userNotFoundPopupCloseBtn = document.querySelector('#user-not-found-popup .popup-close');

    // Show the password error popup
    function showPasswordErrorPopup() {
        if (passwordErrorPopup) {
            passwordErrorPopup.style.display = 'block';
        }
    }

    // Show the user not found popup
    function showUserNotFoundPopup() {
        if (userNotFoundPopup) {
            userNotFoundPopup.style.display = 'block';
        }
    }

    // Close the password error popup
    function closePasswordErrorPopup() {
        if (passwordErrorPopup) {
            passwordErrorPopup.style.display = 'none';
        }
    }

    // Close the user not found popup
    function closeUserNotFoundPopup() {
        if (userNotFoundPopup) {
            userNotFoundPopup.style.display = 'none';
        }
    }

    // Close the password error popup when the close button is clicked
    if (passwordPopupCloseBtn) {
        passwordPopupCloseBtn.addEventListener('click', closePasswordErrorPopup);
    }

    // Close the user not found popup when the close button is clicked
    if (userNotFoundPopupCloseBtn) {
        userNotFoundPopupCloseBtn.addEventListener('click', closeUserNotFoundPopup);
    }

    // URL parameter handling for popups
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        const errorType = urlParams.get('error');
        if (errorType === 'password') {
            showPasswordErrorPopup();
        } else if (errorType === 'user_not_found') {
            showUserNotFoundPopup();
        }
    }

    

    /*** USER REGISTER SUCCESS POPUP HANDLING ***/
    const registerSuccessPopup = document.getElementById('register-success-popup');
    const registerSuccessCloseBtn = document.querySelector('#register-success-popup .popup-close');

    // Show the register success popup
    function showRegisterSuccessPopup() {
        if (registerSuccessPopup) {
            registerSuccessPopup.style.display = 'block'; // Display register success popup
        }
    }

    // Close the register success popup
    function closeRegisterSuccessPopup() {
        if (registerSuccessPopup) {
            registerSuccessPopup.style.display = 'none'; // Hide register success popup
        }
    }

    // Close the register success popup when the close button is clicked
    if (registerSuccessCloseBtn) {
        registerSuccessCloseBtn.addEventListener('click', closeRegisterSuccessPopup);
    }

    // Trigger register success popup based on URL parameter
    if (urlParams.has('register_success')) {
        showRegisterSuccessPopup();
    }
});

        /*** ADMIN REGISTER SUCCESS POPUP HANDLING ***/
    const adminRegisterSuccessPopup = document.getElementById('admin-register-success-popup');
    const adminRegisterSuccessCloseBtn = document.querySelector('#admin-register-success-popup .popup-close');

    // Show the admin register success popup
    function showAdminRegisterSuccessPopup() {
        if (adminRegisterSuccessPopup) {
            adminRegisterSuccessPopup.style.display = 'block'; // Display admin register success popup
        }
    }

    // Close the admin register success popup
    function closeAdminRegisterSuccessPopup() {
        if (adminRegisterSuccessPopup) {
            adminRegisterSuccessPopup.style.display = 'none'; // Hide admin register success popup
        }
    }

    // Close the admin register success popup when the close button is clicked
    if (adminRegisterSuccessCloseBtn) {
        adminRegisterSuccessCloseBtn.addEventListener('click', closeAdminRegisterSuccessPopup);
    }

    // Trigger admin register success popup based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('adminsuccess')) {
        showAdminRegisterSuccessPopup();
    }

    /*** INVALID ADMIN CODE AND USERNAME TAKEN POPUP HANDLER ***/
    const invalidCodePopup = document.getElementById('invalid-code-popup');
    const usernameTakenPopup = document.getElementById('username-taken-popup');
    const invalidCodeCloseBtn = document.querySelector('#invalid-code-popup .closebtnpopup');
    const usernameTakenCloseBtn = document.querySelector('#username-taken-popup .closebtnpopup');

    // Show the invalid admin code popup
    function showInvalidCodePopup() {
        if (invalidCodePopup) {
            invalidCodePopup.style.display = 'block';
        }
    }

    // Show the username taken popup
    function showUsernameTakenPopup() {
        if (usernameTakenPopup) {
            usernameTakenPopup.style.display = 'block';
        }
    }

    // Close the invalid admin code popup
    function closeInvalidCodePopup() {
        if (invalidCodePopup) {
            invalidCodePopup.style.display = 'none';
        }
    }

    // Close the username taken popup
    function closeUsernameTakenPopup() {
        if (usernameTakenPopup) {
            usernameTakenPopup.style.display = 'none';
        }
    }

    // Close the invalid admin code popup when the close button is clicked
    if (invalidCodeCloseBtn) {
        invalidCodeCloseBtn.addEventListener('click', closeInvalidCodePopup);
    }

    // Close the username taken popup when the close button is clicked
    if (usernameTakenCloseBtn) {
        usernameTakenCloseBtn.addEventListener('click', closeUsernameTakenPopup);
    }

    // URL parameter handling for popups
    if (urlParams.has('error')) {
        const errorType = urlParams.get('error');
        if (errorType === 'invalid_admin_code') {
            showInvalidCodePopup();
        } else if (errorType === 'username_taken') {
            showUsernameTakenPopup();
        }
    }


/*** ADMIN PASSWORD ERROR AND USER NOT FOUND POPUP HANDLING ***/
const adminPasswordErrorPopup = document.getElementById('admin-password-error-popup');
const adminUserNotFoundPopup = document.getElementById('admin-not-found-popup');
const adminPasswordPopupCloseBtn = document.querySelector('#admin-password-error-popup .popup-close');
const adminUserNotFoundPopupCloseBtn = document.querySelector('#admin-not-found-popup .popup-close');

// Show the admin password error popup
function showAdminPasswordErrorPopup() {
    if (adminPasswordErrorPopup) {
        adminPasswordErrorPopup.style.display = 'block';
    }
}

// Show the admin user not found popup
function showAdminUserNotFoundPopup() {
    if (adminUserNotFoundPopup) {
        adminUserNotFoundPopup.style.display = 'block';
    }
}

// Close the admin password error popup
function closePasswordErrorPopup() {
    if (adminPasswordErrorPopup) {
        adminPasswordErrorPopup.style.display = 'none';
    }
}

// Close the admin user not found popup
function closeUserNotFoundPopup() {
    if (adminUserNotFoundPopup) {
        adminUserNotFoundPopup.style.display = 'none';
    }
}

// Close the admin password error popup when the close button is clicked
if (adminPasswordPopupCloseBtn) {
    adminPasswordPopupCloseBtn.addEventListener('click', closePasswordErrorPopup);
}

// Close the admin user not found popup when the close button is clicked
if (adminUserNotFoundPopupCloseBtn) {
    adminUserNotFoundPopupCloseBtn.addEventListener('click', closeUserNotFoundPopup);
}

// URL parameter handling for admin popups
if (urlParams.has('error')) {
    const errorType = urlParams.get('error');
    if (errorType === 'admin_password') {
        showAdminPasswordErrorPopup();
    } else if (errorType === 'admin_user_not_found') {
        showAdminUserNotFoundPopup();
    }
}

//analytics scroll
document.getElementById('analyticsCard').addEventListener('click', function() {
    // Scroll to the analytics panel
    document.getElementById('analyticsPanel').scrollIntoView({ behavior: 'smooth' });
});