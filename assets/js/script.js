'use strict';
/**
 * Form toggle functionality (sign-in/sign-up)
 */
const btnSignIn = document.querySelector('.sign-in-btn');
const btnSignUp = document.querySelector('.sign-up-btn');
const signUp = document.querySelector('.sign-up');
const signIn = document.querySelector('.sign-in');

document.addEventListener('click', e => {
  if (e.target === btnSignIn || e.target === btnSignUp) {
    signIn.classList.toggle('active');
    signUp.classList.toggle('active');
  }
});

/**
 * Navbar toggle functionality
 */
const navbar = document.querySelector("[data-navbar]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const menuToggleBtn = document.querySelector("[data-menu-toggle-btn]");

menuToggleBtn.addEventListener("click", function () {
  navbar.classList.toggle("active");
  this.classList.toggle("active");
});

navbarLinks.forEach(link => {
  link.addEventListener("click", function () {
    navbar.classList.toggle("active");
    menuToggleBtn.classList.toggle("active");
  });
});

/**
 * Header sticky & back to top button functionality
 */
const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 100) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
});

/**
 * Reveal elements on scroll
 */
document.addEventListener('DOMContentLoaded', function() {
  function reveal() {
    const reveals = document.querySelectorAll('.reveal');
    const windowHeight = window.innerHeight;
    const elementVisible = 150;

    reveals.forEach(reveal => {
      const elementTop = reveal.getBoundingClientRect().top;
      if (elementTop < windowHeight - elementVisible) {
        reveal.classList.add('active');
      } else {
        reveal.classList.remove('active');
      }
    });
  }

  window.addEventListener('scroll', reveal);
  reveal();
});


const file = document.getElementById( 'fotoPerfil' );
const img = document.getElementById( 'img' );
file.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      img.src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    img.src = defaultFile;
  }
} );