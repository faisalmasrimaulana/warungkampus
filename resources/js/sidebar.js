document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('overlay');

    // USER
    const profileButtonUser = document.getElementById('profileButtonUser');
    const profileSidebarUser = document.getElementById('profileSidebarUser');
    if (profileButtonUser && profileSidebarUser) {
        profileButtonUser.addEventListener('click', () => {
            profileSidebarUser.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }

    // ADMIN
    const profileButtonAdmin = document.getElementById('profileButtonAdmin');
    const profileSidebarAdmin = document.getElementById('profileSidebarAdmin');
    if (profileButtonAdmin && profileSidebarAdmin) {
        profileButtonAdmin.addEventListener('click', () => {
            profileSidebarAdmin.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }

    // Overlay close untuk kedua sidebar
    overlay.addEventListener('click', () => {
        if (profileSidebarUser) profileSidebarUser.classList.add('translate-x-full');
        if (profileSidebarAdmin) profileSidebarAdmin.classList.add('translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
});