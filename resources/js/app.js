import "./bootstrap";
import "flowbite";
import { darkMode } from "./flowbite-plugin";
import { initAccordions, initCollapses, initModals } from "flowbite";

document.addEventListener("livewire:navigated", () => {
    darkMode();
    initCollapses();
    initModals(); // Modal in beranda
    initAccordions(); // Accordion in Tentang
});

document.addEventListener("DOMContentLoaded", () => {
    darkMode();
    initCollapses();
    initModals();
    initAccordions();
});
