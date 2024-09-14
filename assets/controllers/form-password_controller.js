import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect = () => {
        this.init();

        this.$checkbox.addEventListener('click', () => {
            this.toggleVisibility(this.$checkbox.checked);
        });
    }

    init = () => {
        this.$checkbox = this.element.querySelector('.toggle-password input[type="checkbox"]');
        this.$passwordInput = this.element.querySelector('input[type="password"]');
    }

    toggleVisibility = (state) => {
        if (state) {
            this.$passwordInput.type = 'text';
        } else {
            this.$passwordInput.type = 'password';
        }
    }
}
