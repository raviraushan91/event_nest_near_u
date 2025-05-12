// Dummy user data for demonstration
let loggedInUser = null;

// DOM elements
const registerForm = document.getElementById('register-form');
const loginForm = document.getElementById('login-form');
const logoutBtn = document.getElementById('logout-btn');
const userDetails = document.getElementById('user-details');
const userName = document.getElementById('user-name');
const userEmail = document.getElementById('user-email');
const registerFormContainer = document.getElementById('register-form-container');
const loginFormContainer = document.getElementById('login-form-container');

// Check if the user is logged in on page load
window.onload = function() {
  if (loggedInUser) {
    // Show user details if logged in
    showUserDetails();
  } else {
    // Show login and register forms if not logged in
    showLoginRegisterForms();
  }
};

// Handle Register form submission
registerForm.addEventListener('submit', function (event) {
  event.preventDefault();
  const username = event.target.username.value;
  const email = event.target.email.value;
  const password = event.target.password.value;

  // Simulate user registration (store in memory)
  loggedInUser = { username, email, password };
  alert('Registration successful! You can now log in.');

  // Show login form after successful registration
  showLoginRegisterForms();
});

// Handle Login form submission
loginForm.addEventListener('submit', function (event) {
  event.preventDefault();
  const email = event.target['login-email'].value;
  const password = event.target['login-password'].value;

  // Simulate user login (check in memory)
  if (loggedInUser && loggedInUser.email === email && loggedInUser.password === password) {
    alert('Login successful!');
    showUserDetails();
  } else {
    alert('Invalid credentials. Please try again.');
  }
});

// Show User Details when logged in
function showUserDetails() {
  registerFormContainer.style.display = 'none';
  loginFormContainer.style.display = 'none';
  userDetails.style.display = 'block';

  userName.textContent = loggedInUser.username;
  userEmail.textContent = loggedInUser.email;
}

// Show Register and Login forms if not logged in
function showLoginRegisterForms() {
  registerFormContainer.style.display = 'block';
  loginFormContainer.style.display = 'block';
  userDetails.style.display = 'none';
}

// Handle Logout
logoutBtn.addEventListener('click', function () {
  loggedInUser = null;
  showLoginRegisterForms();
});
