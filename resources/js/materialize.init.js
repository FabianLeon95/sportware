M.AutoInit();

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems,options);
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav .collapsible li > a, .sidenav li > a');
    elems.forEach(elem => {
        elem.classList.add('waves-effect');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav .collapsible li > a, .sidenav li > a');
    elems.forEach(elem => {
        elem.classList.add('waves-effect');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger, .user');
    var instances = M.Dropdown.init(elems, {
        alignment: 'right',
        constrainWidth: false,
        coverTrigger: false
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {
        alignment: 'left',
        constrainWidth: true,
        coverTrigger: true
    });
});