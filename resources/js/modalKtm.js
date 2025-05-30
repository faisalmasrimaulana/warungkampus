const ktmModal = document.getElementById('ktmModal');
const ktmModalClose = document.querySelector('.ktm-modal-close');
const ktmImage = document.getElementById('ktmImage');
const ktmUserName = document.getElementById('ktmUserName');
const ktmUserEmail = document.getElementById('ktmUserEmail');
const ktmUploadDate = document.getElementById('ktmUploadDate');

document.querySelectorAll('.view-ktm-btn').forEach(button => {
button.addEventListener('click', () => {
    const ktmSrc = button.getAttribute('data-ktm');
    const name = button.getAttribute('data-name');
    const email = button.getAttribute('data-email');
    const date = button.getAttribute('data-date');

    ktmImage.src = ktmSrc;
    ktmUserName.textContent = name;
    ktmUserEmail.textContent = email;
    ktmUploadDate.textContent = date;

    ktmModal.classList.remove('hidden');
    ktmModal.classList.add('flex');

})});

// Untuk tombol close modal
ktmModalClose.addEventListener('click', function() {
    ktmModal.classList.add('hidden');
    ktmModal.classList.remove('flex');
});

// Close when clicking outside modal content
window.addEventListener('click', function(event) {
if (event.target === ktmModal) {
        ktmModal.classList.add('hidden');
    ktmModal.classList.remove('flex');
}
});