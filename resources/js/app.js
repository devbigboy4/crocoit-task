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
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdown');

    // Toggle dropdown visibility
    dropdownButton.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the parent link from triggering
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside of it
    document.addEventListener('click', function (e) {
        if (!dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.add('hidden');
        }
    });
});


$(document).ready(function() {
    $('#categories_ids').select2();
});


