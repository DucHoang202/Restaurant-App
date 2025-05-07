import Home from "./components/Home.vue";
import Find from "./components/Find.vue";
import SignUp from "./components/SignUp.vue";
import LoginPage from "./components/Login.vue";
import Ingredients from "./components/Ingredients.vue";
import Features from "./components/Features.vue";
import Menu from "./components/Menu.vue";
import Update from "./components/Update.vue";
import Add from "./components/Add.vue";
import PageNotFound from "./components/PageNotFound.vue";
import Forum from "./components/Forum.vue";
import Local from "./components/Local.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    name: "HomePage",
    component: Home,
    path: "/",
  },
  {
    name: "FindPage",
    component: Find,
    path: "/find",
  },
  {
    name: "SignUp",
    component: SignUp,
    path: "/signup",
  },
  {
    name: "LoginPage",
    component: LoginPage,
    path: "/login",
  },
  {
    name: "ingredientsPage",
    component: Ingredients,
    path: "/ingredients",
  },
  {
    name: "FeaturesPage",
    component: Features,
    path: "/features",
  },
  {
    name: "MenuPage",
    component: Menu,
    path: "/menu",
  },
  {
    name: "AddPage",
    component: Add,
    path: "/add",
  },
  {
    name: "UpdatePage",
    component: Update,
    path: "/update/:id",
  },
  {
    name: "PageNotFound",
    component: PageNotFound,
    path: "/:pathMatch(.*)*",
  },
  {
    name: "ForumPage",
    component: Forum,
    path: "/forum/:id",
  },
  {
    name: "LocalPage",
    component: Local,
    path: "/local",
  },
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
