export default function getBottles(action, topic = null) {
    this.loadingStatus = 'loading';
    let url = `/bottle/api/?_action=${action}&id=${this.lastId}`;
    if (topic) {
        url += `&topic=${topic}`;
    }
    this.axios.get(url).then(response => {
        if (response.data.data) {
            this.data = this.data.concat(response.data.data);
            this.lastId = this.data[this.data.length - 1].id;
            this.loadingStatus = '';
        } else {
            this.loadingStatus = 'finish';
        }
    }).catch(() => {
        this.loadingStatus = 'error';
    });
}
