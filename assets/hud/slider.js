const $ = str => document.querySelector(str);
const $$ = str => document.querySelectorAll(str);

(function() {
    if (!window.app) {
        window.app = {};
    }

    app.carousel = {
        init: function(carouselId) {
            const carouselElement = $(`#${carouselId}`);
            const state = {
                downX: null,
                selected: null,
            };

            const removeClass = (el, classname='') => {
                if (el) {
                    if (classname === '') {
                        el.className = '';
                    } else {
                        el.classList.remove(classname);
                    }
                    return el;
                }
            };

            const reorder = () => {
                const childcnt = carouselElement.children.length;
                const childs = carouselElement.children;

                for (let j = 0; j < childcnt; j++) {
                    childs[j].dataset.pos = j;
                }
            };

            const move = (el) => {
                let selected = el;

                if (typeof el === "string") {
                    selected = (el === "next") ? carouselElement.querySelector(".selected").nextElementSibling : carouselElement.querySelector(".selected").previousElementSibling;
                }

                const curpos = parseInt(state.selected.dataset.pos);
                const tgtpos = parseInt(selected.dataset.pos);

                const cnt = curpos - tgtpos;
                const dir = (cnt < 0) ? -1 : 1;
                const shift = Math.abs(cnt);

                for (let i = 0; i < shift; i++) {
                    const el = (dir === -1) ? carouselElement.firstElementChild : carouselElement.lastElementChild;

                    if (dir === -1) {
                        el.dataset.pos = carouselElement.children.length;
                        carouselElement.append(el);
                    } else {
                        el.dataset.pos = 0;
                        carouselElement.prepend(el);
                    }

                    reorder();
                }

                state.selected = selected;
                const next = selected.nextElementSibling;
                const prev = selected.previousElementSibling;
                const prevSecond = prev ? prev.previousElementSibling : carouselElement.lastElementChild;
                const nextSecond = next ? next.nextElementSibling : carouselElement.firstElementChild;

                selected.className = '';
                selected.classList.add("selected");

                removeClass(prev).classList.add('prev');
                removeClass(next).classList.add('next');

                removeClass(nextSecond).classList.add("nextRightSecond");
                removeClass(prevSecond).classList.add("prevLeftSecond");

                nextAll(nextSecond).forEach(item => { item.className = ''; item.classList.add('hideRight'); });
                prevAll(prevSecond).forEach(item => { item.className = ''; item.classList.add('hideLeft'); });
            };

            const nextAll = (el) => {
                const els = [];
                if (el) {
                    while ((el = el.nextElementSibling)) { els.push(el); }
                }
                return els;
            };

            const prevAll = (el) => {
                const els = [];
                if (el) {
                    while ((el = el.previousElementSibling)) { els.push(el); }
                }
                return els;
            };

            const keypress = (e) => {
                switch (e.which) {
                    case 37: // left
                        move('prev');
                        break;

                    case 39: // right
                        move('next');
                        break;

                    default:
                        return;
                }
                e.preventDefault();
                return false;
            };

            const select = (e) => {
                let tgt = e.target;
                while (!tgt.parentElement.classList.contains('carousel-container')) {
                    tgt = tgt.parentElement;
                }
                move(tgt);
            };

            const doDown = (e) => {
                state.downX = e.x;
            };

            const doUp = (e) => {
                if (state.downX) {
                    const direction = (state.downX > e.x) ? -1 : 1;
                    const velocity = state.downX - e.x;

                    if (Math.abs(state.downX - e.x) < 10) {
                        select(e);
                        return false;
                    }
                    if (direction === -1) {
                        move('next');
                    } else {
                        move('prev');
                    }
                    state.downX = 0;
                }
            };

            document.addEventListener("keydown", keypress);
            carouselElement.addEventListener("mousedown", doDown);
            carouselElement.addEventListener("touchstart", doDown);
            carouselElement.addEventListener("mouseup", doUp);
            carouselElement.addEventListener("touchend", doUp);

            reorder();
            state.selected = carouselElement.querySelector(".selected");

            // Automatic movement every 3 seconds
            setInterval(() => {
                move('next');
            }, 3000);
        }
    };

    // Initialize both carousels
    app.carousel.init("carousel-left");
    app.carousel.init("carousel-right");
})();
