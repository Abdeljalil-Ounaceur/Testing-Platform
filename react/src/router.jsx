import { createBrowserRouter } from "react-router-dom";
import Hello from "./components/Hello";
import TestCreator from "./components/TestCreator";
import Tester from "./components/Tester";
import Testing from "./components/Testing";
import Inserting from "./components/Inserting";
import Reading from "./components/Reading";

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
  {
    path: "/Reading",
    element: <Reading />,
  },
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
