const $next = document.querySelector('.next');
    const $prev = document.querySelector('.prev');
    const items = document.querySelectorAll('.item');
    let currentIndex = 0;

    function showNextImage() {
        currentIndex = (currentIndex + 1) % items.length;
        document.querySelector('.slide').appendChild(items[currentIndex]);
    }

    function showPrevImage() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        document.querySelector('.slide').prepend(items[currentIndex]);
    }

    $next.addEventListener('click', showNextImage);
    $prev.addEventListener('click', showPrevImage);

    setInterval(showNextImage, 6000); 