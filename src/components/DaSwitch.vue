<template>
  <div class="switch" v-bind:class="{'active': !currentValue, '': currentValue}" @click="changeActive(currentValue)">
    <input class="switch-input" type="checkbox" @change="emit('change', currentValue)" v-model="currentValue">
    <span class="switch-core"></span>
  </div>
</template>

<script>
export default {
  props: {
    value: Number
  },
  data() {
    return {

    }
  },
  computed: {
    currentValue: {
      get(){
        return this.value;
      },
      set(val){
        this.$emit('input', val);
      }
    }
  },
  methods: {
    changeActive: function (active) {
      this.currentValue = active ? 0 : 1;
    }
  }
}
</script>

<style>
.switch {
  display: inline-block;
  height: 80px;
  width: 180px;
  position: relative;
  border-radius: 40px;
  transition: background-color 0.3s;
  background-color: limegreen;
  border: 2px solid #ddd;
}
.switch.active {
  background-color: white;
}
.switch-core {
  display: inline-block;
  height: 80px;
  width: 80px;
  border-radius: 100%;
  background-color: white;
  position: absolute;
  right: 0;
  box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.52);
  z-index: 999;
  transition: all 0.3s;
}
.switch:before {
  content: '';
  position: absolute;
  color: white;
  border-radius: 40px;
  width: 100%;
  height: 100%;
  line-height: 80px;
}
.switch.active:after {
  content: '';
  position: absolute;
  border-radius: 40px;
  width: 100%;
  height: 100%;
  text-align: right;
  line-height: 80px;

}
.switch.active > .switch-core{
  right: 100px;
}

.switch-input{
  display: none;
}
</style>
