import React, { useState } from "react";

const userExample = {
  id: 1,
  fname: "Ali",
  lname: "Majed",
  email: "alimajed@mail.com",
  gsm: "0708654321",
  isAdmin: true,
};

const testExample = {
  idTest: 1,
  idAdmin: 1,
  duree: 1000,
  description: "",
  questions: [
    {
      titre: "que vaut 5+5?",
      reponces: [
        {
          text: "10",
          estCorrecte: true,
        },
        {
          text: "1",
          estCorrecte: false,
        },
        {
          text: "5",
          estCorrecte: false,
        },
      ],
    },
    {
      titre: "que vaut  0/0 ?",
      reponces: [
        {
          text: "0",
          estCorrecte: false,
        },
        {
          text: "infinie",
          estCorrecte: false,
        },
        {
          text: "forme indeterminée",
          estCorrecte: true,
        },
      ],
    },
  ],
};

const groupExample = {
  id: 1,
  idAdmin: 1,
  candidatsIDs: [1, 2, 3, 6, 7],
  candidatsEnListeDAttente: [4, 5],
  testAutorisés: [1, 2],
};

const defaultExample = "Your example goes here";

const Deleting = () => {
  const [exampleText, setExampleText] = useState(defaultExample);

  const changeExampleContent = (target) => {
    let text;
    if (target.selectedIndex === 0) {
      setExampleText(defaultExample);
      return;
    }

    switch (target.selectedIndex) {
      case 1:
        text = userExample;
        break;
      case 2:
        text = testExample;
        break;
      case 3:
        text = groupExample;
        break;
    }
    setExampleText(JSON.stringify(text, null, 4));
  };

  const sendDataToServer = () => {};

  return (
    <>
      <form
        /*action="http://localhost:8000/api/Deleting"*/ method="get"
        className="m-4"
      >
        <table>
          <tr>
            <td>
              <div className="m-4">
                <h3>Insert an object here</h3>
                <h5 className="font-italic text text-secondary">
                  Press `Ctrl+Enter` for Deleting
                </h5>
                <textarea
                  name=""
                  id="input"
                  cols="60"
                  rows="15"
                  style={{
                    whiteSpace: "pre",
                    // backgroundColor: "black",
                    padding: 10,
                    fontWeight: "bold",
                  }}
                  onKeyUp={(key) => {
                    if (key.ctrlKey === true && key.code === "Enter")
                      console.log(key);
                  }}
                ></textarea>
              </div>
            </td>

            <td>
              <div className="m-4" id="exampleDiv">
                <h3>Example</h3>
                <select
                  className="m-2"
                  name="selection"
                  id="0"
                  onChange={({ target }) => changeExampleContent(target)}
                >
                  <option value="0">Select</option>
                  <option value="1">Admin/Candidat</option>
                  <option value="2">Test</option>
                  <option value="3">Group</option>
                </select>
                <br />
                <textarea
                  id="example"
                  cols="60"
                  rows="15"
                  className="text text-success font-italic"
                  style={{
                    whiteSpace: "pre",
                    backgroundColor: "black",
                    padding: 10,
                  }}
                  value={exampleText}
                ></textarea>
              </div>
            </td>
          </tr>
        </table>
      </form>
    </>
  );
};

export default Deleting;
