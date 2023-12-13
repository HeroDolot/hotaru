// Function to scroll to the top of the page
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show/hide the scrollTopBtn button based on scroll position
// Show/hide the scrollNavbar and toggleScrollCard based on scroll position
window.onscroll = function () {
    toggleScrollTopButton();
    toggleScrollNavbar();
    toggleScrollCard();
};



var scrollNavbar = document.getElementById('scrollNavbar');
var scrolled = false;

function toggleScrollNavbar() {
    if (window.pageYOffset > 400) { // Adjust this value based on when you want the navbar to appear
        if (!scrolled) {
            scrollNavbar.style.display = 'block';
            scrolled = true;
        }
    } else {
        if (scrolled) {
            scrollNavbar.style.display = 'none';
            scrolled = false;
        }
    }
}

function toggleScrollCard() {
    var scrollCard = document.getElementById("scrollCard");
    var scrollPosition = window.scrollY;

    // Customize the threshold values as needed
    var showThreshold = 800; // Show the card when scrolled down by 100 pixels
    var hideThreshold = document.body.offsetHeight - window.innerHeight - 1300; // Hide the card when close to the bottom

    if (scrollPosition >= showThreshold && scrollPosition <= hideThreshold) {
        // Show the card when scrolling down and not close to the bottom
        scrollCard.style.display = "block";
    } else {
        // Hide the card in other cases
        scrollCard.style.display = "none";
    }
}

function toggleScrollTopButton() {
    var button = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
}


function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', margin: { top: -100 } });
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

    
