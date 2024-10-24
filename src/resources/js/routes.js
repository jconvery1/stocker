import Stock from './components/Stock.vue';
import Orders from "./components/Orders.vue";
import Sales from "./components/Sales.vue";
import Deliveries from "./components/Deliveries.vue";
import Suppliers from "./components/Suppliers.vue";
import Settings from "./components/Settings.vue";
import AddSupplier from "./components/AddSupplier.vue";
import EditSupplier from "./components/EditSupplier.vue";
import AddStockItem from "./components/AddStockItem.vue";
import EditStockItem from "./components/EditStockItem.vue";
import AddOrder from "./components/AddOrder.vue";
import EditOrder from "./components/EditOrder.vue";
import AddSale from "./components/AddSale.vue";
import EditSale from "./components/EditSale.vue";
import AddDelivery from "./components/AddDelivery.vue";
import EditDelivery from "./components/EditDelivery.vue";
import Brands from "./components/Brands.vue";
import Categories from "./components/Categories.vue";
import Materials from "./components/Materials.vue";
import AutomatedReordering from "./components/AutomatedReordering.vue";
import RolePermissions from "./components/RolePermissions.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "Stock",
            component: Stock,
        },
        {
            path: "/stock",
            name: "Stock",
            component: Stock,
            params: true,
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
        {
            path: "/suppliers",
            name: "Suppliers",
            component: Suppliers,
        },
        {
            path: "/suppliers/add",
            name: "AddSupplier",
            component: AddSupplier,
        },
        {
            path: "/suppliers/edit/:id",
            name: "EditSupplier",
            component: EditSupplier,
            props: true,
        },
        {
            path: "/settings",
            name: "Settings",
            component: Settings,
        },
        {
            path: "/brands",
            name: "Brands",
            component: Brands,
        },
        {
            path: "/categories",
            name: "Categories",
            component: Categories,
        },
        {
            path: "/materials",
            name: "Materials",
            component: Materials,
        },
        {
            path: "/automation",
            name: "AutomatedReordering",
            component: AutomatedReordering,
        },
        {
            path: "/rolepermissions",
            name: "RolePermissions",
            component: RolePermissions,
        },
    ],
};