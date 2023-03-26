import { createBrowserRouter } from "react-router-dom";
import Hello from "./components/Hello";
import TestCreator from "./components/TestCreator";
import Tester from "./components/Tester";
import Testing from "./components/Testing";
import Inserting from "./components/Inserting";

const router = createBrowserRouter([
    {
        path: "/TestCreator",
        element: <TestCreator />,
    },
    {
        path: "/Tester",
        element: <Tester />,
    },
    {
        path: "/Testing",
        element: <Testing />,
    },
    {
        path: "/inserting",
        element: <Inserting />,
    },
    // {
    // 	path: '/Testing',
    // 	element: <Testing/>
    // },
    // {
    // 	path: '/Testing',
    // 	element: <Testing/>
    // },
    // {
    // 	path: '/Testing',
    // 	element: <Testing/>
    // },
    {
        path: "*",
        element: <Hello />,
    },
]);

export default router;
