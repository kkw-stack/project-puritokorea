window.addEventListener('load', function(){

    let logoLink = document.querySelector('#login h1 a');

    logoLink.setAttribute('href', '/');
    logoLink.removeAttribute('title');
    logoLink.innerText = '';

});