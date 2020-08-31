window.addEventListener('load',()=>{
    var transition = document.getElementsByClassName('transition')[0];
    transition.classList.add('active');
    setTimeout(() => {
        transition.style.display="none";
    }, 1000);
});