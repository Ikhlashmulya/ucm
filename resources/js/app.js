import "./bootstrap";
import "flowbite";
import { darkMode } from "./flowbite-plugin";
import { initAccordions, initModals } from "flowbite";

document.addEventListener("livewire:navigated", () => {
    darkMode();
    initModals(); // Modal in beranda
    initAccordions(); // Accordion in Tentang
});

document.addEventListener("DOMContentLoaded", () => {
    darkMode();
    initModals();
    initAccordions();
});
