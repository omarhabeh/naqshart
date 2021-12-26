import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../components/Page/Home";
import Invitation from "../components/Page/Invitations";
import ShopArt from "../components/Page/ShopArt";
import About from "../components/Page/AboutUs";
import Terms from "../components/Page/Terms";
import Privacy from "../components/Page/Privacy";
import Refund from "../components/Page/Refund";
import Payment from "../components/Page/Payment";
import JoinUs from "../components/Page/JoinUs";
import Congrats from "../components/Page/Congrats";
import PageNotFound from "../components/Page/PageNotFound";
import VueGtag from "vue-gtag";

Vue.use(VueGtag, {
  config: { id: "UA-203154633-1" }
});

Vue.use(VueRouter);
const routes = [{
        path: "/",
        name: "home",
        component: Home,

    },
    {
        path: "/invitation",
        name: "invitations",
        component: Invitation,

    },
    {
        path: "/shop",
        name: "shop",
        component: ShopArt
    },
    {
        path: "/about",
        name: "about",
        component: About
    },
    {
        path: "/terms",
        component: Terms
    },
    {
        path: "/privacy",
        component: Privacy
    },
    {
        path: "/refund",
        component: Refund
    },
    {
        path: "/checkout",
        component: Payment
    },
    {
        path: "/joinus",
        component: JoinUs
    },
    {
        path: "/congrats",
        component: Congrats
    },
    { path: "*", component: PageNotFound }
];
// import $ from "jquery";
const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: "history"
});

export default router;
