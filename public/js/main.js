
document.addEventListener('DOMContentLoaded', function () {

    console.log('Travely website loaded successfully');

    const revealElements = document.querySelectorAll('[data-reveal]');

    if (!('IntersectionObserver' in window)) {
        revealElements.forEach(element => {
            element.classList.add('revealed');
        });
        return;
    }

    const observer = new IntersectionObserver((entries, observer) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }

        });

    }, {
        threshold: 0.12
    });

    revealElements.forEach(element => {
        observer.observe(element);
    });

});
