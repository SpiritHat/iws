const loginForm = document.getElementById('loginForm');
const nombreInput = document.getElementById('nombre');
const claveInput = document.getElementById('clave');

loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const nombre = nombreInput.value;
    const clave = claveInput.value;

    // Realiza la autenticación con el servidor usando AJAX
    const response = await fetch('au.php', {
        method: 'POST',
        body: new URLSearchParams({
            nombre: nombre,
            clave: clave,
        })
    });

    const result = await response.text();

    if (result === 'success' ) {
        // Autenticación exitosa, redirecciona al dashboard correspondiente
    
        
        window.location.href = 'panel_control.php';
    } else {
        alert('Credenciales inválidas');
    }
});
