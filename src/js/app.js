document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");

  mobileMenu.addEventListener("click", navegacionResponsive);

  //Muestra campos condicionales
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  //Agrega event listener por cada input obtenido por el query all
  metodoContacto.forEach((input) =>
    input.addEventListener("click", mostrarMetodos)
  );
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  if (navegacion.classList.contains("mostrar")) {
    navegacion.classList.remove("mostrar");
  } else {
    navegacion.classList.add("mostrar");
  }
}

function darkMode() {
  //Checa las preferencias del sistema al entrara la pagina
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
  if (prefiereDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }
  //Escucha con un listener los cambios del sistema si cambia las preferencias de dark a light
  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });
  //Cambia entre dark y light mode con el click al boton
  const botonDarkMode = document.querySelector(".dark-mode-button");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}

function mostrarMetodos(e) {
  const contactoDiv = document.querySelector("#contacto");
  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `
    <label for="telefono">Telefono</label>
    <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">
    <p>Elija la fecha y hora para la llamada</p>
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="contacto[fecha]">
    <label for="hora">Hora</label>
    <input type="time" placeholder="Hora" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    `;
  } else {
    contactoDiv.innerHTML = `
    <label for="email">E-Mail</label>
    <input type="email" placeholder="Tu Email" id="email" name="contacto[email]">
    `;
  }
}
