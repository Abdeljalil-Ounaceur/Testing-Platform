import React, { useState } from "react";

let CurrentExample = null;

const userExample = {
  fname: "Ali",
  lname: "Majed",
  email: "alimajed@mail.com",
  gsm: "0708654321",
  isAdmin: true,
};

const testExample = {
  idAdmin: 1,
  titre: "test de math",
  duree_mins: 60,
  description: "un test normale",
  questions: [
    {
      titre: "que vaut 5+5?",
      reponses: [
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
      reponses: [
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
  idAdmin: 1,
  candidatsIDs: [1, 2, 3, 6, 7],
  candidatsEnListeDAttente: [4, 5],
  nomGroupe: "monGroupe",
  testAutorisés: [1],
};

const resultExample = {
  idCandidat: 1,
  idTest: 1,
  score: 10,
  duree: 60,
  reponses: [[1, 3], [3]],
};

const defaultExample = "Your example goes here";

let insertion = "";

const inserting = () => {
  const [exampleText, setExampleText] = useState(defaultExample);
  const [message, setMessage] = useState(["danger", ""]);

  const handleSelectionChanged = (target) => {
    if (target.selectedIndex === 0) {
      setExampleText(defaultExample);
      return;
    }

    switch (target.selectedIndex) {
      case 1:
        CurrentExample = userExample;
        insertion = "User";
        break;
      case 2:
        CurrentExample = testExample;
        insertion = "Test";
        break;
      case 3:
        CurrentExample = groupExample;
        insertion = "Group";
        break;
      case 4:
        CurrentExample = resultExample;
        insertion = "Result";
        break;
    }
    setExampleText(JSON.stringify(CurrentExample, null, 4));
  };

  const sendDataToServer = (target) => {
    if (insertion === "") {
      setMessage(["warning", "please set the type of object"]);
      return;
    }

    let data;
    try {
      data = JSON.parse(target.value);
    } catch (e) {
      setMessage(["danger", "you have a syntax error in your object"]);
      return;
    }

    for (let key in CurrentExample) {
      if (!Object.keys(data).includes(key)) {
        setMessage(["danger", "You missed at least one key"]);
        return;
      }
    }

    setMessage(["secondary", "waiting for responce..."]);

    fetch("http://localhost:8000/api/Inserting/" + insertion, {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        setMessage([data.type, data.message]);
      })
      .catch((error) => setMessage(["danger", "We encountered a " + error]));
  };

  return (
    <>
      <form method="get" className="m-4">
        <table>
          <tbody>
            <tr>
              <td>
                <div className="m-4">
                  <select
                    className="m-2"
                    name="selection"
                    id="0"
                    onChange={({ target }) => handleSelectionChanged(target)}
                    style={{ float: "right" }}
                  >
                    <option value="0">Select Object</option>
                    <option value="1">Admin/Candidat</option>
                    <option value="2">Test</option>
                    <option value="3">Group</option>
                    <option value="4">Resultat</option>
                  </select>
                  <h3>Insert an object here</h3>
                  <h5 className="font-italic text text-secondary">
                    Press `Ctrl+Enter` for inserting
                  </h5>
                  <p className={"text text-" + message[0]}>{message[1]}</p>
                  <textarea
                    name=""
                    id="input"
                    cols="50"
                    rows="15"
                    style={{
                      whiteSpace: "pre",
                      // backgroundColor: "black",
                      padding: 10,
                      fontWeight: "bold",
                    }}
                    onKeyUp={(key) => {
                      if (key.ctrlKey && key.code === "Enter") {
                        console.log(key.code);
                        sendDataToServer(key.currentTarget);
                      } else if (key.code !== "ControlLeft") setMessage("");
                    }}
                  ></textarea>
                </div>
              </td>

              <td>
                <div className="m-4" id="exampleDiv">
                  <h3>Example</h3>
                  <br />
                  <textarea
                    id="example"
                    cols="50"
                    rows="15"
                    className="text text-success font-italic"
                    style={{
                      whiteSpace: "pre",
                      backgroundColor: "black",
                      padding: 10,
                      fontWeight: "bold",
                    }}
                    readOnly
                    value={exampleText}
                  ></textarea>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </>
  );
};

export default inserting;
