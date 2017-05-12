export default function getBottles(action, topic = null) {
    this.loadingStatus = 'loading';
    let url = `/bottle/api/${action}?id=${this.lastId}`;
    if (topic) {
        url += `&topic=${topic}`;
    }
    this.axios.get(url).then(response => {
        if (response.data.data) {
            this.data = this.data.concat(response.data.data);
            this.lastId = this.data[this.data.length - 1].id;
            if (response.data.data.length < 15) {
                this.loadingStatus = 'finish';
            } else {
                this.loadingStatus = '';
            }
        } else {
            this.loadingStatus = 'finish';
        }
    }).catch(() => {
        this.loadingStatus = 'error';
    });
}
