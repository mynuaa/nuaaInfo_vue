<template>
    <div>
        <v-select v-model="dataValue" v-bind:options="options" v-on:input="updateValue(dataValue)" v-bind:placeholder="placeholder"></v-select>
        <div class="test-dom">{{testValue}}</div>
    </div>
</template>

<script>
export default {
    name: 'rs-select',
    props: ['value', 'options', 'placeholder'],
    data() {
        return {
            input: null,
            test: null,
            dataValue: null,
            testValue: '',
            onInput:  () => {
                setTimeout(() => {
                    this.updateValue(this.dataValue);
                    setTimeout(() => {
                        this.autoResize();
                    }, 0);
                }, 0);
            },
        };
    },
    methods: {
        autoResize: function () {
            const width = this.test.offsetWidth + 24;
            this.input.style.width = `${width}px`;
        },
        updateValue: function (value) {
            this.testValue = this.input ? this.input.value : ' ';
            this.$emit('input', value);
        },
        scrollToLeft: function () {
            setTimeout(() => {
                this.input.parentNode.scrollLeft = 0;
            }, 0);
        },
    },
    mounted() {
        this.dataValue = this.$props.value;
        this.input = this.$el.querySelector('input[type=search]');
        this.test = this.$el.querySelector('.test-dom');
        this.input.addEventListener('input', this.onInput);
        this.input.addEventListener('blur', this.scrollToLeft);
        this.$el.onclick = e => {
            if ((e.srcElement || e.target).className !== 'selected-tag') {
                return false;
            }
            setTimeout(() => {
                if (this.input) {
                    this.input.style.width = '24px';
                    this.input.focus();
                    this.scrollToLeft();
                }
            }, 0);
        };
    },
    beforeUpdate() {
        this.dataValue = this.$props.value;
    },
    beforeDestroy() {
        this.input.removeEventListener('input', this.onInput);
        this.input.removeEventListener('blur', this.scrollToLeft);
    },
}
</script>

<style lang="css">
.dropdown.v-select + .test-dom {
    display: inline;
    position: absolute;
    opacity: 0;
    z-index: -1;
}
.dropdown.v-select .dropdown-toggle {
    position: relative;
    border: none;
    border-bottom: 1px solid #D2D2D2 !important;
    border-radius: 0;
    height: 30px;
    box-sizing: border-box;
    overflow: hidden;
}
.dropdown.v-select .dropdown-menu {
    -webkit-overflow-scrolling: touch;
    width: 100%;
    min-width: 0;
    box-sizing: border-box;
    padding: 0;
}
.dropdown.v-select li > a {
    padding: 5px 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.dropdown.v-select input[type=search] {
    position: absolute !important;
    height: 30px !important;
    padding-right: 0 !important;
    box-sizing: content-box;
}
.dropdown.v-select .selected-tag {
    margin-top: 2px;
    padding: 2px 4px;
    height: auto;
    line-height: inherit;
    white-space: nowrap;
}
.dropdown.v-select i {
    display: none;
}
.dropdown.v-select .no-options {
    padding: 5px 10px;
    width: 100%;
    height: 30px;
    overflow: hidden;
    color: transparent;
}
.dropdown.v-select .no-options:before {
    content: '未找到';
    float: left;
    color: #333;
}
</style>
