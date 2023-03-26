import React from "react";
import "bootstrap/dist/css/bootstrap.css";
import { Link } from "react-router-dom";

function Hello() {
    return (
        <div
            align="center"
            style={{
                width: 250,
                marginLeft: "auto",
                marginRight: "auto",
                marginTop: 150,
                borderWidth: "1px",
                borderStyle: "double",
            }}
        >
            {/* <Link to='/TestCreator'><button className='btn btn-primary m-2'>Create the test</button></Link> <br />
					<Link to ='/Tester'><button className='btn btn-success m-2'>Pass the test</button></Link> */}
            <Link to="/inserting">
                <button className="btn btn-success m-2">inserting</button>
            </Link>
            <Link to="/reading" disabled>
                <button className="btn btn-success m-2">reading</button>
            </Link>
            <Link to="/updating" disabled>
                <button className="btn btn-success m-2">updating</button>
            </Link>
            <Link to="/deleting" disabled>
                <button className="btn btn-success m-2">deleting</button>
            </Link>
        </div>
    );
}

export default Hello;
