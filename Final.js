// ✅ Hamburger Menu Toggle on Click
document.getElementById('menu-icon').addEventListener('click', (e) => {
  const navLinks = document.getElementById('nav-links');
  navLinks.classList.toggle('show');

  // Stop the click from bubbling to document
  e.stopPropagation();
});

// ✅ Hide nav when clicking outside
document.addEventListener('click', function (event) {
  const nav = document.getElementById('nav-links');
  const menuIcon = document.getElementById('menu-icon');

  const isClickInsideMenu = nav.contains(event.target);
  const isClickOnMenuIcon = menuIcon.contains(event.target);

  if (!isClickInsideMenu && !isClickOnMenuIcon) {
    nav.classList.remove('show');
  }
});

// ✅ Hide nav on touch outside (for mobile)
document.addEventListener('touchstart', function (event) {
  const nav = document.getElementById('nav-links');
  const menuIcon = document.getElementById('menu-icon');

  const isTouchInsideMenu = nav.contains(event.target);
  const isTouchOnMenuIcon = menuIcon.contains(event.target);

  if (!isTouchInsideMenu && !isTouchOnMenuIcon) {
    nav.classList.remove('show');
  }
});

// Services dynamically loaded
const services = [
  { title: "Logo Design", description: "Unique and memorable logos tailored to your brand identity." },
  { title: "Branding", description: "Comprehensive branding packages to make your business stand out." },
  { title: "Social Media Graphics", description: "Custom graphics for all your social media platforms." },
  { title: "Print Design", description: "Flyers, posters, and business cards that pop." },
  { title: "Web Design", description: "Modern and responsive web designs for every device." },
   { title: "Resume Design", description: "Modern and a job winning Curriculum vitae." },
   { title: "Event Planning", description: "Flawless events, unforgettable moments." },
   { title: "Filing tax returns", description: "Stress-free tax filing, done right! with accuracy and efficiency." },
    { title: "KRA Pin Registration", description: "Get yourself identified as a legal tax payer." }
];

const container = document.getElementById('services-container');

services.forEach(service => {
  const card = document.createElement('div');
  card.className = 'service-card';
  card.innerHTML = `<h3>${service.title}</h3><p>${service.description}</p>`;
  container.appendChild(card);
});

