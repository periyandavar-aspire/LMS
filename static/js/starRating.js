class StarRatting extends HTMLElement {
    constructor() {
        super();
        const container = document.createElement('div');
        let label, input, star;
        container.setAttribute("class", "rate");
        for (let i = 5; i > 0; i--) {
            label = document.createElement('label');
            input = document.createElement('input');
            input.setAttribute("type", "radio");
            input.setAttribute("id", "star" + i);
            input.setAttribute("name", "rating");
            input.setAttribute("value", i);
            label.setAttribute("for", "star" + i);
            label.setAttribute("title", i + " stars");
            container.appendChild(input);
            container.appendChild(label);
        }
        this.appendChild(container);
        star = this.hasAttribute('stars') ? this.getAttribute("stars") : "";
        star = (star < 0 && star > 5) ? 0 : star;
        document.getElementById('star' + star).checked = true;
    }

}

// Define the new element
customElements.define('star-rating', StarRatting);