import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// document.addEventListener('DOMContentLoaded', function () {
//     const dropdownButton = document.getElementById('dropdownButton');
//     const dropdownMenu = document.getElementById('dropdown');

//     dropdownButton.addEventListener('click', function () {
//         dropdownMenu.classList.toggle('hidden');
//     });
// });



document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');

    // Iterate through all dropdown buttons
    dropdownButtons.forEach(function (button) {
        const dropdownId = button.getAttribute('data-dropdown-toggle');
        const dropdownMenu = document.getElementById(dropdownId);

        // Toggle dropdown visibility when button is clicked
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });
    });

    // Close dropdown when clicking outside any dropdown menu
    document.addEventListener('click', function (e) {
        dropdownButtons.forEach(function (button) {
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdownMenu = document.getElementById(dropdownId);
            if (!dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
});



$(document).ready(function () {
    $('#categories_ids').select2();
});

document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle-two]');
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function () {
            const dropdownMenu = document.getElementById(button.getAttribute('data-dropdown-toggle-two'));
            dropdownMenu.classList.toggle('hidden');
        });
    });
});


