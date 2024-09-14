export class headerSidePannelDispatcher {
    constructor() {
        const $header = document.querySelector('body > .wrapper > header');

        this.$buttons = $header.querySelectorAll('*[data-dispatcher="headerSidePannel"]');
        this.$closeButton = $header.querySelector('*[data-dispatcher="headerSidePannel"].close');
        this.$sidePanel = $header.querySelector('.side-panel');
        this.$wrapper = document.querySelector('body > .wrapper');
        
        this.desktopMediaQuery = window.matchMedia('(min-width: 64rem)');

        this.init();
    }

    init = () => {
        this.desktopMediaQuery.addEventListener('change', this.onDesktop);

        this.$buttons.forEach(($button) => {
            $button.addEventListener('click', () => {
                switch ($button.dataset['action']) {
                    case 'close':
                        this.toggleSidePanel(false);
                        break;
                    case 'open':
                        this.toggleSidePanel(true);
                        break;
                }
            });
        });

        document.addEventListener('focusin', (event) => {
            if (!this.desktopMediaQuery.matches) {
                if (this.$sidePanel.contains(event.target)) {
                    if (!this.isSidePanelActive()) {
                        this.toggleSidePanel(true);
                    }
                } else if (this.isSidePanelActive()) {
                    this.toggleSidePanel(false);
                }
            }
        });
    }

    onDesktop = (desktopMediaQuery) => {
        if (desktopMediaQuery.matches) {
            this.toggleSidePanel(false);
        }
    }

    toggleSidePanel = (state) => {
        if (state) {
            const $firstFocus = this.$sidePanel.querySelector('a');

            $firstFocus.focus();
            this.$wrapper.scroll({top: 0});
        }

        this.$sidePanel.classList.toggle('active', state);
        this.$closeButton.classList.toggle('active', state);
        this.$wrapper.classList.toggle('overflow-hidden', state);
    }

    isSidePanelActive = () => {
        return this.$sidePanel.classList.contains('active');
    }
}