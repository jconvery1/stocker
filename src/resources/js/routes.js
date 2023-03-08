import Dashboard from './components/Dashboard.vue';
import Stock from './components/Stock.vue';
import Orders from "./components/Orders.vue";
import Sales from "./components/Sales.vue";
import Deliveries from "./components/Deliveries.vue";
import AddStockItem from "./components/AddStockItem.vue";
import EditStockItem from "./components/EditStockItem.vue";
import AddOrder from "./components/AddOrder.vue";
import EditOrder from "./components/EditOrder.vue";
import AddSale from "./components/AddSale.vue";
import EditSale from "./components/EditSale.vue";
import AddDelivery from "./components/AddDelivery.vue";
import EditDelivery from "./components/EditDelivery.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "Dashboard",
            component: Dashboard,
        },
        {
            path: "/stock",
            name: "Stock",
            component: Stock,
        },
        {
            path: "/stock/add",
            name: "AddStockItem",
            component: AddStockItem,
        },
        {
            path: "/stock/edit/:id",
            name: "EditStockItem",
            component: EditStockItem,
            props: true,
        },
        {
            path: "/orders",
            name: "Orders",
            component: Orders,
        },
        {
            path: "/orders/add",
            name: "AddOrder",
            component: AddOrder,
            props: true,
        },
        {
            path: "/orders/edit/:id",
            name: "EditOrder",
            component: EditOrder,
            props: true,
        },
        {
            path: "/sales",
            name: "Sales",
            component: Sales,
        },
        {
            path: "/sales/add",
            name: "AddSale",
            component: AddSale,
        },
        {
            path: "/sales/edit/:id",
            name: "EditSale",
            component: EditSale,
            props: true,
        },
        {
            path: "/deliveries",
            name: "Deliveries",
            component: Deliveries,
        },
        {
            path: "/deliveries/add",
            name: "AddDelivery",
            component: AddDelivery,
        },
        {
            path: "/deliveries/edit/:id",
            name: "EditDelivery",
            component: EditDelivery,
            props: true,
        },
    ],
};