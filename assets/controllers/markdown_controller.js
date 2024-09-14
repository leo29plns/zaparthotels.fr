import { Controller } from '@hotwired/stimulus';
import { marked } from 'marked';

export default class extends Controller {
    connect = () => {
        this.init();
    }

    init = () => {
        this.$markdown = this.element;

        this.$markdown.innerHTML = this.parseMarkdown(this.$markdown.innerHTML);
    }

    parseMarkdown = ($markdown) => {
        return marked.parse($markdown);
    }
}