<template>
  
  <router-view></router-view>
</template>

<script>
export default {
  name: 'App',
  components: {
  },
  directives: {
    focus: {
      inserted: function (el) {
        el.focus();
      }
    },
    color: {
      bind: function (el, binding) {
        el.style.color = binding.value;
      }
    },
    tooltip: {
      bind: function (el, binding) {
        el.setAttribute('title', binding.value);
      }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.register input, .login input, .add input {
  width: 300px;
  height: 40px;
  padding-left: 20px;
  display: block;
  margin-bottom: 30px;
  margin-right: auto;
  margin-left: auto;
  border: 1px solid skyblue;
}
.register button, .login button, .add button {
  width: 320px;
  height: 40px;
  border: 1px solid skyblue;
  background: skyblue;
  color: white;
  cursor: pointer;
}
.body{
  padding: 0;
  margin: 0;
}
</style>

