let toTopBtn = document.querySelector('#button');

window.onscroll = function() {
    if(this.scrollY >= 600) {
        toTopBtn.classList.add('show');
    } else {
        toTopBtn.classList.remove('show')
    }
}

toTopBtn.onclick = function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
