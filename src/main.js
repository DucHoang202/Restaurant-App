import { createApp } from "vue";
import App from "./App.vue";
import router from "./routers";
import "bootstrap/dist/css/bootstrap.css";
import bootstrap from "bootstrap/dist/js/bootstrap.js";
//import Vue from 'vue';

const app = createApp(App);

app.use(bootstrap).use(router);
app.directive("highlight", {
  mounted:(el ) => {
    el.style.border = "2px solid gray";
    el.style.margin = "auto";
    el.style.padding = "auto";
    el.style.fontSize = "20px";
  },
});
app.mount("#app");


