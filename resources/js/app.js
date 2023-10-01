import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

// ? Alert auto close

document.addEventListener("DOMContentLoaded", () => {
    let sessionAlert = document.getElementById("session-alert");

    if (sessionAlert) {
        setTimeout(() => {
            sessionAlert.style.display = "none";
        }, 3000);
    }
});
