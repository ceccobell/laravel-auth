import "./bootstrap";
import "~resources/scss/app.scss";
import "~icons/bootstrap-icons.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

// Seleziona tutti i bottoni di eliminazione
const buttons = document.querySelectorAll(".delete-project");

// Aggiungi un event listener a ciascun bottone di eliminazione
buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
        e.preventDefault();

        // Seleziona la modale
        const modal = document.getElementById("deleteProjectModal");
        const bootstrap_modal = new bootstrap.Modal(modal);

        // Prendi l'ID del progetto dal data attribute del bottone
        const projectId = button.getAttribute("data-project-id");

        // Seleziona il form all'interno della modale
        const form = document.getElementById("deleteForm");

        // Aggiorna l'azione del form con l'URL corretto per eliminare il progetto
        form.action = `/admin/projects/${projectId}`;

        // Mostra la modale
        bootstrap_modal.show();
    });
});
