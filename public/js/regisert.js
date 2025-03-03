 // Set default role
 document.addEventListener('DOMContentLoaded', function() {
    // Default to user role (client)
    const defaultRoleCard = document.querySelector('.role-card[data-role="user"]');
    if (defaultRoleCard) {
        selectRole(defaultRoleCard, 'user');
    }
});

function selectRole(element, role) {
    console.log('Selecting role:', role);
    
    // Remove selected class from all cards
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
        card.classList.remove('animate__pulse');
    });
    
    // Add selected class to clicked card
    element.classList.add('selected');
    element.classList.add('animate__animated');
    element.classList.add('animate__pulse');
    
    // Set the hidden input value
    document.getElementById('role').value = role;
    console.log('Role value set to:', document.getElementById('role').value);
}

const formInputs = document.querySelectorAll('.form-control');
formInputs.forEach(input => {
    input.addEventListener('focus', function() {
        this.classList.add('animate__animated', 'animate__pulse');
    });
    
    input.addEventListener('blur', function() {
        this.classList.remove('animate__animated', 'animate__pulse');
    });
});