import "./bootstrap";

setTimeout(function () {
    document
        .querySelectorAll(".alert")
        .forEach((alert) => (alert.style.display = "none"));
}, 3000); // 3 segundos
