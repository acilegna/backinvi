import "./bootstrap";

setTimeout(function () {
    document
        .querySelectorAll(".respuesta")
        .forEach((alert) => (alert.style.display = "none"));
}, 5000); // 3 segundos
