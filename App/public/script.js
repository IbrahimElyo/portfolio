let sunButton;

document.addEventListener('DOMContentLoaded', () => {
    initializeMode();

    document.querySelectorAll('.nav-link, .auth-link').forEach(link => {
        link.addEventListener('click', handleNavLinkClick);
    });

    setupModeToggle();
});

function handleNavLinkClick(e) {
    const link = e.currentTarget;
    if (link.getAttribute('href').toLowerCase().endsWith('.pdf')) {
        return;
    }
    e.preventDefault();
    const url = link.getAttribute('href');

    document.querySelectorAll('.nav-link, .auth-link').forEach(nav => {
        nav.classList.remove('clicked');
    });

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then((response) => {
        document.querySelector('main').innerHTML = response;
        initializeMode();
        link.classList.add('clicked');
    })
    .catch(error => console.error('Erreur lors de la requête:', error));
}

const hamburgerButton = document.querySelector(".menu-burger");
const navigation = document.querySelector(".navigation");

hamburgerButton.addEventListener("click", function() {
    hamburgerButton.classList.toggle("active");
    navigation.classList.toggle("active");
});

function initializeMode() {
    if(localStorage.getItem('mode') === 'light-mode') {
        document.body.classList.add("light-mode");
    }
    updateIcon();
}

function setupModeToggle() {
    let button = document.querySelector(".mode-button");
    if (button) {
        button.addEventListener("click", function(e) {
            document.body.classList.toggle("light-mode");
            let mode = document.body.classList.contains("light-mode") ? "light-mode" : "dark-mode";
            localStorage.setItem('mode', mode);
            updateIcon();
        });
    }
}

function updateIcon() {
    sunButton = document.querySelector(".mode-button img");
    sunButton.style.transition = "transform 0.5s ease-out";
    
    if (document.body.classList.contains('light-mode')) {
        sunButton.src = "../public/images/moon.svg";
        sunButton.style.transform = "rotate(360deg)";
    } else {
        sunButton.src = "../public/images/sun.svg";
        sunButton.style.transform = "rotate(100deg)";
    }
}

const canvas = document.querySelector("#canvas");
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
let spots = [];
let hue = 0;

const mouse = {
    x: undefined,
    y: undefined
}

canvas.addEventListener('mousemove', function(event) {
    mouse.x = event.clientX;
    mouse.y = event.clientY;
    for(let i = 0; i < 3; i++){
        spots.push(new Particle());
    }
});

class Particle{
    constructor(){
        this.x = mouse.x;
        this.y = mouse.y;
        this.size = Math.random() * 2 + 0.5;
        this.speedX = Math.random() * 2 - 1;
        this.speedY = Math.random() * 2 - 1;
        this.color = `hsl(${hue}, 100%, 50%)`;
    }
    update(){
        this.x += this.speedX;
        this.x += this.speedY;
        if(this.size > 0.1) this.size -= 0.03;
    }
    draw(){
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }
}

function handleParticle(){
    for(let i = 0; i < spots.length; i++){
        spots[i].update();
        spots[i].draw();
        for(let j = i; j < spots.length; j++){
            const dx = spots[i].x - spots[j].x;
            const dy = spots[i].y - spots[j].y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            if(distance < 90) {
                ctx.beginPath();
                ctx.strokeStyle = spots[i].color;
                ctx.lineWidth = spots[i].size / 10;
                ctx.moveTo(spots[i].x, spots[i].y);
                ctx.lineTo(spots[j].x, spots[j].y);
                ctx.stroke();
            }
        }
        if(spots[i].size <= 0.3) {
            spots.splice(i, 1); 
            i--;
        }
    }
}

function animate(){
    ctx.clearRect(0,0, canvas.width, canvas.height);
    handleParticle();
    hue++;
    requestAnimationFrame(animate);
}

window.addEventListener('resize', function() {
    canvas.width = innerWidth;
    canvas.height = innerHeight;

})

window.addEventListener('mouseout', function(){
    mouse.x = undefined;
    mouse.y = undefined;
});
animate();

// Select Language

function changeLanguage() {
    var languageSelector = document.getElementById('language-selector');
    var selectedLanguage = languageSelector.value;
    window.location.href = 'index.php?lang=' + selectedLanguage;
}