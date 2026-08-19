import "./bootstrap";
const lightbox = document.querySelector("[data-lightbox]");
const items = [...document.querySelectorAll("[data-lightbox-index]")];
if (lightbox && items.length) {
    let current = 0;
    const image = lightbox.querySelector("[data-lightbox-image]");
    const counter = lightbox.querySelector("[data-lightbox-counter]");
    const caption = lightbox.querySelector("[data-lightbox-caption]");
    const render = () => {
        const item = items[current];
        image.src = item.dataset.lightboxSrc;
        caption.textContent = item.dataset.lightboxCaption;
        counter.textContent = `${current + 1} / ${items.length}`;
    };
    const close = () => {
        lightbox.dataset.open = "false";
        lightbox.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };
    items.forEach((item, index) =>
        item.addEventListener("click", () => {
            current = index;
            render();
            lightbox.dataset.open = "true";
            lightbox.setAttribute("aria-hidden", "false");
            document.body.style.overflow = "hidden";
        }),
    );
    lightbox
        .querySelector("[data-lightbox-close]")
        .addEventListener("click", close);
    lightbox
        .querySelector("[data-lightbox-prev]")
        .addEventListener("click", () => {
            current = (current - 1 + items.length) % items.length;
            render();
        });
    lightbox
        .querySelector("[data-lightbox-next]")
        .addEventListener("click", () => {
            current = (current + 1) % items.length;
            render();
        });
    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) close();
    });
    document.addEventListener("keydown", (event) => {
        if (lightbox.dataset.open !== "true") return;
        if (event.key === "Escape") close();
        if (event.key === "ArrowLeft")
            lightbox.querySelector("[data-lightbox-prev]").click();
        if (event.key === "ArrowRight")
            lightbox.querySelector("[data-lightbox-next]").click();
    });
}
import "./bootstrap";
