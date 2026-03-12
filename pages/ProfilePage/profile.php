<?php
// Mindflayer Coffee — Profile / Edit Profile Page
$shop_name = "Mindflayer";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $shop_name ?> · Profile</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        /* Shared palette with homepage */
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --text-dark: #2A1E1E;
            --text-mid: #6F4C3E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            --transition: 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .profile-navbar {
            background-color: var(--espresso);
            color: var(--cream);
            padding: 0.9rem 1.5rem;
        }

        .profile-brand {
            font-family: var(--font-display);
            font-weight: 900;
            letter-spacing: -0.03em;
            font-size: 1.4rem;
        }

        .profile-brand span.dot {
            color: var(--sand);
        }

        .profile-wrapper {
            max-width: 880px;
            margin: 2.5rem auto;
            padding: 0 1.25rem 3rem;
        }

        .profile-heading {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--espresso);
        }

        .profile-subtitle {
            color: var(--text-light);
            font-size: 0.95rem;
            max-width: 540px;
        }

        .profile-card {
            background-color: var(--white);
            border-radius: 14px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.07);
            border: 1px solid rgba(194, 178, 128, 0.25);
            padding: 1.8rem 1.6rem;
        }

        @media (min-width: 768px) {
            .profile-card {
                padding: 2.2rem 2.4rem;
            }
        }

        .avatar-wrapper {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            border: 2px solid rgba(194, 178, 128, 0.9);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 30%, var(--cream), var(--mocha));
            color: var(--espresso);
            font-size: 2.6rem;
            font-weight: 700;
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
        }

        .avatar-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .avatar-upload-btn {
            margin-top: 0.5rem;
            font-size: 0.78rem;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            border: 1px dashed rgba(194, 178, 128, 0.7);
            background: rgba(248, 244, 233, 0.7);
            color: var(--text-mid);
        }

        .profile-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-mid);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .profile-tooltip-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(194, 178, 128, 0.25);
            color: var(--text-mid);
            font-size: 0.6rem;
            cursor: pointer;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid rgba(194, 178, 128, 0.5);
            font-size: 0.92rem;
            padding: 0.65rem 0.8rem;
        }

        .form-control:focus {
            border-color: var(--sand);
            box-shadow: 0 0 0 0.16rem rgba(194, 178, 128, 0.22);
        }

        .btn-save-profile {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            border: none;
            padding: 0.8rem 1.4rem;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .btn-save-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(194, 178, 128, 0.5);
        }

        .btn-outline-ghost {
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.5);
            background: transparent;
            color: var(--text-mid);
            font-size: 0.85rem;
            padding: 0.6rem 1.1rem;
        }

        .field-error {
            font-size: 0.78rem;
            color: #b02a37;
            margin-top: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: #b02a37;
        }

        .profile-meta {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        @media (max-width: 575.98px) {
            .profile-card {
                border-radius: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <header class="profile-navbar">
        <div class="d-flex align-items-center justify-content-between">
            <a href="../../index.php" class="d-flex align-items-center gap-2 text-decoration-none text-light">
                <span class="profile-brand">☕ <?= $shop_name ?><span class="dot">.</span></span>
            </a>
            <a href="../ShoppingCartPage/shoppingcart.php" class="text-light small text-uppercase" style="letter-spacing:0.12em;">
                <i class="bi bi-house-door me-1"></i> Home
            </a>
        </div>
    </header>

    <main class="profile-wrapper">
        <div class="mb-3">
            <h1 class="profile-heading">Your profile</h1>
            <p class="profile-subtitle mb-0">
                View and update your personal details. We use this information to personalize your experience and keep your orders accurate.
            </p>
        </div>

        <section class="profile-card" aria-label="Profile and edit form">
            <div class="row g-4">
                <!-- Left: current profile snapshot -->
                <div class="col-md-4 border-end border-light-subtle">
                    <div class="d-flex flex-column align-items-center text-center h-100">
                        <div class="avatar-upload mb-2">
                            <div class="avatar-wrapper" id="avatarPreview">
                                <span id="avatarInitials">JD</span>
                            </div>
                            <label class="avatar-upload-btn mt-2">
                                <i class="bi bi-camera me-1"></i> Update photo
                                <input type="file" id="avatarInput" accept="image/*">
                            </label>
                        </div>
                        <h2 class="mt-2 mb-0" style="font-size:1.1rem; font-weight:700;"><?= "Juan Dela Cruz" ?></h2>
                        <p class="mb-1" style="font-size:0.86rem; color:var(--text-light);">Member since 2024</p>
                        <p class="profile-meta mb-0">
                            <i class="bi bi-cup-hot me-1"></i> Favourite drink: Spanish Latte
                        </p>
                    </div>
                </div>

                <!-- Right: edit form (single column) -->
                <div class="col-md-8">
                    <form id="profileForm" novalidate>
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="profile-label">
                                Full name
                                <!-- Tip 10 – Tooltips & Guides -->
                                <span class="profile-tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Use your full legal name so receipts and invoices are correct.">
                                    <i class="bi bi-question-lg"></i>
                                </span>
                            </label>
                            <input type="text" class="form-control" id="name" value="Juan Dela Cruz" required>
                            <div class="field-error" id="nameError" hidden>
                                Please enter your full name (first and last).
                            </div>
                        </div>

                        <!-- Phone with input mask (Tip 38) -->
                        <div class="mb-3">
                            <label for="phone" class="profile-label">
                                Mobile number
                                <span class="profile-tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="We text you order updates and rider details. Format: 09XX XXX XXXX.">
                                    <i class="bi bi-question-lg"></i>
                                </span>
                            </label>
                            <input type="tel" class="form-control" id="phone" placeholder="09XX XXX XXXX" value="0917 123 4567" required>
                            <div class="field-error" id="phoneError" hidden>
                                Enter an 11-digit PH mobile number in the format 09XX XXX XXXX.
                            </div>
                        </div>

                        <!-- Birth date with input mask (Tip 38) -->
                        <div class="mb-3">
                            <label for="birthdate" class="profile-label">
                                Birth date
                                <span class="profile-tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="We use this for age verification and birthday treats. Format: YYYY-MM-DD.">
                                    <i class="bi bi-question-lg"></i>
                                </span>
                            </label>
                            <input type="text" class="form-control" id="birthdate" placeholder="YYYY-MM-DD" value="1998-05-24" required>
                            <div class="field-error" id="birthdateError" hidden>
                                Use the format YYYY-MM-DD (for example, 1998-05-24).
                            </div>
                        </div>

                        <!-- Email (read-only here) -->
                        <div class="mb-3">
                            <label for="email" class="profile-label">
                                Email address
                                <span class="profile-tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="We send receipts and security alerts here.">
                                    <i class="bi bi-question-lg"></i>
                                </span>
                            </label>
                            <input type="email" class="form-control" id="email" value="juan@example.com" readonly>
                            <div class="form-text" style="font-size:0.78rem;">
                                To update your email, contact support so we can verify ownership.
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                            <button type="submit" class="btn-save-profile">
                                Save changes
                                <i class="bi bi-check-circle"></i>
                            </button>
                            <button type="button" id="resetBtn" class="btn-outline-ghost">
                                Cancel
                            </button>
                            <span class="profile-meta ms-md-2 mt-2 mt-md-0" id="saveStatus">
                                Last updated · just now
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable Bootstrap tooltips (Tip 10 – Tooltips & Guides)
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el);
        });

        const profileForm = document.getElementById('profileForm');
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone');
        const birthdateInput = document.getElementById('birthdate');

        const nameError = document.getElementById('nameError');
        const phoneError = document.getElementById('phoneError');
        const birthdateError = document.getElementById('birthdateError');
        const saveStatus = document.getElementById('saveStatus');

        // Tip 38 – Input Masks: Phone
        phoneInput.addEventListener('input', (e) => {
            let digits = e.target.value.replace(/\D/g, '').slice(0, 11); // PH mobile: 11 digits
            let formatted = '';
            if (digits.length <= 4) {
                formatted = digits;
            } else if (digits.length <= 7) {
                formatted = digits.slice(0, 4) + ' ' + digits.slice(4);
            } else {
                formatted = digits.slice(0, 4) + ' ' + digits.slice(4, 7) + ' ' + digits.slice(7);
            }
            e.target.value = formatted;
        });

        // Tip 38 – Input Masks: Birth date (YYYY-MM-DD)
        birthdateInput.addEventListener('input', (e) => {
            let digits = e.target.value.replace(/\D/g, '').slice(0, 8);
            if (digits.length >= 5) {
                e.target.value = digits.slice(0, 4) + '-' + digits.slice(4, 6) + (digits.length > 6 ? '-' + digits.slice(6, 8) : '');
            } else if (digits.length >= 4) {
                e.target.value = digits.slice(0, 4) + '-' + digits.slice(4);
            } else {
                e.target.value = digits;
            }
        });

        // Contextual validation helper
        function setError(input, errorEl, message) {
            input.classList.add('is-invalid');
            errorEl.textContent = message;
            errorEl.hidden = false;
        }

        function clearError(input, errorEl) {
            input.classList.remove('is-invalid');
            errorEl.hidden = true;
        }

        // Validate fields on blur to show contextual errors exactly where the problem is (Tip 10)
        nameInput.addEventListener('blur', () => {
            const value = nameInput.value.trim();
            if (!value || value.split(' ').length < 2) {
                setError(nameInput, nameError, 'Please enter your full name with at least first and last name.');
            } else {
                clearError(nameInput, nameError);
            }
        });

        phoneInput.addEventListener('blur', () => {
            const digits = phoneInput.value.replace(/\D/g, '');
            if (digits.length !== 11 || !digits.startsWith('09')) {
                setError(phoneInput, phoneError, 'Enter a valid PH mobile number starting with 09 and 11 digits long.');
            } else {
                clearError(phoneInput, phoneError);
            }
        });

        birthdateInput.addEventListener('blur', () => {
            const value = birthdateInput.value.trim();
            const regex = /^\d{4}-\d{2}-\d{2}$/;
            if (!regex.test(value)) {
                setError(birthdateInput, birthdateError, 'Use the format YYYY-MM-DD (for example, 1998-05-24).');
                return;
            }
            const [year, month, day] = value.split('-').map(Number);
            const date = new Date(year, month - 1, day);
            const isValidDate = date.getFullYear() === year && (date.getMonth() + 1) === month && date.getDate() === day;
            if (!isValidDate) {
                setError(birthdateInput, birthdateError, 'That date doesn’t seem to be valid. Double-check the month and day.');
                return;
            }
            clearError(birthdateInput, birthdateError);
        });

        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Trigger blur validations
            nameInput.dispatchEvent(new Event('blur'));
            phoneInput.dispatchEvent(new Event('blur'));
            birthdateInput.dispatchEvent(new Event('blur'));

            if (document.querySelector('.form-control.is-invalid')) {
                // Remind user that fields with red borders need attention
                saveStatus.textContent = 'Fix the highlighted fields to save your profile.';
                saveStatus.style.color = '#b02a37';
                return;
            }

            const saveBtn = e.target.querySelector('.btn-save-profile');
            saveBtn.disabled = true;
            const originalLabel = saveBtn.innerHTML;
            saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';

            setTimeout(() => {
                saveBtn.disabled = false;
                saveBtn.innerHTML = originalLabel;
                saveStatus.textContent = 'Profile saved · a few seconds ago';
                saveStatus.style.color = 'var(--text-light)';
            }, 900);
        });

        // Reset form to original values
        document.getElementById('resetBtn').addEventListener('click', () => {
            profileForm.reset();
            clearError(nameInput, nameError);
            clearError(phoneInput, phoneError);
            clearError(birthdateInput, birthdateError);
            saveStatus.textContent = 'Changes discarded · using last saved details';
            saveStatus.style.color = 'var(--text-light)';
        });

        // Simple avatar preview from selected file
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');
        const avatarInitials = document.getElementById('avatarInitials');

        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (ev) => {
                avatarPreview.style.backgroundImage = `url(${ev.target.result})`;
                avatarPreview.style.backgroundSize = 'cover';
                avatarPreview.style.backgroundPosition = 'center';
                avatarInitials.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>