export default () => ({
    currentPosition: 0,
    maxPosition: null,

    init() {
        const images = this.$el.getElementsByClassName('hpgportfolio');
        this.maxPosition = (images.length - 2 ) * 50;

        setInterval(() => {
            this.setCurrentPosition();
            this.$el.style.left = '-' + this.currentPosition + '%';
        }, 3000);
    },

    setCurrentPosition() {
        this.currentPosition += 50;
        if(this.currentPosition > this.maxPosition) {
            this.currentPosition = 0;
        }
    }
})
