import Dashboard from './components/Dashboard.vue';
import Stock from './components/Stock.vue';
import Orders from "./components/Orders.vue";
import Sales from "./components/Sales.vue";
import Deliveries from "./components/Deliveries.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            component: Dashboard,
        },
        {
            path: "/stock",
            component: Stock,
        },
        {
            path: "/orders",
            component: Orders,
        },
        {
            path: "/sales",
            component: Sales,
        },
        {
            path: "/deliveries",
            component: Deliveries,
        },
    ],
};