import React, { useState } from "react";

let read = "";
let id = 1;

const reading = () => {
  const [message, setMessage] = useState(["danger", "your result goes here"]);

  const handleSelectionChanged = (target) => {
    switch (target.selectedIndex) {
      case 1:
        read = "User";
        break;
      case 2:
        read = "Test";
        break;
      case 3:
        read = "Group";
        break;
      case 4:
        read = "Result";
        break;
    }
  };

  const handleIdChange = (target) => {
    id = target.value;
  };

  const sendDataToServer = (target) => {
    console.log("selection: " + read + " id: " + id);
    // if (read === "") {
    //   setMessage(["warning", "please set the type of object"]);
    //   return;
    // }

    // let data;
    // try {
    //   data = JSON.parse(target.value);
    // } catch (e) {
    //   setMessage(["danger", "you have a syntax error in your object"]);
    //   return;
    // }

    // setMessage(["secondary", "waiting for responce..."]);

    // fetch("http://localhost:8000/api/reading/" + read, {
    //   method: "POST",
    //   body: JSON.stringify(data),
    //   headers: {
    //     "Content-Type": "application/json",
    //   },
    // })
    //   .then((response) => response.json())
    //   .then((data) => {
    //     console.log(data);
    //     setMessage([data.type, data.message]);
    //   })
    //   .catch((error) => setMessage(["danger", "We encountered a " + error]));
  };

  return (
    <div
      className="w-100 d-flex align-items-center justify-content-center"
      style={{ height: "100vh" }}
    >
      <form method="get" className="m-4">
        <div className="border border-primary">
          <select
            className="m-2"
            name="selection"
            id="0"
            onChange={({ target }) => handleSelectionChanged(target)}
          >
            <option value="0">Select Object</option>
            <option value="1">Admin/Candidat</option>
            <option value="2">Test</option>
            <option value="3">Group</option>
            <option value="4">Resultat</option>
          </select>
          <label htmlFor="id">id: </label>
          <input
            type="number"
            className="m-2"
            id="id"
            onChange={({ target }) => handleIdChange(target)}
          />
          <button
            onClick={sendDataToServer}
            className="m-2 btn border border-dark"
          >
            Get Info
          </button>
        </div>
        <div
          className="m-4 p-2 border border-dark font-italic text text-secondary"
          id="search_result"
        >
          {/* {message[1]} */}
        </div>
      </form>
    </div>
  );
};

export default reading;
