document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });

    function validateForm() {
        const firstName = form.elements['f_name'].value.trim();
        const middleName = form.elements['m_name'].value.trim();
        const lastName = form.elements['l_name'].value.trim();
        const username = form.elements['username'].value.trim();
        const email = form.elements['email'].value.trim();
        const phone = form.elements['phone'].value.trim();
        const kebeleIdNumber = form.elements['kebele_Id_Number'].value.trim();

        // Regular expression for alphabetic characters
        const alphaExp = /^[a-zA-Z\s]+$/;

        // Regular expression for phone number (accepted format: +251 followed by 9 digits)
        const phoneExp = /^\+251\d{9}$/;

        // Check if first name contains only alphabetic characters
        if (!alphaExp.test(firstName)) {
            alert('Please enter a valid first name with only alphabetic characters.');
            return false;
        }

        // Check if middle name contains only alphabetic characters
        if (middleName && !alphaExp.test(middleName)) {
            alert('Please enter a valid middle name with only alphabetic characters.');
            return false;
        }

        // Check if last name contains only alphabetic characters
        if (!alphaExp.test(lastName)) {
            alert('Please enter a valid last name with only alphabetic characters.');
            return false;
        }

        // Check if username contains at least 4 characters
        if (username.length < 4) {
            alert('Username must be at least 4 characters long.');
            return false;
        }

        // Validate email format
        const emailExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailExp.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        // Validate phone number format
        if (!phoneExp.test(phone)) {
            alert('Please enter a valid phone number in the format: +251XXXXXXXXX.');
            return false;
        }

        // Check if Kebele Id Number contains at least 5 characters and at most 10 characters
        if (kebeleIdNumber.length < 5 || kebeleIdNumber.length > 10) {
            alert('Kebele Id Number must be between 5 and 10 characters long.');
            return false;
        }

        // If all validations pass, return true
        return true;
    }
});
