import Dashboard from './components/Dashboard.vue';
import Stock from './components/Stock.vue';
import Orders from "./components/Orders.vue";
import Sales from "./components/Sales.vue";
import Deliveries from "./components/Deliveries.vue";
import AddStockItem from "./components/AddStockItem.vue";
import AddOrder from "./components/AddOrder.vue";
import AddSale from "./components/AddSale.vue";
import AddDelivery from "./components/AddDelivery.vue";

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
            path: "/stock/add",
            component: AddStockItem,
        },
        {
            path: "/orders",
            component: Orders,
        },
        {
            path: "/orders/add",
            component: AddOrder,
        },
        {
            path: "/sales",
            component: Sales,
        },
        {
            path: "/sales/add",
            component: AddSale,
        },
        {
            path: "/deliveries",
            component: Deliveries,
        },
        {
            path: "/deliveries/add",
            component: AddDelivery,
        },
    ],
};