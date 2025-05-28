// Sidebar toggle
document.addEventListener('DOMContentLoaded', function () {
    const profileButton = document.getElementById('profileButton');
    const profileSidebar = document.getElementById('profileSidebar');
    const overlay = document.getElementById('overlay');

    profileButton.addEventListener('click', () => {
        profileSidebar.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    overlay.addEventListener('click', () => {
        profileSidebar.classList.add('translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
});