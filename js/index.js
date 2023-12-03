    // Function to scroll to the top of the page
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Show/hide the button based on scroll position
    window.onscroll = function() {
        toggleScrollTopButton();
    };

    function toggleScrollTopButton() {
        var button = document.getElementById("scrollTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }

    // Add this script to ensure only one checkbox is checked at a time
    const checkboxes = document.querySelectorAll('input[name="elevatorGroup"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach((otherCheckbox) => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });

    const estimateButton = document.getElementById('estimateButton');

    // Add a click event listener to the button
    estimateButton.addEventListener('click', function() {
        // Add your logic here, for example, show a modal, redirect to a page, etc.
        alert('Free Estimate Submitted please wait for our response thank you!');
    });
