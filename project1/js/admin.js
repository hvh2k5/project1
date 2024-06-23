document.addEventListener('DOMContentLoaded', function () {
    var collapses = document.querySelectorAll('.collapse');
    collapses.forEach(function (collapse) {
        var toggleIcon = document.querySelector('[href="#' + collapse.id + '"] .rotate');
        collapse.addEventListener('show.bs.collapse', function () {
            toggleIcon.classList.add('rotate-90');
            collapses.forEach(function (otherCollapse) {
                if (otherCollapse !== collapse) {
                    var otherIcon = document.querySelector('[href="#' + otherCollapse.id + '"] .rotate');
                    otherCollapse.classList.remove('show');
                    otherIcon.classList.remove('rotate-90');
                }
            });
        });

        collapse.addEventListener('hide.bs.collapse', function () {
            toggleIcon.classList.remove('rotate-90');
        });
    });
});